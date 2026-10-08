<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pustakawan - Verifikasi Berkas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        botanical: {
                            900: '#0e2922',
                            850: '#123b30',
                            800: '#164639',
                            700: '#1b4d3e',
                            600: '#1f5b4a',
                            500: '#2d7a64',
                            100: '#e3ece8',
                            50: '#f4f8f6',
                        },
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Segoe UI', 'sans-serif'],
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                    },
                },
            },
        };
    </script>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#f6faf7] font-sans text-slate-800 antialiased">
    <div class="min-h-screen lg:flex">
        <x-staff.sidebar active="verifikasi" :waiting-count="$waitingCount" />

        <main class="min-w-0 flex-1 overflow-y-auto">
            <x-staff.header
                title="Verifikasi Berkas"
                subtitle="Tinjau berkas dan perbarui status pengajuan bebas pustaka mahasiswa."
                :current-date="now()->locale('id')->translatedFormat('l, j F Y')"
                :waiting-count="$waitingCount"
            />

            <div class="mx-auto w-full max-w-[1600px] space-y-6 p-5 sm:p-8 lg:p-10">
                @if (session('success'))
                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-900" role="alert">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="flex flex-col items-stretch justify-between gap-4 md:flex-row md:items-center" aria-label="Pencarian dan filter antrean">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Daftar antrean mahasiswa</p>
                        <p class="mt-1 text-sm text-slate-600">{{ $submissions->count() }} pengajuan ditampilkan</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <label class="relative block sm:w-80">
                            <span class="sr-only">Cari nama, NIM, atau judul karya</span>
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="m21 21-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            <input id="verification-search" class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-9 pr-3.5 text-sm shadow-sm focus:border-[#1b4d3e] focus:ring-2 focus:ring-[#1b4d3e]/20" placeholder="Cari nama / NIM / judul..." type="search">
                        </label>
                        <form method="GET" action="{{ route('staff.verifikasi.index') }}">
                            <label class="sr-only" for="verification-status">Filter status</label>
                            <select id="verification-status" name="status" onchange="this.form.requestSubmit()" class="w-full min-w-44 cursor-pointer rounded-lg border border-slate-300 bg-white py-2.5 pl-3.5 pr-8 text-sm font-medium text-slate-700 shadow-sm focus:border-[#1b4d3e] focus:ring-2 focus:ring-[#1b4d3e]/20 sm:w-auto">
                                <option value="all" @selected($selectedStatus === 'all')>Semua status</option>
                                <option value="diproses" @selected($selectedStatus === 'diproses')>Diproses</option>
                                <option value="disetujui" @selected($selectedStatus === 'disetujui')>Disetujui</option>
                                <option value="ditolak" @selected($selectedStatus === 'ditolak')>Ditolak / revisi</option>
                            </select>
                        </form>
                    </div>
                </section>

                <section id="pengajuan-terbaru" class="scroll-mt-28 overflow-hidden rounded-xl border border-slate-200/80 bg-white shadow-sm" aria-label="Tabel antrean verifikasi">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full min-w-[1100px] border-collapse text-left">
                            <thead>
                                <tr class="border-b border-slate-200/80 bg-[#f0f6f3] text-[11px] font-bold uppercase tracking-wider text-slate-600">
                                    <th class="w-[11%] px-6 py-4" scope="col">Tanggal</th>
                                    <th class="w-[18%] px-6 py-4" scope="col">Mahasiswa</th>
                                    <th class="w-[25%] px-6 py-4" scope="col">Judul &amp; jenis</th>
                                    <th class="w-[21%] px-6 py-4" scope="col">Berkas</th>
                                    <th class="w-[13%] px-6 py-4" scope="col">Status</th>
                                    <th class="w-[12%] px-4 py-4 text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="verification-rows" class="divide-y divide-slate-100 text-sm">
                                @forelse ($submissions as $submission)
                                    <tr class="verification-row transition-colors hover:bg-slate-50/70" data-search="{{ mb_strtolower($submission->nama_mahasiswa.' '.$submission->nim.' '.$submission->judul_karya.' '.$submission->nomor_pengajuan) }}">
                                        <td class="whitespace-nowrap px-6 py-4 pt-5 align-top text-xs font-medium text-slate-600">{{ $submission->tanggal_label }}</td>
                                        <td class="px-6 py-4 align-top">
                                            <p class="text-sm font-bold text-slate-800">{{ $submission->nama_mahasiswa ?? 'Data mahasiswa tidak ditemukan' }}</p>
                                            <p class="mt-0.5 text-xs text-slate-500">NIM: {{ $submission->nim }}</p>
                                            <p class="mt-0.5 text-xs font-medium text-emerald-800/80">{{ $submission->prodi ?? '-' }}</p>
                                        </td>
                                        <td class="px-6 py-4 align-top">
                                            <p class="font-semibold leading-snug text-slate-800">{{ $submission->judul_karya }}</p>
                                            <span class="mt-2 inline-flex rounded border border-slate-200 bg-slate-100 px-2.5 py-0.5 text-[11px] font-medium text-slate-600">{{ $submission->jenis_karya_label }}</span>
                                            <p class="mt-1 font-mono text-[11px] text-slate-400">{{ $submission->nomor_pengajuan }}</p>
                                        </td>
                                        <td class="space-y-1.5 px-6 py-4 align-top">
                                            @forelse ($submission->documents as $document)
                                                <a class="group flex items-center gap-1.5 text-xs text-blue-600 hover:text-blue-800 hover:underline" href="{{ $document->download_url }}">
                                                    <svg class="h-3.5 w-3.5 shrink-0 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                                    <span>{{ $document->label }}</span>
                                                </a>
                                            @empty
                                                <span class="text-xs text-slate-400">Tidak ada berkas tercatat</span>
                                            @endforelse
                                        </td>
                                        <td class="px-6 py-4 align-top">
                                            <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-semibold {{ $submission->status_class }}">
                                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>{{ $submission->status_label }}
                                            </span>
                                            @if ($submission->status_keterangan)
                                                <p class="mt-1.5 max-w-48 text-[11px] leading-tight text-slate-400">{{ $submission->status_keterangan }}</p>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-center align-middle">
                                            @if ($submission->can_review)
                                                <button class="open-verification-dialog inline-flex items-center justify-center whitespace-nowrap rounded-lg bg-[#1b4d3e] px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-[#164639] focus:outline-none focus:ring-2 focus:ring-[#1b4d3e] focus:ring-offset-1" type="button" data-submission-id="{{ $submission->id }}" data-submission-title="{{ $submission->judul_karya }}" data-submission-name="{{ $submission->nama_mahasiswa }}" data-current-status="{{ $submission->status }}">Verifikasi</button>
                                            @else
                                                <span class="text-xs font-medium text-slate-400">Sudah ditinjau</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-submissions">
                                        <td class="px-6 py-14 text-center" colspan="6">
                                            <p class="font-semibold text-slate-700">Belum ada pengajuan</p>
                                            <p class="mt-1 text-xs text-slate-500">Pengajuan mahasiswa akan muncul di sini setelah dikirim.</p>
                                        </td>
                                    </tr>
                                @endforelse
                                <tr id="verification-empty-filter" class="hidden">
                                    <td class="px-6 py-12 text-center text-sm text-slate-500" colspan="6">Tidak ada pengajuan yang sesuai dengan pencarian.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-between border-t border-slate-200/80 bg-slate-50 px-6 py-3.5 text-xs text-slate-500">
                        <span id="verification-count" role="status">{{ $submissions->count() }} pengajuan</span>
                        <span>{{ $waitingCount }} menunggu verifikasi</span>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <dialog id="verification-dialog" class="w-[min(34rem,calc(100%-2rem))] rounded-xl border border-slate-200 p-0 shadow-xl backdrop:bg-slate-950/40">
        <form id="verification-form" method="POST" class="p-6" action="">
            @csrf
            <div class="mb-5 flex items-start justify-between gap-4 border-b border-slate-100 pb-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-emerald-800">Pemeriksaan pengajuan</p>
                    <h2 id="verification-dialog-title" class="mt-2 font-serif text-xl font-bold text-slate-900"></h2>
                    <p id="verification-dialog-student" class="mt-1 text-sm text-slate-500"></p>
                </div>
                <button id="verification-dialog-close" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-slate-900" type="button" aria-label="Tutup">&times;</button>
            </div>
            <label for="decision-status" class="mb-2 block text-sm font-semibold text-slate-700">Keputusan</label>
            <select id="decision-status" name="status" required class="mb-5 w-full rounded-lg border-slate-300 px-3.5 py-2.5 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">
                <option value="">Pilih keputusan</option>
                <option value="disetujui">Setujui pengajuan</option>
                <option value="menunggu_koreksi">Minta revisi</option>
                <option value="ditolak">Tolak pengajuan</option>
            </select>
            <label for="decision-note" class="mb-2 block text-sm font-semibold text-slate-700">Catatan untuk mahasiswa</label>
            <textarea id="decision-note" name="catatan" rows="4" maxlength="2000" class="w-full resize-y rounded-lg border-slate-300 px-3.5 py-2.5 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20" placeholder="Wajib diisi untuk revisi atau penolakan"></textarea>
            <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-5">
                <button id="verification-dialog-cancel" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50" type="button">Batal</button>
                <button class="rounded-lg bg-[#1b4d3e] px-5 py-2 text-sm font-semibold text-white hover:bg-[#164639]" type="submit">Simpan keputusan</button>
            </div>
        </form>
    </dialog>

    <script>
        const searchInput = document.getElementById('verification-search');
        const rows = [...document.querySelectorAll('.verification-row')];
        const emptyFiltered = document.getElementById('verification-empty-filter');
        const count = document.getElementById('verification-count');
        const dialog = document.getElementById('verification-dialog');
        const form = document.getElementById('verification-form');
        const decisionStatus = document.getElementById('decision-status');
        const decisionNote = document.getElementById('decision-note');
        const updateUrlTemplate = @json(route('staff.verifikasi.update', ['submissionId' => '__ID__']));

        function filterRows() {
            const query = searchInput.value.trim().toLocaleLowerCase('id');
            let visibleCount = 0;

            rows.forEach((row) => {
                const visible = row.dataset.search.includes(query);
                row.classList.toggle('hidden', !visible);
                if (visible) visibleCount++;
            });

            emptyFiltered.classList.toggle('hidden', visibleCount > 0 || rows.length === 0);
            count.textContent = `${visibleCount} pengajuan`;
        }

        searchInput.addEventListener('input', filterRows);

        document.querySelectorAll('.open-verification-dialog').forEach((button) => {
            button.addEventListener('click', () => {
                document.getElementById('verification-dialog-title').textContent = button.dataset.submissionTitle;
                document.getElementById('verification-dialog-student').textContent = button.dataset.submissionName;
                form.action = updateUrlTemplate.replace('__ID__', button.dataset.submissionId);
                decisionStatus.value = '';
                decisionNote.value = '';
                decisionNote.required = false;
                dialog.showModal();
            });
        });

        decisionStatus.addEventListener('change', () => {
            decisionNote.required = ['menunggu_koreksi', 'ditolak'].includes(decisionStatus.value);
        });

        document.getElementById('verification-dialog-close').addEventListener('click', () => dialog.close());
        document.getElementById('verification-dialog-cancel').addEventListener('click', () => dialog.close());
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) dialog.close();
        });
    </script>
</body>
</html>
