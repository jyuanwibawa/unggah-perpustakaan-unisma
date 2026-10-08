<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StaffVerificationController extends Controller
{
    public function index(Request $request)
    {
        $selectedStatus = $request->query('status', 'all');
        $query = DB::table('pengajuan_bebas_pustaka as pengajuan')
            ->leftJoin('mahasiswa', 'mahasiswa.nim', '=', 'pengajuan.nim')
            ->leftJoin('alur_pengajuan', 'alur_pengajuan.kode_status', '=', 'pengajuan.status')
            ->orderByDesc('pengajuan.tanggal_diajukan');

        if ($selectedStatus === 'diproses') {
            $query->whereIn('pengajuan.status', ['menunggu_review', 'diproses']);
        } elseif ($selectedStatus === 'disetujui') {
            $query->whereIn('pengajuan.status', ['disetujui', 'selesai']);
        } elseif ($selectedStatus === 'ditolak') {
            $query->whereIn('pengajuan.status', ['menunggu_koreksi', 'perlu_revisi', 'ditolak']);
        } elseif ($selectedStatus !== 'all') {
            $selectedStatus = 'all';
        }

        $submissions = $query->get([
            'pengajuan.id',
            'pengajuan.nomor_pengajuan',
            'pengajuan.nim',
            'pengajuan.judul_karya',
            'pengajuan.jenis_karya',
            'pengajuan.status',
            'pengajuan.status_keterangan',
            'pengajuan.tanggal_diajukan',
            'mahasiswa.nama as nama_mahasiswa',
            'mahasiswa.prodi',
            'alur_pengajuan.nama_tahap',
        ]);

        $documents = DB::table('pengajuan_bebas_pustaka_dokumen')
            ->whereIn('pengajuan_id', $submissions->pluck('id'))
            ->orderBy('jenis_dokumen')
            ->get()
            ->groupBy('pengajuan_id');

        foreach ($submissions as $submission) {
            $submission->tanggal_label = Carbon::parse($submission->tanggal_diajukan)
                ->locale('id')
                ->translatedFormat('j M Y');
            $submission->jenis_karya_label = str($submission->jenis_karya)->replace('_', ' ')->title();
            $submission->status_label = match ($submission->status) {
                'menunggu_review', 'diproses' => 'Diproses',
                'menunggu_koreksi', 'perlu_revisi' => 'Perlu revisi',
                'disetujui' => 'Disetujui',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak',
                'dibatalkan' => 'Dibatalkan',
                default => $submission->nama_tahap ?: str($submission->status)->replace('_', ' ')->title(),
            };
            $submission->status_class = match ($submission->status) {
                'menunggu_review', 'diproses' => 'border-amber-200 bg-amber-50 text-amber-700',
                'menunggu_koreksi', 'perlu_revisi', 'ditolak' => 'border-rose-200 bg-rose-50 text-rose-700',
                'disetujui', 'selesai' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                default => 'border-slate-200 bg-slate-50 text-slate-600',
            };
            $submission->documents = ($documents->get($submission->id) ?? collect())
                ->map(function ($document) {
                    $document->label = match ($document->jenis_dokumen) {
                        'naskah' => 'Naskah lengkap',
                        'pengesahan' => 'Lembar pengesahan',
                        'orisinalitas' => 'Surat pernyataan',
                        default => str($document->jenis_dokumen)->replace('_', ' ')->title(),
                    };
                    $document->download_url = route('staff.verifikasi.document', ['documentId' => $document->id]);

                    return $document;
                });
            $submission->can_review = in_array($submission->status, [
                'menunggu_review',
                'diproses',
                'menunggu_koreksi',
                'perlu_revisi',
            ], true);
        }

        $waitingCount = DB::table('pengajuan_bebas_pustaka')
            ->whereIn('status', ['menunggu_review', 'diproses'])
            ->count();

        return view('staff.verification', compact('submissions', 'selectedStatus', 'waitingCount'));
    }

    public function downloadDocument(int $documentId)
    {
        $document = DB::table('pengajuan_bebas_pustaka_dokumen')
            ->where('id', $documentId)
            ->first(['path', 'nama_asli']);

        abort_unless($document && Storage::disk('local')->exists($document->path), 404);

        return Storage::disk('local')->download($document->path, $document->nama_asli);
    }

    public function update(Request $request, int $submissionId): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:disetujui,menunggu_koreksi,ditolak'],
            'catatan' => ['required_if:status,menunggu_koreksi,ditolak', 'nullable', 'string', 'max:2000'],
        ]);

        $submission = DB::table('pengajuan_bebas_pustaka')
            ->where('id', $submissionId)
            ->first(['id', 'status']);

        abort_unless($submission, 404);

        if (! in_array($submission->status, ['menunggu_review', 'diproses', 'menunggu_koreksi', 'perlu_revisi'], true)) {
            return back()->withErrors(['status' => 'Pengajuan ini sudah tidak berada dalam antrean pemeriksaan.']);
        }

        $now = now();
        DB::table('pengajuan_bebas_pustaka')
            ->where('id', $submissionId)
            ->update([
                'status' => $validated['status'],
                'status_keterangan' => $validated['catatan'] ?? null,
                'tanggal_diperiksa' => $now,
                'tanggal_disetujui' => $validated['status'] === 'disetujui' ? $now : null,
                'updated_at' => $now,
            ]);

        return redirect()
            ->route('staff.verifikasi.index')
            ->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
