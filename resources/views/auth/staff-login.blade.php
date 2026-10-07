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

    <!-- External CSS & Scripts -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="{{ asset('js/tailwind-theme.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}" defer></script>
</head>
<body class="bg-surface-container-lowest font-body-md text-on-surface antialiased h-full">
    <main class="w-full min-h-screen h-full bg-surface-container-lowest flex flex-col lg:flex-row overflow-x-hidden">
        <!-- Section Kiri: Branding & Informasi Pustakawan -->
        <div class="w-full lg:w-[48%] xl:w-[45%] relative flex flex-col justify-between p-5 sm:p-8 lg:p-16 text-on-primary min-h-[340px] sm:min-h-[400px] lg:min-h-screen bg-primary overflow-hidden shadow-2xl z-10">
            <div class="absolute inset-0 bg-cover bg-center scale-105 transition-transform duration-1000 ease-out" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAVlK7F7KTBrU4NfEAoxe5EjsoFCbCLG1QEnZkeywNRlk8qXBtospIr5fLs3PXTii1Klmh3aLQ-JUWE8AoH4ebX5LKaVLfIdShd5tJLFiCDtsDFDYTpIMiLP8MGZKz6OKl3QTxUIdXPSXnCOKn_nrg1xh59GkFtljp31_gITDjxye4XFDcbHrEPd5xdkFv8k-zlI-ZUzVeV8QYv8dEQx0kHLX5wgFQyT557G4jzzFNfUC4zT_XiniIyw6YI1ORIVwEIa14');"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-[#00261d]/95 via-[#1b4d3e]/88 to-[#0a3124]/80 backdrop-blur-[0.5px]"></div>
            
            <div class="relative z-10 flex flex-col items-start">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white/10 backdrop-blur-md p-2 flex items-center justify-center border border-white/20 shadow-lg">
                        <img alt="Logo Universitas Islam Malang UNISMA" class="w-full h-full object-contain filter drop-shadow-md" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8nXzTBXrEktlkoetBg5Jz7nvC0f7mtN8QtDFTHybBvY_dpW8Ymcpuu35NVjmq1z5AUyfZYfZPfkU8QBlNZcGHXWXFntG1-cgjHtbpH_u8nAT8BUiO30dCwQZzAB7lU6V3CbP9viW3AXuP3YZN7Bs_qN9iN-1sZ9Bwb6Kco0R8GVhDzRzu5g8MC8u-nWZCKDoCpsSAAJxdP3ud88xpxklYlj1LQHo4p6c6D8DtcNXtHbJ_2EqlXSQQF8I-Bq6n1panjq0">
                    </div>
                    <div>
                        <h2 class="font-headline-md text-2xl sm:text-3xl text-white tracking-tight leading-tight font-semibold">Perpustakaan UNISMA</h2>
                        <p class="font-label-md text-xs sm:text-sm tracking-wide text-primary-fixed-dim/90 font-medium">Universitas Islam Malang</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 my-auto py-8 sm:py-12 max-w-md">
                <h1 class="font-headline-lg text-3xl sm:text-4xl leading-tight text-white font-normal mb-3">Portal Layanan Staf &amp; Sirkulasi</h1>
                <p class="font-body-md text-sm sm:text-base text-primary-fixed-dim/90 leading-relaxed font-normal">Sistem pengelolaan sirkulasi, inventarisasi koleksi, dan administrasi pustaka terpadu.</p>
            </div>

            <div class="relative z-10 text-xs text-primary-fixed-dim/70 font-label-sm">© Universitas Islam Malang</div>
        </div>

        <!-- Section Kanan: Form Login Pustakawan -->
        <div class="w-full lg:w-[52%] xl:w-[55%] flex flex-col justify-between p-6 sm:p-12 lg:p-16 xl:p-20 bg-surface-container-lowest min-h-[calc(100vh-340px)] sm:min-h-[calc(100vh-400px)] lg:min-h-screen overflow-y-auto">
            <div class="w-full max-w-lg mx-auto my-auto py-4">
                <div class="mb-8 text-center sm:text-left">
                    <h2 class="font-headline-lg text-3xl sm:text-4xl font-bold text-on-surface tracking-tight mb-2">Login Pustakawan</h2>
                    <p class="font-body-md text-sm sm:text-base text-on-surface-variant">Masukkan NIP dan kata sandi Anda untuk mengakses sistem.</p>
                </div>

                <form class="space-y-5" id="library-login-form" onsubmit="event.preventDefault(); simulateAuth();">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-xs font-semibold text-on-surface" for="identifier">NIP / ID Petugas</label>
                        <div class="relative flex items-center rounded-xl border border-outline-variant/70 bg-surface-container-lowest hover:border-outline focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all shadow-sm">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-xl">badge</span>
                            <input class="w-full pl-11 pr-4 py-3.5 bg-transparent rounded-xl font-body-md text-sm text-on-surface placeholder:text-outline/70 focus:outline-none" id="identifier" name="identifier" placeholder="Masukkan NIP atau ID Petugas" required type="text">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="font-label-md text-xs font-semibold text-on-surface" for="password">Kata Sandi</label>
                        <div class="relative flex items-center rounded-xl border border-outline-variant/70 bg-surface-container-lowest hover:border-outline focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all shadow-sm">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-xl">lock</span>
                            <input class="w-full pl-11 pr-12 py-3.5 bg-transparent rounded-xl font-body-md text-sm text-on-surface placeholder:text-outline/70 focus:outline-none" id="password" name="password" placeholder="Masukkan kata sandi" required type="password">
                            <button aria-label="Lihat kata sandi" class="absolute right-3.5 p-1.5 text-outline hover:text-on-surface transition-colors focus:outline-none rounded-lg" onclick="togglePasswordVisibility()" type="button">
                                <span class="material-symbols-outlined text-xl" id="eye-icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <button class="w-full mt-4 py-3.5 px-6 rounded-xl font-label-md text-sm font-semibold text-on-primary bg-primary hover:bg-[#1b4d3e] shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 active:scale-[0.99] cursor-pointer" id="submit-btn" type="submit">
                        <span id="submit-text">Masuk</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
