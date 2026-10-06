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
        <main class="p-10 max-w-7xl w-full mx-auto space-y-7">
            <!-- Page Title & Information -->
            <section class="space-y-2" data-purpose="page-title-banner">
                <h2 class="font-academic text-3xl md:text-4xl font-bold tracking-tight text-[#133a2d]">
                    Pengajuan bebas pustaka
                </h2>
                <p class="text-slate-600 text-sm md:text-base leading-relaxed max-w-3xl">
                    Pantau status pengajuan Anda di sini. Petugas perpustakaan akan memeriksa berkas dan memberi kabar lewat halaman ini.
                </p>
            </section>

            <!-- Stepper / Status Tracker Card -->
            <section class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-8" data-purpose="stepper-card">
                <div class="flex items-center justify-between border-b border-slate-100 pb-5 mb-8">
                    <h3 class="font-academic text-xl font-bold text-[#133a2d]">Status pengajuan terakhir</h3>
                    <span class="text-xs md:text-sm text-slate-500 font-medium">Dikirim 5 Oktober 2026</span>
                </div>

                <!-- 4 Steps Interactive Stepper Bar -->
                <div class="relative py-2">
                    <!-- Stepper Grid -->
                    <div class="grid grid-cols-4 relative z-10">
                        <!-- Step 1: Diajukan (Completed) -->
                        <div class="flex flex-col items-center sm:items-start text-center sm:text-left relative">
                            <!-- Connecting Line to Step 2 -->
                            <div class="hidden sm:block absolute top-4 left-5 w-full h-[3px] bg-[#1b4d3e] -z-10"></div>
                            <div class="w-9 h-9 rounded-full bg-[#1b4d3e] text-white flex items-center justify-center shadow-md shadow-emerald-900/10 mb-3.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <h4 class="text-sm font-bold text-slate-900 leading-snug">Diajukan</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Berkas sudah terkirim</p>
                        </div>

                        <!-- Step 2: Diperiksa Petugas (Active) -->
                        <div class="flex flex-col items-center sm:items-start text-center sm:text-left relative">
                            <!-- Connecting Line to Step 3 -->
                            <div class="hidden sm:block absolute top-4 left-5 w-full h-[3px] bg-slate-200 -z-10"></div>
                            <div class="w-9 h-9 rounded-full border-2 border-[#b57d19] bg-[#fdf8ee] text-[#b57d19] font-bold text-sm flex items-center justify-center shadow-sm mb-3.5">
                                2
                            </div>
                            <h4 class="text-sm font-bold text-slate-900 leading-snug">Diperiksa petugas</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Sedang diperiksa</p>
                        </div>

                        <!-- Step 3: Disetujui (Pending) -->
                        <div class="flex flex-col items-center sm:items-start text-center sm:text-left relative">
                            <!-- Connecting Line to Step 4 -->
                            <div class="hidden sm:block absolute top-4 left-5 w-full h-[3px] bg-slate-200 -z-10"></div>
                            <div class="w-9 h-9 rounded-full border-2 border-slate-300 bg-white text-slate-400 font-semibold text-sm flex items-center justify-center mb-3.5">
                                3
                            </div>
                            <h4 class="text-sm font-semibold text-slate-800 leading-snug">Disetujui</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Berkas dinyatakan lengkap</p>
                        </div>

                        <!-- Step 4: Surat Siap (Pending) -->
                        <div class="flex flex-col items-center sm:items-start text-center sm:text-left">
                            <div class="w-9 h-9 rounded-full border-2 border-slate-300 bg-white text-slate-400 font-semibold text-sm flex items-center justify-center mb-3.5">
                                4
                            </div>
                            <h4 class="text-sm font-semibold text-slate-800 leading-snug">Surat siap</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Surat dapat diunduh</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Bottom Split Columns Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Card Left: Status & Action -->
                <article class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-8 flex flex-col justify-between" data-purpose="status-detail-card">
                    <div>
                        <h3 class="font-academic text-xl font-bold text-[#133a2d] mb-3">
                            Pengajuan sedang diperiksa
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed mb-6">
                            Tidak ada yang perlu Anda lakukan sekarang. Status akan berubah di halaman ini dan Anda mendapat notifikasi.
                        </p>
                    </div>
                    <div>
                        <a class="inline-flex items-center justify-center px-6 py-2.5 rounded-xl bg-[#1b4d3e] text-white hover:bg-[#143e31] font-semibold text-sm shadow hover:shadow-md transition-all active:scale-[0.98]" href="#">
                            Lihat riwayat
                        </a>
                    </div>
                </article>

                <!-- Card Right: Tanggungan Pustaka (Clearance Summary) -->
                <article class="bg-white rounded-2xl border border-slate-200/90 shadow-sm p-8 flex flex-col justify-between" data-purpose="clearance-summary-card">
                    <div>
                        <!-- Header with Badge -->
                        <div class="flex items-center justify-between mb-6 pb-2">
                            <h3 class="font-academic text-xl font-bold text-[#133a2d]">
                                Tanggungan pustaka
                            </h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-[#e8f6ed] text-[#1b4d3e] border border-emerald-200/80">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#1b4d3e] mr-1.5"></span>
                                Bebas
                            </span>
                        </div>

                        <!-- Clearance Rows -->
                        <div class="space-y-4">
                            <!-- Item 1 -->
                            <div class="flex items-center justify-between text-sm py-1 border-b border-slate-100">
                                <span class="text-slate-600">Buku belum kembali</span>
                                <span class="font-semibold text-slate-900 font-mono text-base">0</span>
                            </div>
                            <!-- Item 2 -->
                            <div class="flex items-center justify-between text-sm py-1">
                                <span class="text-slate-600">Denda</span>
                                <span class="font-semibold text-slate-900 font-mono text-base">Rp0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Micro Note -->
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <p class="text-xs text-slate-400 italic">
                            Status diperbarui otomatis tersinkronisasi dengan SIPERPU UNISMA.
                        </p>
                    </div>
                </article>
            </div>
        </main>
        <!-- END: Dashboard Workspace -->
    </div>
    <!-- END: Main Content Area -->
</body>
</html>
