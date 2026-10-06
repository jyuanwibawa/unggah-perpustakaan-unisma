@props(['active' => 'dashboard'])

@php
    $activeClasses = 'bg-white text-[#1b4d3e] font-semibold shadow-sm';
    $inactiveClasses = 'text-emerald-100 hover:text-white hover:bg-white/10 font-medium';
@endphp

<aside class="w-72 h-screen sticky top-0 bg-[#1b4d3e] text-white flex flex-col justify-between shrink-0 shadow-xl border-r border-[#153f33]" data-purpose="main-sidebar">
    <div class="p-6">
        <div class="flex items-center space-x-3.5 pb-8 pt-2">
            <div class="w-12 h-12 flex items-center justify-center shrink-0">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2lGmiDJVM5OeyA-D1LQ9iyI0n72GUg1uDnNZoPy8U-4SwVYoERCJEmkAcnPTFZd2urbEk22hUTpP4oF96tmsz_5bjve7vsq2ReGzdXtzm6rgg_zoZYe5OMCGx1Oapfd0aw91ZoaQEVE9RcA8cN8TbfCsrFw8E4AEFazAkK1ngAofuSRFc75Y3KBnHceAj7QEFkpfZ6Jg0j6X3zXdPZydbpfQsyaRNrCgZQVjfNS67bH3j_fYt67q16okDGTaYl59SSNc" alt="Logo UNISMA" class="w-12 h-12 object-contain drop-shadow">
            </div>
            <div class="overflow-hidden">
                <h1 class="font-academic text-lg font-bold tracking-tight text-white leading-tight">Perpustakaan UNISMA</h1>
                <p class="text-xs text-emerald-200/80 font-medium tracking-wide">Universitas Islam Malang</p>
            </div>
        </div>

        <nav class="space-y-1.5 mt-2" data-purpose="sidebar-nav" aria-label="Navigasi utama">
            <a class="flex items-center space-x-3.5 px-4 py-3 rounded-xl {{ $active === 'dashboard' ? $activeClasses : $inactiveClasses }} text-sm transition-all" href="{{ url('/beranda') }}" @if ($active === 'dashboard') aria-current="page" @endif>
                <svg class="w-5 h-5 {{ $active === 'dashboard' ? 'text-[#1b4d3e]' : 'opacity-80' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                <span>Beranda</span>
            </a>
            <a class="flex items-center space-x-3.5 px-4 py-3 rounded-xl {{ $active === 'ajukan' ? $activeClasses : $inactiveClasses }} text-sm transition-all" href="{{ url('/mahasiswa/ajukan') }}" @if ($active === 'ajukan') aria-current="page" @endif>
                <svg class="w-5 h-5 {{ $active === 'ajukan' ? 'text-[#1b4d3e]' : 'opacity-80' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                <span>Ajukan bebas pustaka</span>
            </a>
            <a class="flex items-center justify-between px-4 py-3 rounded-xl {{ $active === 'riwayat' ? $activeClasses : 'text-emerald-100 hover:text-white hover:bg-white/10 font-medium' }} text-sm transition-colors" href="{{ url('/mahasiswa/riwayat') }}" @if ($active === 'riwayat') aria-current="page" @endif>
                <span class="flex items-center space-x-3.5">
                    <svg class="w-5 h-5 {{ $active === 'riwayat' ? 'text-[#1b4d3e]' : 'opacity-80' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    <span>Riwayat pengajuan</span>
                </span>
                <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $active === 'riwayat' ? 'bg-[#1b4d3e] text-white border border-[#1b4d3e]' : 'bg-white/20 text-white border border-white/20' }}">2</span>
            </a>
            <a class="flex items-center space-x-3.5 px-4 py-3 rounded-xl {{ $active === 'panduan' ? $activeClasses : $inactiveClasses }} text-sm transition-all" href="{{ url('/mahasiswa/panduan') }}" @if ($active === 'panduan') aria-current="page" @endif>
                <svg class="w-5 h-5 {{ $active === 'panduan' ? 'text-[#1b4d3e]' : 'opacity-80' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                <span>Panduan</span>
            </a>
        </nav>
    </div>

    <div class="p-5 mb-2 border-t border-emerald-900/50 bg-[#164134]/40">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-white text-[#1b4d3e] flex items-center justify-center font-bold text-base shadow-sm ring-2 ring-emerald-300/30">N</div>
            <div class="truncate">
                <p class="text-sm font-semibold text-white truncate">Nama Mahasiswa</p>
                <p class="text-xs text-emerald-200/70 font-mono tracking-tight">NIM 00000000000</p>
            </div>
        </div>
        <a href="{{ url('/login') }}" class="w-full flex items-center justify-center space-x-2 py-2.5 px-4 rounded-xl border border-white/25 hover:border-white/50 text-emerald-100 hover:text-white hover:bg-white/10 text-xs font-semibold tracking-wide transition-all" data-purpose="logout-button">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            <span>Keluar</span>
        </a>
    </div>
</aside>