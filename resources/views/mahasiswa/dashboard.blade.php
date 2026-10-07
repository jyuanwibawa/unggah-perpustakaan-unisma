<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan UNISMA - Pengajuan Bebas Pustaka</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts: Playfair Display & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- External Theme Config & Styles -->
    <script src="{{ asset('js/dashboard-theme.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="text-slate-800 antialiased h-screen overflow-hidden flex bg-[#f6f8f7]">
    <x-mahasiswa.sidebar active="dashboard" />

    <!-- BEGIN: Main Content Area -->
    <div class="flex-1 h-screen flex flex-col min-w-0 overflow-y-auto">
        <x-mahasiswa.header title="Beranda" />

        <!-- BEGIN: Dashboard Workspace -->
        <main class="p-5 sm:p-8 lg:p-10 max-w-7xl w-full mx-auto space-y-6 sm:space-y-7">
            <!-- Page Title & Information -->
            <section class="space-y-2" data-purpose="page-title-banner">
                <h2 class="font-academic text-3xl md:text-4xl font-bold tracking-tight text-[#133a2d]">
                    Pengajuan bebas pustaka
                </h2>
                <p class="text-slate-600 text-sm md:text-base leading-relaxed max-w-3xl">
                    Pantau status pengajuan Anda di sini. Petugas perpustakaan akan memeriksa berkas dan memberi kabar lewat halaman ini.
                </p>
            </section>

            <section class="rounded-xl border border-slate-200/90 bg-white p-5 shadow-sm sm:p-8" data-purpose="stepper-card">
                <div class="mb-6 flex flex-col gap-2 border-b border-slate-100 pb-5 sm:mb-8 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="font-academic text-xl font-bold text-[#133a2d]">Status pengajuan terakhir</h3>
                    @if ($latestSubmission)
                        <span class="text-xs font-medium text-slate-500 md:text-sm">Dikirim {{ $latestSubmission->tanggal_label }}</span>
                    @else
                        <span class="text-xs font-medium text-slate-500 md:text-sm">Belum ada pengajuan</span>
                    @endif
                </div>

                @if ($latestSubmission)
                    <div class="relative py-2">
                        <div class="relative z-10 grid grid-cols-2 gap-y-6 sm:grid-cols-4 sm:gap-y-0">
                            @foreach ([['Diajukan', 'Berkas sudah terkirim'], ['Diperiksa petugas', 'Menunggu pemeriksaan'], ['Disetujui', 'Berkas dinyatakan lengkap'], ['Selesai', 'Proses bebas pustaka selesai']] as $index => [$stepTitle, $stepDescription])
                                @php
                                    $stepNumber = $index + 1;
                                    $isComplete = $stepNumber < $currentStep || $currentStep === 4;
                                    $isCurrent = $stepNumber === $currentStep && $currentStep < 4;
                                @endphp
                                <div class="relative flex flex-col items-center text-center sm:items-start sm:text-left">
                                    @if ($stepNumber < 4)
                                        <div class="absolute left-5 top-4 -z-10 hidden h-[3px] w-full sm:block {{ $stepNumber < $currentStep ? 'bg-[#1b4d3e]' : 'bg-slate-200' }}"></div>
                                    @endif
                                    <div class="mb-3.5 flex h-9 w-9 items-center justify-center rounded-full text-sm font-bold {{ $isComplete ? 'bg-[#1b4d3e] text-white shadow-md shadow-emerald-900/10' : ($isCurrent ? 'border-2 border-[#b57d19] bg-[#fdf8ee] text-[#b57d19] shadow-sm' : 'border-2 border-slate-300 bg-white text-slate-400') }}">
                                        @if ($isComplete)
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                        @else
                                            {{ $stepNumber }}
                                        @endif
                                    </div>
                                    <h4 class="text-sm leading-snug {{ $isCurrent || $isComplete ? 'font-bold text-slate-900' : 'font-semibold text-slate-700' }}">{{ $stepTitle }}</h4>
                                    <p class="mt-0.5 text-xs {{ $isCurrent ? 'text-amber-800' : 'text-slate-500' }}">
                                        @if ($stepNumber === 1)
                                            {{ $latestSubmission->tanggal_label }}
                                        @elseif ($isCurrent)
                                            {{ $latestStatus['label'] }}
                                        @else
                                            {{ $stepDescription }}
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm leading-relaxed text-slate-600">Anda belum memiliki pengajuan bebas pustaka.</p>
                        <a class="inline-flex items-center justify-center rounded-lg bg-[#1b4d3e] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#143e31]" href="{{ route('mahasiswa.ajukan') }}">Buat pengajuan</a>
                    </div>
                @endif
            </section>

            <!-- Bottom Split Columns Cards -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <!-- Card Left: Status & Action -->
                <article class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-5 sm:p-8 flex flex-col justify-between" data-purpose="status-detail-card">
                    <div>
                        @if ($latestSubmission)
                            <div class="mb-4 flex flex-wrap items-center gap-3">
                                <h3 class="font-academic text-xl font-bold text-[#133a2d]">{{ $latestStatus['label'] }}</h3>
                                <span class="rounded-full border px-3 py-1 text-xs font-semibold {{ $latestStatus['badge'] }}">{{ $latestSubmission->nomor_pengajuan }}</span>
                            </div>
                            <p class="mb-3 text-base font-semibold leading-relaxed text-slate-800">{{ $latestSubmission->judul_karya }}</p>
                            <p class="mb-6 text-sm leading-relaxed text-slate-600">{{ $latestStatusNote }}</p>
                        @else
                            <h3 class="mb-3 font-academic text-xl font-bold text-[#133a2d]">Belum ada pengajuan</h3>
                            <p class="mb-6 text-sm leading-relaxed text-slate-600">Status proses bebas pustaka akan ditampilkan di sini setelah Anda mengirim pengajuan.</p>
                        @endif
                    </div>
                    <div>
                        <a class="inline-flex items-center justify-center rounded-lg bg-[#1b4d3e] px-6 py-2.5 text-sm font-semibold text-white shadow transition-all hover:bg-[#143e31] hover:shadow-md active:scale-[0.98]" href="{{ $latestSubmission ? route('mahasiswa.riwayat') : route('mahasiswa.ajukan') }}">
                            {{ $latestSubmission ? 'Lihat riwayat' : 'Ajukan bebas pustaka' }}
                        </a>
                    </div>
                </article>

                <!-- Card Right: Tanggungan Pustaka (Clearance Summary) -->
                <article class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-5 sm:p-8 flex flex-col justify-between" data-purpose="clearance-summary-card">
                    <div>
                        <!-- Header with Badge -->
                        <div class="flex items-center justify-between mb-6 pb-2">
                            <h3 class="font-academic text-xl font-bold text-[#133a2d]">Ringkasan pengajuan</h3>
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700">{{ $submissionCount }} total</span>
                        </div>

                        <!-- Clearance Rows -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-sm py-1 border-b border-slate-100">
                                <span class="text-slate-600">Sedang diproses</span>
                                <span class="font-mono text-base font-semibold text-slate-900">{{ $processingCount }}</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-slate-100 py-1 text-sm">
                                <span class="text-slate-600">Disetujui</span>
                                <span class="font-mono text-base font-semibold text-slate-900">{{ $approvedCount }}</span>
                            </div>
                            <div class="flex items-center justify-between py-1 text-sm">
                                <span class="text-slate-600">Selesai</span>
                                <span class="font-mono text-base font-semibold text-slate-900">{{ $completedCount }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Micro Note -->
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <p class="text-xs italic text-slate-400">Angka dihitung dari pengajuan Anda yang tersimpan.</p>
                    </div>
                </article>
            </div>
        </main>
        <!-- END: Dashboard Workspace -->
    </div>
    <!-- END: Main Content Area -->
</body>
</html>
