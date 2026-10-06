<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan - Perpustakaan UNISMA</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-academic { font-family: 'Playfair Display', Georgia, serif; }
    </style>
</head>
<body class="text-slate-800 antialiased h-screen overflow-hidden flex bg-[#f6f8f7]">
    <x-mahasiswa.sidebar active="riwayat" />

    <div class="flex-1 h-screen flex flex-col min-w-0 overflow-y-auto">
        <x-mahasiswa.header title="Riwayat pengajuan" />

        <main class="p-5 sm:p-8 lg:p-10 max-w-7xl w-full mx-auto">
            <section class="mb-8" data-purpose="page-title-banner">
                <h1 class="font-academic text-3xl sm:text-4xl font-bold text-[#133a2d]">Riwayat pengajuan</h1>
                <p class="mt-2 text-slate-600 text-sm sm:text-base max-w-2xl leading-relaxed">Semua pengajuan Anda beserta statusnya. Buka Detail untuk melihat isian, berkas, dan perkembangan.</p>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm" aria-labelledby="history-heading">
                <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:p-6 md:flex-row md:items-center md:justify-between">
                    <h2 id="history-heading" class="font-academic text-xl font-bold text-slate-900">Daftar pengajuan</h2>
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <label class="relative block sm:min-w-[270px]">
                            <span class="sr-only">Cari judul atau jenis karya</span>
                            <input id="history-search" class="w-full rounded-xl border border-slate-300/80 bg-white py-2 pl-3.5 pr-9 text-sm text-slate-700 placeholder:text-slate-400 focus:border-[#133E31] focus:ring-1 focus:ring-[#133E31]" placeholder="Cari judul atau jenis karya" type="search">
                            <svg class="pointer-events-none absolute right-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7" stroke-width="1.8"/><path d="m16 16 4 4" stroke-linecap="round" stroke-width="1.8"/></svg>
                        </label>
                        <label>
                            <span class="sr-only">Filter status pengajuan</span>
                            <select id="history-status-filter" class="w-full cursor-pointer rounded-xl border border-slate-300/80 bg-white py-2 pl-3.5 pr-8 text-sm text-slate-700 focus:border-[#133E31] focus:ring-1 focus:ring-[#133E31] sm:w-auto">
                                <option value="all">Semua status</option>
                                <option value="diproses">Diproses</option>
                                <option value="perlu_revisi">Perlu revisi</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[850px] border-collapse text-left" data-purpose="history-table">
                        <thead>
                            <tr class="border-b border-slate-100 bg-slate-50/60 text-xs font-semibold uppercase tracking-wider text-slate-600">
                                <th class="w-44 px-6 py-4" scope="col">Tanggal</th>
                                <th class="w-[32%] px-6 py-4" scope="col">Judul karya</th>
                                <th class="w-36 px-6 py-4" scope="col">Status</th>
                                <th class="px-6 py-4" scope="col">Catatan petugas</th>
                                <th class="w-44 px-6 py-4 text-right" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="history-rows" class="divide-y divide-slate-100 text-sm">
                            <tr class="history-row transition-colors hover:bg-slate-50/50" data-status="diproses" data-search="rancang bangun sistem informasi akademik berbasis web skripsi">
                                <td class="whitespace-nowrap px-6 py-5 align-top font-medium text-slate-700">5 Oktober 2026</td>
                                <td class="px-6 py-5 align-top">
                                    <p class="font-semibold leading-snug text-slate-900">Rancang Bangun Sistem Informasi Akademik Berbasis Web</p>
                                    <p class="mt-1 text-xs text-slate-500">Skripsi <span class="mx-1">&bull;</span> <span class="font-medium text-amber-800">revisi</span></p>
                                </td>
                                <td class="whitespace-nowrap px-6 py-5 align-top"><span class="inline-flex items-center rounded-full border border-amber-200/60 bg-[#fef6e7] px-3 py-1 text-xs font-medium text-[#975a16]"><span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#d69e2e]"></span>Diproses</span></td>
                                <td class="px-6 py-5 align-top text-slate-400">-</td>
                                <td class="px-6 py-5 text-right align-top"><button class="history-detail rounded-lg border border-slate-300 bg-white px-4 py-1.5 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:text-[#133E31]" type="button" data-date="5 Oktober 2026" data-title="Rancang Bangun Sistem Informasi Akademik Berbasis Web" data-type="Skripsi" data-status-label="Diproses" data-note="Pengajuan sedang diperiksa petugas.">Detail</button></td>
                            </tr>
                            <tr class="history-row bg-rose-50/20 transition-colors hover:bg-slate-50/50" data-status="perlu_revisi" data-search="rancang bangun sistem informasi akademik berbasis web skripsi">
                                <td class="whitespace-nowrap px-6 py-5 align-top font-medium text-slate-700">30 September 2026</td>
                                <td class="px-6 py-5 align-top">
                                    <p class="font-semibold leading-snug text-slate-900">Rancang Bangun Sistem Informasi Akademik Berbasis Web</p>
                                    <p class="mt-1 text-xs text-slate-500">Skripsi</p>
                                </td>
                                <td class="whitespace-nowrap px-6 py-5 align-top"><span class="inline-flex items-center rounded-full border border-rose-200/60 bg-[#fdf2f2] px-3 py-1 text-xs font-medium text-[#9b1c1c]"><span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-[#e02424]"></span>Perlu revisi</span></td>
                                <td class="px-6 py-5 align-top text-xs leading-relaxed text-slate-700">Lembar pengesahan belum ditandatangani penguji. Unggah ulang berkas yang sudah lengkap.</td>
                                <td class="px-6 py-5 text-right align-top">
                                    <div class="flex flex-col items-end space-y-2">
                                        <button class="history-detail rounded-lg border border-slate-300 bg-white px-4 py-1.5 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:text-[#133E31]" type="button" data-date="30 September 2026" data-title="Rancang Bangun Sistem Informasi Akademik Berbasis Web" data-type="Skripsi" data-status-label="Perlu revisi" data-note="Lembar pengesahan belum ditandatangani penguji. Unggah ulang berkas yang sudah lengkap.">Detail</button>
                                        <a href="{{ url('/mahasiswa/ajukan') }}" class="rounded-lg border border-red-300 px-3.5 py-1.5 text-xs font-semibold text-red-700 transition hover:bg-red-700 hover:text-white">Perbaiki pengajuan</a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="history-row transition-colors hover:bg-slate-50/50" data-status="disetujui" data-search="analisis sentimen opini publik twitter algoritma naive bayes proposal skripsi">
                                <td class="whitespace-nowrap px-6 py-5 align-top font-medium text-slate-700">12 Agustus 2026</td>
                                <td class="px-6 py-5 align-top">
                                    <p class="font-semibold leading-snug text-slate-900">Analisis Sentimen Opini Publik pada Twitter Menggunakan Algoritma Naive Bayes</p>
                                    <p class="mt-1 text-xs text-slate-500">Proposal Skripsi</p>
                                </td>
                                <td class="whitespace-nowrap px-6 py-5 align-top"><span class="inline-flex items-center rounded-full border border-emerald-200/60 bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-800"><span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Disetujui</span></td>
                                <td class="px-6 py-5 align-top text-xs leading-relaxed text-slate-600">Berkas lengkap dan telah disetujui pustakawan.</td>
                                <td class="px-6 py-5 text-right align-top"><button class="history-detail rounded-lg border border-slate-300 bg-white px-4 py-1.5 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:text-[#133E31]" type="button" data-date="12 Agustus 2026" data-title="Analisis Sentimen Opini Publik pada Twitter Menggunakan Algoritma Naive Bayes" data-type="Proposal Skripsi" data-status-label="Disetujui" data-note="Berkas lengkap dan telah disetujui pustakawan.">Detail</button></td>
                            </tr>
                            <tr id="history-empty" class="hidden"><td class="px-6 py-12 text-center text-sm text-slate-500" colspan="5">Tidak ada pengajuan yang sesuai dengan pencarian.</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center justify-between border-t border-slate-100 bg-slate-50/50 px-5 py-4 text-xs text-slate-500 sm:px-6">
                    <span id="history-count" role="status">Menampilkan 3 dari 3 pengajuan</span>
                    <div class="flex items-center space-x-1" aria-label="Halaman riwayat">
                        <button class="cursor-not-allowed rounded border border-slate-200 bg-white px-2.5 py-1 text-slate-400" type="button" disabled aria-label="Halaman sebelumnya">&lsaquo;</button>
                        <span class="rounded bg-[#1b4d3e] px-3 py-1 font-medium text-white" aria-current="page">1</span>
                        <button class="cursor-not-allowed rounded border border-slate-200 bg-white px-2.5 py-1 text-slate-400" type="button" disabled aria-label="Halaman berikutnya">&rsaquo;</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <dialog id="history-detail-dialog" class="w-[min(32rem,calc(100%-2rem))] rounded-xl border border-slate-200 p-0 shadow-xl backdrop:bg-slate-950/40">
        <div class="flex items-start justify-between border-b border-slate-100 p-5 sm:p-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-emerald-800">Detail pengajuan</p>
                <h2 id="detail-title" class="mt-2 font-academic text-xl font-bold text-slate-900"></h2>
            </div>
            <button id="detail-close" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-slate-900" type="button" aria-label="Tutup detail">&times;</button>
        </div>
        <dl class="grid grid-cols-[auto_1fr] gap-x-5 gap-y-4 p-5 text-sm sm:p-6">
            <dt class="text-slate-500">Tanggal</dt><dd id="detail-date" class="font-medium text-slate-800"></dd>
            <dt class="text-slate-500">Jenis karya</dt><dd id="detail-type" class="font-medium text-slate-800"></dd>
            <dt class="text-slate-500">Status</dt><dd id="detail-status" class="font-semibold text-slate-800"></dd>
            <dt class="text-slate-500">Catatan</dt><dd id="detail-note" class="leading-relaxed text-slate-700"></dd>
        </dl>
    </dialog>

    <script>
        const searchInput = document.getElementById('history-search');
        const statusFilter = document.getElementById('history-status-filter');
        const historyRows = [...document.querySelectorAll('.history-row')];
        const historyEmpty = document.getElementById('history-empty');
        const historyCount = document.getElementById('history-count');
        const detailDialog = document.getElementById('history-detail-dialog');

        function filterHistory() {
            const searchTerm = searchInput.value.trim().toLocaleLowerCase('id');
            const selectedStatus = statusFilter.value;
            let visibleCount = 0;

            historyRows.forEach((row) => {
                const matchesSearch = row.dataset.search.includes(searchTerm);
                const matchesStatus = selectedStatus === 'all' || row.dataset.status === selectedStatus;
                const visible = matchesSearch && matchesStatus;
                row.classList.toggle('hidden', !visible);
                if (visible) visibleCount++;
            });

            historyEmpty.classList.toggle('hidden', visibleCount > 0);
            historyCount.textContent = `Menampilkan ${visibleCount} dari ${historyRows.length} pengajuan`;
        }

        searchInput.addEventListener('input', filterHistory);
        statusFilter.addEventListener('change', filterHistory);

        document.querySelectorAll('.history-detail').forEach((button) => {
            button.addEventListener('click', () => {
                document.getElementById('detail-title').textContent = button.dataset.title;
                document.getElementById('detail-date').textContent = button.dataset.date;
                document.getElementById('detail-type').textContent = button.dataset.type;
                document.getElementById('detail-status').textContent = button.dataset.statusLabel;
                document.getElementById('detail-note').textContent = button.dataset.note;
                detailDialog.showModal();
            });
        });

        document.getElementById('detail-close').addEventListener('click', () => detailDialog.close());
        detailDialog.addEventListener('click', (event) => {
            if (event.target === detailDialog) detailDialog.close();
        });
    </script>
</body>
</html>