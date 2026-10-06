@props(['title' => 'Beranda'])

<header class="h-20 shrink-0 bg-white/90 backdrop-blur-md border-b border-slate-200/80 px-5 sm:px-10 flex items-center justify-between sticky top-0 z-20" data-purpose="top-header">
    <div>
        <nav class="flex items-center text-sm font-semibold text-slate-700" aria-label="Lokasi halaman">
            <span>{{ $title }}</span>
        </nav>
    </div>
    <div class="flex items-center space-x-3.5">
        <button aria-label="Mode Gelap" class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#1b4d3e] hover:border-emerald-300 hover:bg-emerald-50/50 transition-all shadow-sm" type="button">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
        </button>
        <button aria-label="Pemberitahuan" class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#1b4d3e] hover:border-emerald-300 hover:bg-emerald-50/50 transition-all relative shadow-sm" type="button">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            <span class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-[#9c3232] text-white text-[11px] font-bold flex items-center justify-center border-2 border-white shadow-sm">2</span>
        </button>
    </div>
</header>