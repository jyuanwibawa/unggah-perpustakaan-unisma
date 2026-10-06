<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="shell-type" content="web_blank">
    <title>Login Staf Perpustakaan - Universitas Islam Malang</title>

    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Style & Tailwind Configuration -->
    <style>
        @layer base {
            html, body {
                margin: 0;
                padding: 0;
                height: 100%;
            }
            body {
                overscroll-behavior: none;
            }
            main > :first-child {
                margin-top: 0 !important;
            }
            main > :last-child {
                margin-bottom: 0 !important;
            }
        }
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "inverse-on-surface": "#e8f4eb",
                        "on-primary-fixed": "#002117",
                        "background": "#f1fcf4",
                        "primary": "#003629",
                        "on-tertiary-container": "#9fb9a4",
                        "on-primary-container": "#8abda9",
                        "surface-bright": "#f1fcf4",
                        "inverse-primary": "#9ed1bd",
                        "outline-variant": "#c0c9c3",
                        "surface-dim": "#d1ddd5",
                        "secondary-container": "#92f7c3",
                        "primary-fixed": "#baeed9",
                        "primary-container": "#1b4d3e",
                        "on-secondary-fixed": "#002113",
                        "tertiary": "#1d3324",
                        "surface-container-low": "#ebf6ee",
                        "surface-variant": "#dae5dd",
                        "on-tertiary-fixed-variant": "#354c3b",
                        "on-tertiary-fixed": "#092012",
                        "tertiary-container": "#334a39",
                        "surface-container-highest": "#dae5dd",
                        "on-error-container": "#93000a",
                        "secondary-fixed": "#92f7c3",
                        "inverse-surface": "#29332d",
                        "surface": "#f1fcf4",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#b3cdb7",
                        "on-secondary": "#ffffff",
                        "secondary": "#006c48",
                        "surface-container": "#e5f1e9",
                        "primary-fixed-dim": "#9ed1bd",
                        "on-primary-fixed-variant": "#1d4f40",
                        "on-error": "#ffffff",
                        "error": "#ba1a1a",
                        "on-surface": "#141e19",
                        "on-tertiary": "#ffffff",
                        "surface-container-high": "#e0ebe3",
                        "on-background": "#141e19",
                        "secondary-fixed-dim": "#75daa8",
                        "error-container": "#ffdad6",
                        "on-secondary-container": "#00734d",
                        "tertiary-fixed": "#cee9d3",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed-variant": "#005235",
                        "on-surface-variant": "#404945",
                        "surface-tint": "#376757",
                        "outline": "#707974"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Playfair Display", "serif"],
                        "headline-md": ["Playfair Display", "serif"],
                        "headline-sm": ["Playfair Display", "serif"],
                        "display-lg": ["Playfair Display", "serif"],
                        "body-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
                        "body-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "title-md": ["Plus Jakarta Sans", "sans-serif"],
                        "title-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "label-md": ["Plus Jakarta Sans", "sans-serif"],
                        "label-sm": ["Plus Jakarta Sans", "sans-serif"]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface-container-lowest font-body-md text-on-surface antialiased h-full">
    <main class="w-full min-h-screen h-full bg-surface-container-lowest flex flex-col lg:flex-row overflow-x-hidden">
        <!-- Section Kiri: Branding & Informasi Pustakawan -->
        <div class="w-full lg:w-[48%] xl:w-[45%] relative flex flex-col justify-between p-8 sm:p-12 lg:p-16 text-on-primary min-h-[520px] lg:min-h-screen bg-primary overflow-hidden shadow-2xl z-10">
            <div class="absolute inset-0 bg-cover bg-center scale-105 transition-transform duration-1000 ease-out" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAVlK7F7KTBrU4NfEAoxe5EjsoFCbCLG1QEnZkeywNRlk8qXBtospIr5fLs3PXTii1Klmh3aLQ-JUWE8AoH4ebX5LKaVLfIdShd5tJLFiCDtsDFDYTpIMiLP8MGZKz6OKl3QTxUIdXPSXnCOKn_nrg1xh59GkFtljp31_gITDjxye4XFDcbHrEPd5xdkFv8k-zlI-ZUzVeV8QYv8dEQx0kHLX5wgFQyT557G4jzzFNfUC4zT_XiniIyw6YI1ORIVwEIa14');"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-[#00261d]/95 via-[#1b4d3e]/88 to-[#0a3124]/80 backdrop-blur-[0.5px]"></div>
            
            <div class="relative z-10 flex flex-col items-start">
                <div class="flex items-center gap-4 group">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-white/10 backdrop-blur-md p-2.5 flex items-center justify-center border border-white/20 shadow-lg ring-1 ring-white/10 transition-transform duration-300 group-hover:scale-105">
                        <img alt="Logo Universitas Islam Malang UNISMA" class="w-full h-full object-contain filter drop-shadow-md" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8nXzTBXrEktlkoetBg5Jz7nvC0f7mtN8QtDFTHybBvY_dpW8Ymcpuu35NVjmq1z5AUyfZYfZPfkU8QBlNZcGHXWXFntG1-cgjHtbpH_u8nAT8BUiO30dCwQZzAB7lU6V3CbP9viW3AXuP3YZN7Bs_qN9iN-1sZ9Bwb6Kco0R8GVhDzRzu5g8MC8u-nWZCKDoCpsSAAJxdP3ud88xpxklYlj1LQHo4p6c6D8DtcNXtHbJ_2EqlXSQQF8I-Bq6n1panjq0">
                    </div>
                    <div>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] tracking-wider uppercase font-semibold bg-secondary-container/20 text-secondary-container border border-secondary-container/30 mb-1">Perpustakaan Pusat</span>
                        <h2 class="font-headline-md text-2xl sm:text-3xl text-white tracking-tight leading-tight drop-shadow-sm font-semibold">Perpustakaan UNISMA</h2>
                        <p class="font-label-md text-xs sm:text-sm tracking-wide text-primary-fixed-dim/90 font-medium">Universitas Islam Malang</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 my-auto py-10 lg:py-12 max-w-lg">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-12 h-1 rounded-full bg-secondary-container"></div>
                    <div class="w-2 h-1 rounded-full bg-secondary-container/60"></div>
                </div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-secondary-container/20 text-secondary-container border border-secondary-container/30 mb-5">
                    <span class="material-symbols-outlined text-sm">admin_panel_settings</span> Portal Administrasi &amp; Sirkulasi
                </div>
                <h1 class="font-headline-lg text-3xl sm:text-4xl xl:text-[42px] leading-tight text-white font-normal italic mb-5 drop-shadow-sm tracking-tight">“Menjaga khazanah ilmu pengetahuan dan integritas literasi civitas akademika.”</h1>
                <p class="font-body-md text-sm sm:text-base text-primary-fixed-dim/90 leading-relaxed font-normal max-w-md">Akses otorisasi staf perpustakaan untuk manajemen peminjaman, pengembalian, kurasi repositori digital, dan verifikasi kelulusan bebas pustaka UNISMA.</p>
                <div class="mt-6 flex flex-wrap items-center gap-2.5 text-xs text-primary-fixed-dim/90">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-black/20 border border-white/10 backdrop-blur-sm">
                        <span class="material-symbols-outlined text-sm text-secondary-container">point_of_sale</span> Meja Sirkulasi Aktif
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-black/20 border border-white/10 backdrop-blur-sm">
                        <span class="material-symbols-outlined text-sm text-secondary-container">security</span> Terminal Terenkripsi
                    </span>
                </div>
            </div>

            <div class="relative z-10 pt-6 border-t border-white/15 grid grid-cols-3 gap-4 text-primary-fixed-dim">
                <div class="flex flex-col">
                    <span class="font-label-md text-xs sm:text-sm font-semibold text-white tracking-tight">Shift Pagi</span>
                    <span class="text-[11px] tracking-wide text-primary-fixed-dim/80 font-medium mt-0.5">07.30 - 15.00 WIB</span>
                </div>
                <div class="flex flex-col border-l border-white/15 pl-4 sm:pl-6">
                    <span class="font-label-md text-xs sm:text-sm font-semibold text-white tracking-tight">Terminal 03</span>
                    <span class="text-[11px] tracking-wide text-primary-fixed-dim/80 font-medium mt-0.5">Sirkulasi Lantai 1</span>
                </div>
                <div class="flex flex-col border-l border-white/15 pl-4 sm:pl-6">
                    <span class="font-label-md text-xs sm:text-sm font-semibold text-white tracking-tight">v4.8.2</span>
                    <span class="text-[11px] tracking-wide text-primary-fixed-dim/80 font-medium mt-0.5">SIMPus Enterprise</span>
                </div>
            </div>
        </div>

        <!-- Section Kanan: Form Login Staf Pustakawan -->
        <div class="w-full lg:w-[52%] xl:w-[55%] flex flex-col justify-between p-8 sm:p-12 lg:p-16 xl:p-20 bg-surface-container-lowest min-h-screen overflow-y-auto">
            <div class="w-full max-w-lg mx-auto my-auto py-4">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-surface-container-low text-secondary border border-outline-variant/40 mb-3">
                            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span> Sistem Terpadu SIMPus
                        </div>
                        <h2 class="font-headline-lg text-3xl sm:text-4xl font-bold text-on-surface tracking-tight mb-2.5">Masuk Staf Pustakawan</h2>
                        <p class="font-body-md text-sm sm:text-base text-on-surface-variant">Silakan otentikasi identitas staf untuk mengelola sirkulasi, inventaris buku, dan verifikasi bebas pustaka.</p>
                    </div>
                </div>

                <form class="space-y-5" id="library-login-form" onsubmit="event.preventDefault(); simulateAuth();">
                    <div class="flex flex-col gap-1.5">
                        <div class="flex items-center justify-between text-xs">
                            <label class="font-label-md text-xs font-semibold text-on-surface" for="identifier">Nomor Induk Pegawai (NIP) / ID Petugas</label>
                            <span class="text-outline text-[11px]">Contoh: 198204152010121001 atau PST-UNISMA</span>
                        </div>
                        <div class="relative flex items-center rounded-xl border border-outline-variant/70 bg-surface-container-lowest hover:border-outline focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all shadow-sm">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-xl">badge</span>
                            <input class="w-full pl-11 pr-4 py-3 bg-transparent rounded-xl font-body-md text-sm text-on-surface placeholder:text-outline/70 focus:outline-none" id="identifier" name="identifier" placeholder="Contoh: 198204152010121001 atau PST-UNISMA" required type="text">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <div class="flex items-center justify-between text-xs">
                            <label class="font-label-md text-xs font-semibold text-on-surface" for="password">Kata Sandi Kredensial Staf</label>
                            <a class="font-label-sm text-xs font-semibold text-secondary hover:text-primary hover:underline transition-colors" href="#">Lupa Sandi Staf?</a>
                        </div>
                        <div class="relative flex items-center rounded-xl border border-outline-variant/70 bg-surface-container-lowest hover:border-outline focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all shadow-sm">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-xl">lock</span>
                            <input class="w-full pl-11 pr-12 py-3 bg-transparent rounded-xl font-body-md text-sm text-on-surface placeholder:text-outline/70 focus:outline-none" id="password" name="password" placeholder="Masukkan kata sandi otentikasi" required type="password">
                            <button aria-label="Lihat kata sandi" class="absolute right-3.5 p-1.5 text-outline hover:text-on-surface transition-colors focus:outline-none rounded-lg" onclick="togglePasswordVisibility()" type="button">
                                <span class="material-symbols-outlined text-xl" id="eye-icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-xs font-semibold text-on-surface" for="workstation">Unit Meja Layanan / Stasiun Kerja</label>
                        <div class="relative flex items-center rounded-xl border border-outline-variant/70 bg-surface-container-lowest hover:border-outline focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all shadow-sm">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-xl">desk</span>
                            <select class="w-full pl-11 pr-8 py-3 bg-transparent rounded-xl font-body-md text-sm text-on-surface focus:outline-none cursor-pointer appearance-none" id="workstation" name="workstation">
                                <option value="circ-1">Meja Sirkulasi Utama (Lt. 1 Gedung KH. Abdurrahman Wahid)</option>
                                <option value="circ-return">Meja Pengembalian &amp; Denda (Lt. 1)</option>
                                <option value="lib-clearance">Meja Validasi Bebas Pustaka &amp; Repositori (Lt. 2)</option>
                                <option value="thesis-room">Ruang Koleksi Khusus &amp; Skripsi (Lt. 3)</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-3.5 text-outline text-lg pointer-events-none">expand_more</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2.5 cursor-pointer select-none text-xs sm:text-sm text-on-surface-variant hover:text-on-surface">
                            <input class="w-4 h-4 rounded text-primary accent-primary cursor-pointer border-outline-variant" id="remember-me" type="checkbox">
                            <span>Kunci sesi pada stasiun kerja ini</span>
                        </label>
                        <span class="text-[11px] text-outline flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">verified_user</span> Audit Trail Terlindungi
                        </span>
                    </div>

                    <button class="w-full mt-2 py-3.5 px-6 rounded-xl font-label-md text-sm font-semibold text-on-primary bg-primary hover:bg-[#1b4d3e] shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 active:scale-[0.99] cursor-pointer" id="submit-btn" type="submit">
                        <span id="submit-text">Masuk ke Sistem Sirkulasi</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function togglePasswordVisibility() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                pwd.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        function simulateAuth() {
            const btn = document.getElementById('submit-btn');
            const text = document.getElementById('submit-text');
            if (!btn || !text) return;
            const originalText = text.textContent;
            btn.disabled = true;
            text.textContent = 'Memverifikasi Akses...';
            btn.classList.add('opacity-80');

            setTimeout(() => {
                text.textContent = 'Akses Diberikan. Membuka...';
                btn.classList.remove('bg-primary');
                btn.classList.add('bg-secondary');
                setTimeout(() => {
                    text.textContent = originalText;
                    btn.disabled = false;
                    btn.classList.remove('opacity-80', 'bg-secondary');
                    btn.classList.add('bg-primary');
                }, 1500);
            }, 1200);
        }
    </script>
</body>
</html>
