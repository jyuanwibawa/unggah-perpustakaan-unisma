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

        <main class="mx-auto w-full max-w-screen-2xl flex-1 space-y-10 px-6 py-10 sm:px-10 lg:px-12">
            <section class="space-y-1" data-purpose="page-header">
                <h1 class="font-academic text-4xl font-bold text-[#112d24]">Panduan</h1>
                <p class="text-base leading-relaxed text-slate-600">Alur pengajuan dan jawaban untuk pertanyaan yang sering muncul.</p>
            </section>

            <section class="rounded-2xl border border-stone-200/90 bg-white p-7 shadow-sm sm:p-10" data-purpose="submission-workflow">
                <h2 class="mb-8 font-academic text-2xl font-bold tracking-tight text-[#14372c]">Alur pengajuan</h2>
                <ol class="space-y-8">
                    @forelse ($alurPengajuan as $tahap)
                        <li class="flex items-start gap-5">
                            <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-stone-300 bg-stone-50 text-base font-semibold text-stone-500">{{ $tahap->urutan }}</span>
                            <div>
                                <h3 class="text-base font-bold leading-snug text-slate-800">{{ $tahap->nama_tahap }}</h3>
                                @if ($tahap->deskripsi)
                                    <p class="mt-1 text-sm leading-relaxed text-slate-600">{{ $tahap->deskripsi }}</p>
                                @endif
                                @if ($tahap->is_final)
                                    <span class="mt-2 inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-sm font-medium text-slate-600">Tahap akhir</span>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="text-base text-slate-500">Alur pengajuan belum tersedia.</li>
                    @endforelse
                </ol>
            </section>

            <section class="rounded-2xl border border-stone-200/90 bg-white p-7 shadow-sm sm:p-10" data-purpose="faq-section" aria-labelledby="faq-heading">
                <h2 id="faq-heading" class="mb-6 font-academic text-2xl font-bold tracking-tight text-[#14372c]">Pertanyaan umum</h2>
                <div class="divide-y divide-stone-100">
                    @forelse ($pertanyaanUmum as $item)
                        <details class="group py-5">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-5 text-left [&::-webkit-details-marker]:hidden">
                                <span class="text-base font-semibold text-slate-800 transition-colors group-hover:text-[#173e32]">{{ $item->pertanyaan }}</span>
                                <svg class="faq-icon h-5 w-5 shrink-0 text-stone-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            </summary>
                            <p class="mt-3 pb-1 pl-1 pr-8 text-sm leading-relaxed text-slate-600">{{ $item->jawaban }}</p>
                        </details>
                    @empty
                        <p class="py-5 text-base text-slate-500">Belum ada pertanyaan umum.</p>
                    @endforelse
                </div>
            </section>
        </main>
    </div>
</body>
</html>