@props(['active' => 'dashboard', 'waitingCount' => 0])

@php
    $activeClasses = 'bg-white text-[#12382c] font-semibold shadow-sm';
    $inactiveClasses = 'text-emerald-100/90 hover:bg-white/10 hover:text-white';
@endphp

<aside class="sticky top-0 hidden h-screen w-72 shrink-0 self-start flex-col justify-between border-r border-[#0d281e] bg-[#12382c] text-white select-none lg:flex" data-purpose="sidebar-navigation">
    <div class="p-6">
        <div class="flex items-center gap-3.5 border-b border-white/10 pb-7">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-white/15 bg-white/10 p-1.5 shadow-inner">
                <img alt="Logo UNISMA" class="h-full w-full object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPJvhPSE5neTMnTr99XmmwkwhACWre2n6NDmIdcTS1xW_NN3ssIqJIkzv3GG1YJT1_yNQvkUbG_2u3GpHQUOdh9_I5opAFqIum-4HLQMCIvNL3G6JdfQo5QEzwEh3UWJ3wEnzfhOY8b52d97aaklS65_6mZz7g86p_MhNqzrK9VyOzIipfigK4dQe6jfGiX2WxzvdkZ0ERwO6XvmCXnj3C-FBBSsGJ-T-o9BibYHX4ddSHrL42QAf8HQ">
            </div>
            <div>
                <h1 class="font-serif text-lg font-bold leading-tight text-white">Panel Pustakawan</h1>
                <p class="mt-0.5 text-xs font-medium text-emerald-200/80">Bebas Pustaka · UNISMA</p>
            </div>
        </div>

        <nav class="mt-8 space-y-2" aria-label="Menu utama">
            <a @if ($active === 'dashboard') aria-current="page" @endif class="flex items-center gap-3.5 rounded-xl px-4 py-3 transition {{ $active === 'dashboard' ? $activeClasses : $inactiveClasses }}" href="{{ route('staff.dashboard') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span class="text-sm">Dashboard</span>
            </a>
            <a @if ($active === 'verifikasi') aria-current="page" @endif class="group flex items-center justify-between rounded-xl px-4 py-3 transition {{ $active === 'verifikasi' ? $activeClasses : $inactiveClasses }}" href="{{ route('staff.verifikasi.index') }}">
                <span class="flex items-center gap-3.5">
                    <svg class="h-5 w-5 text-emerald-300 transition group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="text-sm font-medium">Verifikasi</span>
                </span>
                @if ($waitingCount > 0)
                    <span class="inline-flex items-center justify-center rounded-full bg-amber-400 px-2 py-0.5 text-xs font-bold text-amber-950 shadow-sm">{{ $waitingCount }}</span>
                @endif
            </a>
            <a @if ($active === 'panduan') aria-current="page" @endif class="group flex items-center gap-3.5 rounded-xl px-4 py-3 transition {{ $active === 'panduan' ? $activeClasses : $inactiveClasses }}" href="{{ route('staff.panduan.index') }}">
                <svg class="h-5 w-5 text-emerald-300 transition group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span class="text-sm font-medium">Kelola Panduan</span>
            </a>
        </nav>
    </div>

    <div class="border-t border-white/10 bg-[#0d281e]/40 p-5">
        <div class="mb-3 flex items-center gap-3 px-2 py-2">
            <div class="flex h-10 w-10 items-center justify-center rounded-full border border-emerald-600/50 bg-emerald-800 text-sm font-bold text-white shadow">PU</div>
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-semibold leading-tight text-white">Pustakawan</p>
                <p class="truncate text-xs text-emerald-300/80">Mode pengembangan</p>
            </div>
        </div>
        <a class="flex w-full items-center justify-center gap-2 rounded-xl border border-white/20 px-4 py-2.5 text-xs font-semibold text-emerald-100 shadow-sm transition hover:bg-white/10 hover:text-white" href="{{ url('/staff/login') }}">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span>Kembali ke login</span>
        </a>
    </div>
</aside>
