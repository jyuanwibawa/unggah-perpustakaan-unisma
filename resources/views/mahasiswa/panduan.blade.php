<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan - Perpustakaan UNISMA</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-academic { font-family: 'Playfair Display', Georgia, serif; }
        details[open] .faq-icon { transform: rotate(45deg); }
    </style>
</head>
<body class="text-slate-800 antialiased h-screen overflow-hidden flex bg-[#f6f8f7]">
    <x-mahasiswa.sidebar active="panduan" />

    <div class="flex-1 h-screen flex flex-col min-w-0 overflow-y-auto">
        <x-mahasiswa.header title="Panduan" />

        <main class="flex-1 px-5 py-8 sm:px-8 lg:px-10 max-w-5xl mx-auto w-full space-y-7">
            <section class="space-y-1" data-purpose="page-header">
                <h1 class="font-academic text-3xl font-bold text-[#112d24]">Panduan</h1>
                <p class="text-sm text-slate-600">Alur pengajuan dan jawaban untuk pertanyaan yang sering muncul.</p>
            </section>

            <section class="rounded-2xl border border-stone-200/90 bg-white p-5 shadow-sm sm:p-7" data-purpose="submission-workflow">
                <h2 class="mb-6 font-academic text-xl font-bold tracking-tight text-[#14372c]">Alur pengajuan</h2>
                <ol class="space-y-6">
                    <li class="flex items-start gap-4">
                        <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-stone-300 bg-stone-50 text-sm font-medium text-stone-500">1</span>
                        <div>
                            <h3 class="text-sm font-bold leading-snug text-slate-800">Isi form dan unggah berkas</h3>
                            <p class="mt-0.5 text-[13px] leading-relaxed text-slate-600">Lengkapi data karya ilmiah di halaman Ajukan bebas pustaka, lalu siapkan tiga berkas PDF.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-stone-300 bg-stone-50 text-sm font-medium text-stone-500">2</span>
                        <div>
                            <h3 class="text-sm font-bold leading-snug text-slate-800">Petugas memeriksa</h3>
                            <p class="mt-0.5 text-[13px] leading-relaxed text-slate-600">Petugas perpustakaan memeriksa kelengkapan berkas. Status pengajuan akan diperbarui setelah pemeriksaan.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-stone-300 bg-stone-50 text-sm font-medium text-stone-500">3</span>
                        <div>
                            <h3 class="text-sm font-bold leading-snug text-slate-800">Pengajuan disetujui atau perlu revisi</h3>
                            <p class="mt-0.5 text-[13px] leading-relaxed text-slate-600">Periksa status dan catatan petugas di Beranda atau Riwayat. Jika diminta revisi, perbaiki berkas lalu ajukan kembali.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-stone-300 bg-stone-50 text-sm font-medium text-stone-500">4</span>
                        <div>
                            <h3 class="text-sm font-bold leading-snug text-slate-800">Unduh surat bebas pustaka</h3>
                            <p class="mt-0.5 text-[13px] leading-relaxed text-slate-600">Setelah pengajuan disetujui dan surat tersedia, unduh surat melalui halaman Beranda atau Riwayat pengajuan.</p>
                        </div>
                    </li>
                </ol>
            </section>

            <section class="rounded-2xl border border-stone-200/90 bg-white p-5 shadow-sm sm:p-7" data-purpose="faq-section" aria-labelledby="faq-heading">
                <h2 id="faq-heading" class="mb-4 font-academic text-xl font-bold tracking-tight text-[#14372c]">Pertanyaan umum</h2>
                <div class="divide-y divide-stone-100">
                    <details class="group py-3.5">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left [&::-webkit-details-marker]:hidden">
                            <span class="text-sm font-semibold text-slate-800 transition-colors group-hover:text-[#173e32]">Berkas apa saja yang harus diunggah?</span>
                            <svg class="faq-icon h-4 w-4 shrink-0 text-stone-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        </summary>
                        <p class="mt-2 pb-1 pl-1 pr-6 text-[13px] leading-relaxed text-slate-600">Siapkan tiga berkas PDF: naskah lengkap, lembar pengesahan yang sudah ditandatangani, dan pernyataan orisinalitas yang sudah ditandatangani.</p>
                    </details>
                    <details class="group py-3.5">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left [&::-webkit-details-marker]:hidden">
                            <span class="text-sm font-semibold text-slate-800 transition-colors group-hover:text-[#173e32]">Pengajuan saya perlu revisi. Apa yang harus dilakukan?</span>
                            <svg class="faq-icon h-4 w-4 shrink-0 text-stone-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        </summary>
                        <p class="mt-2 pb-1 pl-1 pr-6 text-[13px] leading-relaxed text-slate-600">Buka Riwayat pengajuan, baca catatan revisi petugas, perbaiki berkas yang diminta, lalu kirim ulang melalui halaman Ajukan bebas pustaka.</p>
                    </details>
                    <details class="group py-3.5">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left [&::-webkit-details-marker]:hidden">
                            <span class="text-sm font-semibold text-slate-800 transition-colors group-hover:text-[#173e32]">Apa bedanya pilihan akses naskah?</span>
                            <svg class="faq-icon h-4 w-4 shrink-0 text-stone-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        </summary>
                        <p class="mt-2 pb-1 pl-1 pr-6 text-[13px] leading-relaxed text-slate-600">Open Access membuat naskah dapat dibaca publik. Restricted membatasi akses untuk civitas akademika. Embargo menunda pembukaan naskah sampai masa yang ditentukan.</p>
                    </details>
                    <details class="group py-3.5">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left [&::-webkit-details-marker]:hidden">
                            <span class="text-sm font-semibold text-slate-800 transition-colors group-hover:text-[#173e32]">Apakah isian form tersimpan kalau halaman ditutup?</span>
                            <svg class="faq-icon h-4 w-4 shrink-0 text-stone-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        </summary>
                        <p class="mt-2 pb-1 pl-1 pr-6 text-[13px] leading-relaxed text-slate-600">Belum. Penyimpanan draf otomatis belum tersedia, jadi isian dapat hilang jika halaman ditutup atau dimuat ulang.</p>
                    </details>
                    <details class="group py-3.5">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left [&::-webkit-details-marker]:hidden">
                            <span class="text-sm font-semibold text-slate-800 transition-colors group-hover:text-[#173e32]">Siapa yang bisa saya hubungi kalau ada masalah?</span>
                            <svg class="faq-icon h-4 w-4 shrink-0 text-stone-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        </summary>
                        <p class="mt-2 pb-1 pl-1 pr-6 text-[13px] leading-relaxed text-slate-600">Silakan menghubungi layanan referensi Perpustakaan UNISMA melalui kanal kontak resmi perpustakaan.</p>
                    </details>
                </div>
            </section>
        </main>
    </div>
</body>
</html>