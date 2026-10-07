<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class MahasiswaPengajuanController extends Controller
{
    public function create()
    {
        return view('mahasiswa.ajukan');
    }

    public function dashboard(Request $request)
    {
        $mahasiswa = $this->currentMahasiswa($request);
        $statusCounts = DB::table('pengajuan_bebas_pustaka')
            ->where('nim', $mahasiswa->nim)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
        $latestSubmission = DB::table('pengajuan_bebas_pustaka')
            ->where('nim', $mahasiswa->nim)
            ->orderByDesc('tanggal_diajukan')
            ->first();

        $submissionCount = (int) $statusCounts->sum();
        $processingCount = (int) $statusCounts->only([
            'menunggu_review',
            'diproses',
            'menunggu_koreksi',
            'perlu_revisi',
        ])->sum();
        $approvedCount = (int) $statusCounts->get('disetujui', 0);
        $completedCount = (int) $statusCounts->get('selesai', 0);
        $currentStep = null;
        $latestStatus = null;
        $latestStatusNote = null;

        if ($latestSubmission) {
            $latestSubmission->tanggal_label = Carbon::parse($latestSubmission->tanggal_diajukan)
                ->locale('id')
                ->translatedFormat('j F Y');
            $latestStatus = $this->statusPresentation($latestSubmission->status);
            $currentStep = match ($latestSubmission->status) {
                'menunggu_review', 'diproses', 'menunggu_koreksi', 'perlu_revisi', 'ditolak', 'dibatalkan' => 2,
                'disetujui' => 3,
                'selesai' => 4,
                default => 1,
            };
            $latestStatusNote = match ($latestSubmission->status) {
                'menunggu_review', 'diproses' => 'Pengajuan sedang menunggu pemeriksaan petugas.',
                'menunggu_koreksi', 'perlu_revisi' => $latestSubmission->status_keterangan ?: 'Petugas meminta Anda memperbaiki berkas pengajuan.',
                'disetujui' => $latestSubmission->status_keterangan ?: 'Pengajuan telah disetujui. Menunggu penyelesaian bebas pustaka.',
                'selesai' => $latestSubmission->status_keterangan ?: 'Pengajuan bebas pustaka telah selesai.',
                'ditolak' => $latestSubmission->status_keterangan ?: 'Pengajuan ditolak. Periksa catatan petugas di riwayat.',
                'dibatalkan' => $latestSubmission->status_keterangan ?: 'Pengajuan ini telah dibatalkan.',
                default => $latestSubmission->status_keterangan ?: 'Status pengajuan diperbarui.',
            };
        }

        return view('mahasiswa.dashboard', compact(
            'submissionCount',
            'processingCount',
            'approvedCount',
            'completedCount',
            'latestSubmission',
            'latestStatus',
            'latestStatusNote',
            'currentStep',
        ));
    }

    public function history(Request $request)
    {
        $mahasiswa = $this->currentMahasiswa($request);
        $submissions = DB::table('pengajuan_bebas_pustaka as pengajuan')
            ->leftJoin('dosen as pembimbing_1', 'pembimbing_1.id_dosen', '=', 'pengajuan.dosen_pembimbing_id')
            ->leftJoin('dosen as pembimbing_2', 'pembimbing_2.id_dosen', '=', 'pengajuan.dosen_pembimbing_2_id')
            ->where('pengajuan.nim', $mahasiswa->nim)
            ->orderByDesc('pengajuan.tanggal_diajukan')
            ->select([
                'pengajuan.*',
                'pembimbing_1.nama_dosen as nama_pembimbing_1',
                'pembimbing_2.nama_dosen as nama_pembimbing_2',
            ])
            ->get();

        $documents = DB::table('pengajuan_bebas_pustaka_dokumen')
            ->whereIn('pengajuan_id', $submissions->pluck('id'))
            ->orderBy('jenis_dokumen')
            ->get()
            ->groupBy('pengajuan_id');

        foreach ($submissions as $submission) {
            $status = $this->statusPresentation($submission->status);
            $submission->status_label = $status['label'];
            $submission->status_filter = $status['filter'];
            $submission->status_badge_class = $status['badge'];
            $submission->status_dot_class = $status['dot'];
            $submission->tanggal_label = Carbon::parse($submission->tanggal_diajukan)
                ->locale('id')
                ->translatedFormat('j F Y');
            $submission->jenis_karya_label = str($submission->jenis_karya)->replace('_', ' ')->title();
            $submission->catatan_label = $submission->status_keterangan ?: 'Belum ada catatan dari petugas.';
            $submission->search_text = mb_strtolower(implode(' ', [
                $submission->nomor_pengajuan,
                $submission->judul_karya,
                $submission->jenis_karya_label,
                $submission->status_label,
                $submission->status_keterangan,
            ]));
            $submission->documents = ($documents->get($submission->id) ?? collect())
                ->map(function ($document) {
                    $document->label = match ($document->jenis_dokumen) {
                        'naskah' => 'Naskah lengkap',
                        'pengesahan' => 'Lembar pengesahan',
                        'orisinalitas' => 'Pernyataan orisinalitas',
                        default => str($document->jenis_dokumen)->replace('_', ' ')->title(),
                    };
                    $document->download_url = route('mahasiswa.riwayat.document', ['documentId' => $document->id]);

                    return $document;
                });
        }

        return view('mahasiswa.riwayat', compact('submissions'));
    }

    public function downloadDocument(Request $request, int $documentId)
    {
        $mahasiswa = $this->currentMahasiswa($request);
        $document = DB::table('pengajuan_bebas_pustaka_dokumen as dokumen')
            ->join('pengajuan_bebas_pustaka as pengajuan', 'pengajuan.id', '=', 'dokumen.pengajuan_id')
            ->where('dokumen.id', $documentId)
            ->where('pengajuan.nim', $mahasiswa->nim)
            ->first(['dokumen.path', 'dokumen.nama_asli']);

        abort_unless($document && Storage::disk('local')->exists($document->path), 404);

        return Storage::disk('local')->download($document->path, $document->nama_asli);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul_karya' => ['required', 'string', 'max:200'],
            'jenis_karya' => ['required', 'in:skripsi,tesis,disertasi,tugas_akhir'],
            'tahun_lulus' => ['required', 'integer', 'between:1990,2035'],
            'abstrak' => ['required', 'string', 'max:2000'],
            'kata_kunci' => ['required', 'string', 'max:2000'],
            'dosen_pembimbing_id' => ['required', 'integer', 'exists:dosen,id_dosen'],
            'dosen_pembimbing_2_id' => ['required', 'integer', 'different:dosen_pembimbing_id', 'exists:dosen,id_dosen'],
            'akses_naskah' => ['required', 'in:open,restricted,embargo'],
            'file_naskah' => ['required', 'file', 'mimes:pdf', 'max:10240'],
            'file_pengesahan' => ['required', 'file', 'mimes:pdf', 'max:10240'],
            'file_orisinalitas' => ['required', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        $user = $request->user('mahasiswa');
        $mahasiswa = $user?->mahasiswa;

        if (! $mahasiswa) {
            abort(403, 'Akun ini tidak terhubung dengan data mahasiswa.');
        }

        $storedPaths = [];
        $nomorPengajuan = 'BP-'.now()->format('Y').'-'.Str::upper(Str::random(12));

        try {
            $pengajuanId = DB::transaction(function () use ($request, $validated, $user, $mahasiswa, $nomorPengajuan, &$storedPaths) {
                $now = now();
                $pengajuanId = DB::table('pengajuan_bebas_pustaka')->insertGetId([
                    'nomor_pengajuan' => $nomorPengajuan,
                    'nim' => $mahasiswa->nim,
                    'user_id' => $user->id,
                    'judul_karya' => $validated['judul_karya'],
                    'jenis_karya' => $validated['jenis_karya'],
                    'tahun_lulus' => $validated['tahun_lulus'],
                    'abstrak' => $validated['abstrak'],
                    'kata_kunci' => $validated['kata_kunci'],
                    'dosen_pembimbing_id' => $validated['dosen_pembimbing_id'],
                    'dosen_pembimbing_2_id' => $validated['dosen_pembimbing_2_id'],
                    'akses_naskah' => $validated['akses_naskah'],
                    'tanggal_diajukan' => $now,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                foreach ([
                    'file_naskah' => 'naskah',
                    'file_pengesahan' => 'pengesahan',
                    'file_orisinalitas' => 'orisinalitas',
                ] as $field => $jenisDokumen) {
                    $file = $request->file($field);
                    $path = $file->store("pengajuan-bebas-pustaka/{$pengajuanId}", 'local');

                    if (! $path) {
                        throw new RuntimeException('Berkas pengajuan gagal disimpan.');
                    }

                    $storedPaths[] = $path;

                    DB::table('pengajuan_bebas_pustaka_dokumen')->insert([
                        'pengajuan_id' => $pengajuanId,
                        'jenis_dokumen' => $jenisDokumen,
                        'nama_asli' => $file->getClientOriginalName(),
                        'path' => $path,
                        'mime_type' => $file->getMimeType() ?: 'application/pdf',
                        'ukuran_bytes' => $file->getSize(),
                        'sha256' => hash_file('sha256', $file->getRealPath()) ?: null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }

                return $pengajuanId;
            });
        } catch (Throwable $exception) {
            Storage::disk('local')->delete($storedPaths);

            throw $exception;
        }

        return redirect()
            ->route('mahasiswa.ajukan')
            ->with('success', "Pengajuan {$nomorPengajuan} berhasil disimpan.");
    }

    private function currentMahasiswa(Request $request): Mahasiswa
    {
        $mahasiswa = $request->user('mahasiswa')?->mahasiswa;

        abort_unless($mahasiswa, 403, 'Akun ini tidak terhubung dengan data mahasiswa.');

        return $mahasiswa;
    }

    private function statusPresentation(string $status): array
    {
        return match ($status) {
            'menunggu_review', 'diproses' => [
                'label' => 'Diproses',
                'filter' => 'diproses',
                'badge' => 'border-amber-200/60 bg-[#fef6e7] text-[#975a16]',
                'dot' => 'bg-[#d69e2e]',
            ],
            'menunggu_koreksi', 'perlu_revisi' => [
                'label' => 'Perlu revisi',
                'filter' => 'perlu_revisi',
                'badge' => 'border-rose-200/60 bg-[#fdf2f2] text-[#9b1c1c]',
                'dot' => 'bg-[#e02424]',
            ],
            'disetujui' => [
                'label' => 'Disetujui',
                'filter' => 'disetujui',
                'badge' => 'border-emerald-200/60 bg-emerald-50 text-emerald-800',
                'dot' => 'bg-emerald-500',
            ],
            'selesai' => [
                'label' => 'Selesai',
                'filter' => 'selesai',
                'badge' => 'border-sky-200 bg-sky-50 text-sky-800',
                'dot' => 'bg-sky-500',
            ],
            'ditolak' => [
                'label' => 'Ditolak',
                'filter' => 'ditolak',
                'badge' => 'border-rose-200/60 bg-[#fdf2f2] text-[#9b1c1c]',
                'dot' => 'bg-[#e02424]',
            ],
            'dibatalkan' => [
                'label' => 'Dibatalkan',
                'filter' => 'dibatalkan',
                'badge' => 'border-slate-200 bg-slate-100 text-slate-700',
                'dot' => 'bg-slate-500',
            ],
            default => [
                'label' => str($status)->replace('_', ' ')->title(),
                'filter' => $status,
                'badge' => 'border-slate-200 bg-slate-100 text-slate-700',
                'dot' => 'bg-slate-500',
            ],
        };
    }
}
