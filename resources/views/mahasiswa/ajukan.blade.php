<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Bebas Pustaka - Perpustakaan UNISMA</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif']
                    }
                }
            }
        };
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-academic { font-family: 'Playfair Display', Georgia, serif; }
    </style>
</head>
<body class="text-slate-800 antialiased h-screen overflow-hidden flex bg-[#f6f8f7]">
    <x-mahasiswa.sidebar active="ajukan" />

    <div class="flex-1 h-screen flex flex-col min-w-0 overflow-y-auto">
        <x-mahasiswa.header title="Ajukan bebas pustaka" />

        <main class="mx-auto w-full max-w-7xl p-5 sm:p-8 lg:p-10">
            <div class="mb-8">
                <h1 class="mb-2 font-academic text-3xl font-bold text-stone-900 sm:text-4xl">Ajukan bebas pustaka</h1>
                <p class="max-w-3xl text-sm leading-relaxed text-stone-600 sm:text-base">Lengkapi data karya ilmiah dan siapkan tiga berkas PDF untuk pengajuan bebas pustaka.</p>
            </div>

            <div class="grid grid-cols-1 items-start gap-8 xl:grid-cols-12">
                <section class="rounded-xl border border-stone-200/90 bg-white p-5 shadow-sm sm:p-7 xl:col-span-8" data-purpose="form-submission-card">
                    <form id="bebas-pustaka-form" novalidate>
                        <div class="mb-6">
                            <h2 class="font-academic text-2xl font-bold text-stone-900">Form pengajuan</h2>
                            <p class="mt-1 text-xs text-stone-500 sm:text-sm">Semua isian bertanda <span class="font-semibold text-red-600">*</span> wajib diisi.</p>
                        </div>
                        <div class="space-y-6">
                            <div class="border-b border-stone-100 pb-3"><h3 class="font-academic text-lg font-bold text-stone-800">Data karya ilmiah</h3></div>
                            <div>
                                <label for="judul_karya" class="mb-2 block text-sm font-semibold text-stone-700">Judul karya ilmiah <span class="text-red-600">*</span></label>
                                <input id="judul_karya" name="judul_karya" type="text" required placeholder="Masukkan judul karya ilmiah lengkap" class="w-full rounded-lg border-stone-300 px-3.5 py-2.5 text-sm text-stone-800 shadow-sm transition placeholder:text-stone-400 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                            </div>
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="jenis_karya" class="mb-2 block text-sm font-semibold text-stone-700">Jenis karya <span class="text-red-600">*</span></label>
                                    <select id="jenis_karya" name="jenis_karya" required class="w-full rounded-lg border-stone-300 px-3.5 py-2.5 text-sm text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                        <option value="" disabled selected>Pilih jenis karya</option>
                                        <option value="skripsi">Skripsi</option><option value="tesis">Tesis</option><option value="disertasi">Disertasi</option><option value="tugas_akhir">Tugas Akhir</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="tahun_lulus" class="mb-2 block text-sm font-semibold text-stone-700">Tahun lulus <span class="text-red-600">*</span></label>
                                    <input id="tahun_lulus" name="tahun_lulus" type="number" min="1990" max="2035" value="2026" required class="w-full rounded-lg border-stone-300 px-3.5 py-2.5 text-sm text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                </div>
                            </div>
                            <div>
                                <label for="abstrak" class="mb-2 block text-sm font-semibold text-stone-700">Abstrak (bahasa Indonesia) <span class="text-red-600">*</span></label>
                                <textarea id="abstrak" name="abstrak" maxlength="2000" rows="6" required placeholder="Tuliskan intisari atau abstrak karya ilmiah..." class="w-full resize-y rounded-lg border-stone-300 p-3.5 text-sm leading-relaxed text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20"></textarea>
                                <div class="mt-1.5 text-right text-xs font-medium text-stone-400"><span id="char-counter">0</span> / 2000 karakter</div>
                            </div>
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="kata_kunci" class="mb-2 block text-sm font-semibold text-stone-700">Kata kunci <span class="text-red-600">*</span></label>
                                    <input id="kata_kunci" name="kata_kunci" type="text" required class="w-full rounded-lg border-stone-300 px-3.5 py-2.5 text-sm text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                    <p class="mt-1.5 text-xs leading-normal text-stone-500">Pisahkan dengan koma, misalnya: sistem informasi, REST API.</p>
                                </div>
                                <div>
                                    <label for="dosen_pembimbing" class="mb-2 block text-sm font-semibold text-stone-700">Dosen pembimbing 1 <span class="text-red-600">*</span></label>
                                    <input id="dosen_pembimbing" name="dosen_pembimbing" type="text" required class="w-full rounded-lg border-stone-300 px-3.5 py-2.5 text-sm text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                    <p class="mt-1.5 text-xs leading-normal text-stone-500">Tulis nama lengkap beserta gelar.</p>
                                </div>
                            </div>
                            <div>
                                <label for="akses_naskah" class="mb-2 block text-sm font-semibold text-stone-700">Akses naskah di repositori <span class="text-red-600">*</span></label>
                                <select id="akses_naskah" name="akses_naskah" required class="w-full rounded-lg border-stone-300 px-3.5 py-2.5 text-sm text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                    <option value="" disabled selected>Pilih jenis akses</option>
                                    <option value="open">Open Access (Publik)</option><option value="restricted">Restricted (Hanya Civitas Akademika)</option><option value="embargo">Embargo (Ditunda)</option>
                                </select>
                                <p class="mt-1.5 text-xs leading-relaxed text-stone-500">Publik dapat dibaca siapa saja. Hanya civitas akademika membatasi pembaca. Ditunda membuka naskah setelah masa tertentu.</p>
                            </div>
                        </div>

                        <div class="mt-10 border-t border-stone-200 pt-6">
                            <h3 class="mb-5 font-academic text-lg font-bold text-stone-800">Berkas persyaratan</h3>
                            <div class="space-y-4">
                                @foreach ([['file_naskah', 'Naskah lengkap', 'Seluruh isi karya, dari sampul sampai daftar pustaka'], ['file_pengesahan', 'Lembar pengesahan', 'Sudah ditandatangani pembimbing dan penguji'], ['file_orisinalitas', 'Pernyataan orisinalitas', 'Bermaterai, ditandatangani mahasiswa']] as [$fileId, $fileTitle, $fileDescription])
                                    <div class="flex flex-col justify-between gap-4 rounded-xl border border-dashed border-stone-300 bg-stone-50/50 p-4 transition hover:border-emerald-700/60 hover:bg-white sm:flex-row sm:items-center">
                                        <div class="flex items-start gap-3.5">
                                            <div class="shrink-0 rounded-lg border border-stone-200 bg-white p-2.5 text-stone-600 shadow-sm">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"/></svg>
                                            </div>
                                            <div>
                                                <h4 class="flex items-center gap-1 text-sm font-semibold text-stone-800">{{ $fileTitle }} <span class="text-red-600">*</span></h4>
                                                <p class="mt-0.5 text-xs text-stone-500">{{ $fileDescription }}</p>
                                                <p class="mt-1 hidden max-w-full break-all text-xs font-medium text-emerald-800" id="{{ $fileId }}_name"></p>
                                            </div>
                                        </div>
                                        <div class="sm:shrink-0">
                                            <input accept="application/pdf,.pdf" class="sr-only" id="{{ $fileId }}" name="{{ $fileId }}" type="file" required>
                                            <label for="{{ $fileId }}" class="inline-flex cursor-pointer items-center justify-center rounded-lg border border-stone-300 bg-white px-4 py-2 text-xs font-semibold text-stone-700 shadow-sm transition hover:border-stone-400 hover:bg-stone-50">Pilih PDF</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-10 flex flex-col items-center justify-between gap-4 border-t border-stone-200 pt-6 sm:flex-row">
                            <span id="upload-summary-text" class="text-xs font-medium text-stone-500 sm:text-sm" role="status">0 dari 3 berkas siap diunggah</span>
                            <div class="flex w-full items-center justify-end gap-3 sm:w-auto sm:gap-4">
                                <button class="px-3 py-2 text-xs font-medium text-stone-600 transition hover:text-stone-900 sm:text-sm" type="reset">Kosongkan form</button>
                                <button class="rounded-lg bg-[#1B4D3E] px-5 py-2.5 text-xs font-semibold tracking-wide text-white shadow-sm transition hover:bg-[#143B30] active:scale-[0.99] sm:px-6 sm:text-sm" type="submit">Kirim pengajuan</button>
                            </div>
                        </div>
                        <p id="form-message" class="mt-4 hidden rounded-lg border border-amber-200 bg-amber-50 p-3 text-sm text-amber-900" role="status">Formulir ini belum terhubung ke penyimpanan pengajuan.</p>
                    </form>
                </section>

                <aside class="space-y-6 xl:sticky xl:top-24 xl:col-span-4" data-purpose="status-and-guidance-widgets">
                    <div class="rounded-xl border border-stone-200/90 bg-white p-6 shadow-sm">
                        <h3 class="mb-4 border-b border-stone-100 pb-2 font-academic text-lg font-bold text-stone-900">Kelengkapan berkas</h3>
                        <ul class="space-y-3.5 text-sm text-stone-700">
                            @foreach ([['file_naskah', 'Naskah lengkap'], ['file_pengesahan', 'Lembar pengesahan'], ['file_orisinalitas', 'Pernyataan orisinalitas']] as [$fileId, $fileTitle])
                                <li class="flex items-center gap-3" id="status_{{ $fileId }}">
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 border-stone-300"></span>
                                    <span class="font-medium text-stone-700">{{ $fileTitle }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="rounded-xl border border-stone-200/90 bg-white p-6 shadow-sm">
                        <h3 class="mb-4 border-b border-stone-100 pb-2 font-academic text-lg font-bold text-stone-900">Perlu diketahui</h3>
                        <div class="space-y-3.5 text-xs leading-relaxed text-stone-600 sm:text-sm">
                            <p>Berkas harus berformat PDF dengan ukuran maksimal 10 MB per file.</p>
                            <p>Jika pengajuan ditolak, buka <span class="font-semibold text-stone-800">Riwayat pengajuan</span> lalu pilih <span class="font-semibold text-stone-800">Perbaiki pengajuan</span>.</p>
                        </div>
                    </div>
                </aside>
            </div>
        </main>
    </div>

    <script>
        const submissionForm = document.getElementById('bebas-pustaka-form');
        const abstractField = document.getElementById('abstrak');
        const characterCounter = document.getElementById('char-counter');
        const fileIds = ['file_naskah', 'file_pengesahan', 'file_orisinalitas'];

        abstractField.addEventListener('input', () => {
            characterCounter.textContent = abstractField.value.length;
        });

        function updateFileState(input) {
            const statusId = `status_${input.id}`;
            const statusItem = document.getElementById(statusId);
            const fileName = document.getElementById(`${input.id}_name`);
            const selectedFile = input.files[0];

            if (selectedFile && (selectedFile.type !== 'application/pdf' || selectedFile.size > 10 * 1024 * 1024)) {
                input.value = '';
                fileName.textContent = selectedFile.size > 10 * 1024 * 1024 ? 'Ukuran file melebihi 10 MB.' : 'Pilih berkas dengan format PDF.';
                fileName.classList.remove('hidden', 'text-emerald-800');
                fileName.classList.add('text-red-700');
                statusItem.firstElementChild.className = 'h-5 w-5 shrink-0 rounded-full border-2 border-stone-300';
                return;
            }

            fileName.classList.remove('text-red-700');
            fileName.classList.toggle('hidden', !selectedFile);
            fileName.classList.add('text-emerald-800');
            fileName.textContent = selectedFile ? selectedFile.name : '';
            statusItem.firstElementChild.className = selectedFile
                ? 'flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#1B4D3E] text-xs text-white'
                : 'h-5 w-5 shrink-0 rounded-full border-2 border-stone-300';
            statusItem.firstElementChild.textContent = selectedFile ? '✓' : '';
            updateUploadSummary();
        }

        function updateUploadSummary() {
            const uploadedCount = fileIds.filter((id) => document.getElementById(id).files.length > 0).length;
            document.getElementById('upload-summary-text').textContent = `${uploadedCount} dari 3 berkas siap diunggah`;
        }

        fileIds.forEach((id) => document.getElementById(id).addEventListener('change', (event) => updateFileState(event.target)));

        submissionForm.addEventListener('reset', () => {
            window.setTimeout(() => {
                characterCounter.textContent = '0';
                fileIds.forEach((id) => {
                    const statusItem = document.getElementById(`status_${id}`);
                    const fileName = document.getElementById(`${id}_name`);
                    statusItem.firstElementChild.className = 'h-5 w-5 shrink-0 rounded-full border-2 border-stone-300';
                    statusItem.firstElementChild.textContent = '';
                    fileName.textContent = '';
                    fileName.classList.add('hidden');
                    fileName.classList.remove('text-red-700');
                });
                updateUploadSummary();
                document.getElementById('form-message').classList.add('hidden');
            });
        });

        submissionForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const firstInvalidField = submissionForm.querySelector(':invalid');
            if (firstInvalidField) {
                firstInvalidField.reportValidity();
                return;
            }
            document.getElementById('form-message').classList.remove('hidden');
        });
    </script>
</body>
</html>