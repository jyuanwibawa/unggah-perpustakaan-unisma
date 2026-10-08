<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StaffDashboardController extends Controller
{
    public function __invoke()
    {
        $statusCounts = DB::table('pengajuan_bebas_pustaka')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $totalCount = (int) $statusCounts->sum();
        $waitingCount = (int) $statusCounts->only(['menunggu_review', 'diproses'])->sum();
        $approvedCount = (int) $statusCounts->only(['disetujui', 'selesai'])->sum();
        $revisionCount = (int) $statusCounts->only(['menunggu_koreksi', 'perlu_revisi', 'ditolak'])->sum();
        $otherCount = max($totalCount - $waitingCount - $approvedCount - $revisionCount, 0);

        $statusComposition = [
            ['label' => 'Menunggu verifikasi', 'count' => $waitingCount, 'color' => 'bg-amber-400'],
            ['label' => 'Disetujui / selesai', 'count' => $approvedCount, 'color' => 'bg-emerald-600'],
            ['label' => 'Ditolak / perlu revisi', 'count' => $revisionCount, 'color' => 'bg-rose-500'],
        ];

        if ($otherCount > 0) {
            $statusComposition[] = ['label' => 'Dibatalkan / lainnya', 'count' => $otherCount, 'color' => 'bg-slate-500'];
        }

        foreach ($statusComposition as &$status) {
            $status['percentage'] = $totalCount > 0 ? (int) round(($status['count'] / $totalCount) * 100) : 0;
        }
        unset($status);

        $recentSubmissions = DB::table('pengajuan_bebas_pustaka as pengajuan')
            ->leftJoin('mahasiswa', 'mahasiswa.nim', '=', 'pengajuan.nim')
            ->leftJoin('alur_pengajuan', 'alur_pengajuan.kode_status', '=', 'pengajuan.status')
            ->orderByDesc('pengajuan.tanggal_diajukan')
            ->limit(8)
            ->get([
                'pengajuan.nomor_pengajuan',
                'pengajuan.nim',
                'pengajuan.judul_karya',
                'pengajuan.status',
                'pengajuan.tanggal_diajukan',
                'mahasiswa.nama as nama_mahasiswa',
                'alur_pengajuan.nama_tahap',
            ]);

        foreach ($recentSubmissions as $submission) {
            $submission->tanggal_label = Carbon::parse($submission->tanggal_diajukan)
                ->locale('id')
                ->translatedFormat('j M Y');
            $submission->status_label = match ($submission->status) {
                'menunggu_review', 'diproses' => 'Menunggu verifikasi',
                'menunggu_koreksi', 'perlu_revisi' => 'Perlu revisi',
                'disetujui' => 'Disetujui',
                'selesai' => 'Selesai',
                'ditolak' => 'Ditolak',
                'dibatalkan' => 'Dibatalkan',
                default => $submission->nama_tahap ?: str($submission->status)->replace('_', ' ')->title(),
            };
            $submission->status_class = match ($submission->status) {
                'menunggu_review', 'diproses' => 'border-amber-200/80 bg-amber-50 text-amber-700',
                'menunggu_koreksi', 'perlu_revisi', 'ditolak' => 'border-rose-200 bg-rose-50 text-rose-700',
                'disetujui', 'selesai' => 'border-emerald-200 bg-emerald-50 text-emerald-800',
                default => 'border-slate-200 bg-slate-50 text-slate-700',
            };
        }

        return view('staff.dashboard', [
            'totalCount' => $totalCount,
            'waitingCount' => $waitingCount,
            'approvedCount' => $approvedCount,
            'revisionCount' => $revisionCount,
            'statusComposition' => $statusComposition,
            'recentSubmissions' => $recentSubmissions,
            'currentDate' => now()->locale('id')->translatedFormat('l, j F Y'),
        ]);
    }
}
