<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Panel Pustakawan - Perpustakaan UNISMA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        botanical: {
                            900: '#0d281e',
                            850: '#12382c',
                            800: '#164233',
                            700: '#1b4d3e',
                            600: '#236350',
                            500: '#2f7d66',
                        },
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#f4f7f5] font-sans text-slate-800 antialiased selection:bg-botanical-700 selection:text-white">
    <div class="min-h-screen lg:flex">
        <x-staff.sidebar active="dashboard" :waiting-count="$waitingCount" />

        <main class="min-w-0 flex-1" data-purpose="main-layout">
            <x-staff.header title="Dashboard" :current-date="$currentDate" :waiting-count="$waitingCount" />

            <div class="mx-auto max-w-[1400px] space-y-8 p-5 sm:p-8 lg:p-10">
                <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4" aria-label="Statistik pengajuan" data-purpose="stat-metrics">
                    <article class="group relative overflow-hidden rounded-xl border border-slate-200/90 bg-white p-6 shadow-sm transition-shadow hover:shadow-md">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total pengajuan</p>
                                <h3 class="mt-3 font-serif text-4xl font-bold text-slate-900 transition-colors group-hover:text-botanical-700">{{ $totalCount }}</h3>
                            </div>
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-800 shadow-sm">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                        <p class="mt-4 text-xs font-medium text-slate-400">Seluruh berkas masuk</p>
                    </article>
                    <article class="group relative overflow-hidden rounded-xl border border-slate-200/90 bg-white p-6 shadow-sm transition-shadow hover:shadow-md">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Menunggu verifikasi</p>
                                <h3 class="mt-3 font-serif text-4xl font-bold text-amber-600">{{ $waitingCount }}</h3>
                            </div>
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl border border-amber-100 bg-amber-50 text-amber-600 shadow-sm">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                        <p class="mt-4 text-xs font-medium text-amber-600/90">Perlu tindakan verifikasi</p>
                    </article>
                    <article class="group relative overflow-hidden rounded-xl border border-slate-200/90 bg-white p-6 shadow-sm transition-shadow hover:shadow-md">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Disetujui / selesai</p>
                                <h3 class="mt-3 font-serif text-4xl font-bold text-emerald-700">{{ $approvedCount }}</h3>
                            </div>
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-700 shadow-sm">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                        <p class="mt-4 text-xs font-medium text-emerald-700/90">Pengajuan lengkap</p>
                    </article>
                    <article class="group relative overflow-hidden rounded-xl border border-slate-200/90 bg-white p-6 shadow-sm transition-shadow hover:shadow-md">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Ditolak / revisi</p>
                                <h3 class="mt-3 font-serif text-4xl font-bold text-rose-600">{{ $revisionCount }}</h3>
                            </div>
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl border border-rose-100 bg-rose-50 text-rose-600 shadow-sm">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                        <p class="mt-4 text-xs font-medium text-rose-600/90">Perlu perbaikan mahasiswa</p>
                    </article>
                </section>

                <section class="grid grid-cols-1 items-start gap-7 lg:grid-cols-12" data-purpose="status-and-submissions-grid">
                    <article class="rounded-xl border border-slate-200/90 bg-white p-6 shadow-sm lg:col-span-4" data-purpose="status-composition-panel">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <h3 class="font-serif text-lg font-bold text-slate-900">Komposisi status</h3>
                            <span class="text-xs font-medium text-slate-400">Total {{ $totalCount }}</span>
                        </div>
                        <div class="mt-6 space-y-6">
                            @forelse ($statusComposition as $status)
                                <div>
                                    <div class="mb-2 flex items-center justify-between gap-3 text-sm font-medium">
                                        <span class="font-semibold text-slate-700">{{ $status['label'] }}</span>
                                        <span class="shrink-0 text-slate-500">{{ $status['count'] }} <span class="text-xs text-slate-400">({{ $status['percentage'] }}%)</span></span>
                                    </div>
                                    <div class="h-3 w-full overflow-hidden rounded-full bg-slate-100 p-0.5">
                                        <div class="h-full rounded-full {{ $status['color'] }} transition-all duration-500" style="width: {{ $status['percentage'] }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-slate-500">Belum ada data pengajuan.</p>
                            @endforelse
                        </div>
                        <div class="mt-8 flex gap-3 rounded-xl border border-emerald-100 bg-emerald-50/70 p-4 text-xs leading-relaxed text-emerald-900">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <p>Daftar dan persentase diperbarui berdasarkan status pengajuan yang tersimpan.</p>
                        </div>
                    </article>

                    <article id="pengajuan-terbaru" class="scroll-mt-28 rounded-xl border border-slate-200/90 bg-white p-6 shadow-sm lg:col-span-8" data-purpose="recent-submissions-panel">
                        <div class="flex items-center justify-between gap-4 border-b border-slate-100 pb-4">
                            <h3 class="font-serif text-lg font-bold text-slate-900">Pengajuan terbaru</h3>
                            <span class="text-xs font-medium text-slate-500">{{ $recentSubmissions->count() }} terbaru</span>
                        </div>
                        <div class="mt-4 divide-y divide-slate-100" data-purpose="submissions-list">
                            @forelse ($recentSubmissions as $submission)
                                <div class="flex items-center justify-between gap-4 rounded-lg px-3 py-4 transition hover:bg-slate-50/60">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="text-sm font-semibold text-slate-900">{{ $submission->nama_mahasiswa ?? 'Data mahasiswa tidak ditemukan' }}</span>
                                            <span class="text-xs text-slate-400">·</span>
                                            <span class="font-mono text-xs text-slate-500">{{ $submission->nim }}</span>
                                        </div>
                                        <p class="mt-1 truncate text-xs text-slate-600" title="{{ $submission->judul_karya }}">{{ $submission->judul_karya }}</p>
                                        <p class="mt-1 font-mono text-[11px] text-slate-400">{{ $submission->nomor_pengajuan }}</p>
                                    </div>
                                    <div class="flex shrink-0 flex-col items-end gap-2 sm:flex-row sm:items-center sm:gap-4">
                                        <span class="hidden text-xs text-slate-400 sm:inline-block">{{ $submission->tanggal_label }}</span>
                                        <span class="inline-flex rounded-full border px-3 py-1 text-xs font-medium {{ $submission->status_class }}">{{ $submission->status_label }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="py-12 text-center">
                                    <p class="text-sm font-semibold text-slate-700">Belum ada pengajuan</p>
                                    <p class="mt-1 text-xs text-slate-500">Pengajuan mahasiswa akan muncul di sini setelah dikirim.</p>
                                </div>
                            @endforelse
                        </div>
                    </article>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
