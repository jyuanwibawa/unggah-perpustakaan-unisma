<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="shell-type" content="web_blank">
    <title>Login Perpustakaan - Universitas Islam Malang</title>

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
        <!-- Section Kiri: Branding Perpustakaan UNISMA -->
        <div class="w-full lg:w-[48%] xl:w-[45%] relative flex flex-col justify-between p-5 sm:p-8 lg:p-16 text-on-primary min-h-[340px] sm:min-h-[400px] lg:min-h-screen bg-primary overflow-hidden shadow-2xl z-10">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 ease-out" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAPHH23pAb66bi02rDFp8t40wCPYOnjhEiIbvnzIka0HXlJPfRFw5YhcMCWnwoGjka-53Jir0as8I1LOcP2DN689cStHrGcg2fTmoQW8j8j4TCPdLpTj5LM9KRZV4bJFVzaqbbQMwoOXuUrEHHJeWGqDpQSj5D7V5IZaWPMtxpFhPSJLdHShUPFSj3KryISS8oOj1KBUMvK21qR9jmA5Js88T-AoYbZlX9a_jyKpESXjsBcD1vEBTVH-pl-u253yBY3p30');"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-[#00261d]/95 via-[#1b4d3e]/85 to-[#0a3124]/75 backdrop-blur-[0.5px]"></div>
            
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white/10 backdrop-blur-md p-2 flex items-center justify-center border border-white/20 shadow-md ring-1 ring-white/10">
                        <img alt="Logo Universitas Islam Malang UNISMA" class="w-full h-full object-contain filter drop-shadow-md" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBWJonlMlkBO5NXH-2Tfm74myiTKeoObC0Og66udrKSTaihdFWvVF8MYvllW3u61YD4xbCY2hW4CJC1SodYXETW_957FcMKe1BmR9ZWG4TrCDV0fC1tMOa125e_ZlB3Xwbd9N43ueYFxS-MPz7NQtWLOBoGg0ZFaFbwFCvYz2HsXOyci21fd6XT2D0QFnLQsPD1ae1H9_vh7ga9tSWIS5KKy1IwNOvWdPDDe6wu7bkF1cOrwNRECecD1LgKPB0zl0J-VRI">
                    </div>
                    <div>
                        <h2 class="font-headline-md text-2xl sm:text-3xl text-white tracking-tight leading-tight font-semibold">Perpustakaan UNISMA</h2>
                        <p class="font-label-md text-xs sm:text-sm tracking-wide text-primary-fixed-dim/90 font-normal mt-0.5">Universitas Islam Malang</p>
                    </div>
                </div>

                <div class="py-8 sm:py-12 max-w-md">
                    <div class="w-12 h-1 rounded-full bg-secondary-container mb-6"></div>
                    <h1 class="font-headline-lg text-3xl sm:text-4xl xl:text-[40px] leading-tight text-white font-normal italic drop-shadow-sm">Jendela Pengetahuan &amp; Kearifan Akademik.</h1>
                    <p class="font-body-md text-sm sm:text-base text-primary-fixed-dim/80 mt-4 leading-relaxed font-normal">Akses literatur, jurnal ilmiah, dan repositori digital civitas akademika UNISMA.</p>
                </div>

                <div class="text-xs text-primary-fixed-dim/60 font-medium tracking-wide">Layanan Perpustakaan Terpadu</div>
            </div>
        </div>

        <!-- Section Kanan: Form Login -->
        <div class="w-full lg:w-[52%] xl:w-[55%] flex flex-col justify-between p-6 sm:p-12 lg:p-16 xl:p-20 bg-surface-container-lowest min-h-[calc(100vh-340px)] sm:min-h-[calc(100vh-400px)] lg:min-h-screen overflow-y-auto">
            <div class="w-full max-w-md mx-auto my-auto py-12">
                <div class="mb-10">
                    <h2 class="font-headline-lg text-3xl sm:text-4xl font-bold text-on-surface tracking-tight mb-2">Masuk</h2>
                    <p class="font-body-md text-sm sm:text-base text-on-surface-variant">Gunakan akun institusi untuk mengakses portal perpustakaan.</p>
                </div>

                <form class="space-y-6" id="library-login-form" method="POST" action="{{ route('mahasiswa.login') }}">
                    @csrf

                    @if ($errors->any())
                        <div class="rounded-xl border border-error-container bg-error-container/10 p-4 text-sm text-on-error-container" role="alert">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-xs font-semibold text-on-surface" for="nim">NIM</label>
                        <div class="relative flex items-center rounded-xl border border-outline-variant/70 bg-surface-container-lowest hover:border-outline focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all shadow-sm">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-xl">person</span>
                            <input class="w-full pl-11 pr-4 py-3.5 bg-transparent rounded-xl font-body-md text-sm text-on-surface placeholder:text-outline/70 focus:outline-none" id="nim" name="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM" required inputmode="numeric" maxlength="11" type="text">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-xs font-semibold text-on-surface" for="password">Kata Sandi</label>
                        <div class="relative flex items-center rounded-xl border border-outline-variant/70 bg-surface-container-lowest hover:border-outline focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all shadow-sm">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-xl">lock</span>
                            <input class="w-full pl-11 pr-12 py-3.5 bg-transparent rounded-xl font-body-md text-sm text-on-surface placeholder:text-outline/70 focus:outline-none" id="password" name="password" placeholder="Masukkan kata sandi" required type="password">
                            <button aria-label="Lihat kata sandi" class="absolute right-3.5 p-1.5 text-outline hover:text-on-surface transition-colors focus:outline-none rounded-lg" onclick="togglePasswordVisibility()" type="button">
                                <span class="material-symbols-outlined text-xl" id="eye-icon">visibility</span>
                            </button>
                        </div>
                        <p class="text-xs text-on-surface-variant">Default: unismajayadanberjaya</p>
                    </div>

                    <button class="w-full mt-2 py-3.5 px-6 rounded-xl font-label-md text-sm font-semibold text-on-primary bg-primary hover:bg-[#1b4d3e] shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 active:scale-[0.99] cursor-pointer" id="submit-btn" type="submit">
                        <span id="submit-text">Masuk</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
