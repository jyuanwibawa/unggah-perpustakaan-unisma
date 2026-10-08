@props([
    'title' => 'Dashboard',
    'subtitle' => 'Ringkasan berkas bebas pustaka mahasiswa Universitas Islam Malang',
    'currentDate',
    'waitingCount' => 0,
])

<header class="sticky top-0 z-20 flex flex-col gap-4 border-b border-slate-200/80 bg-white/90 px-5 py-5 backdrop-blur-md sm:flex-row sm:items-center sm:justify-between sm:px-8 lg:px-10 lg:py-7" data-purpose="content-header">
    <div>
        <h2 class="font-serif text-2xl font-bold text-slate-900 sm:text-3xl">{{ $title }}</h2>
        <p class="mt-1 text-xs font-medium text-slate-500 sm:text-sm">{{ $subtitle }}</p>
    </div>
    <div class="flex items-center justify-between gap-4 sm:justify-end">
        <div class="flex items-center gap-2 rounded-lg border border-emerald-100/80 bg-emerald-50/80 px-3.5 py-1.5 text-xs font-semibold text-emerald-800">
            <svg class="h-4 w-4 text-emerald-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span>{{ $currentDate }}</span>
        </div>
        <a class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-900 lg:hidden" href="#pengajuan-terbaru">Verifikasi ({{ $waitingCount }})</a>
    </div>
</header>
