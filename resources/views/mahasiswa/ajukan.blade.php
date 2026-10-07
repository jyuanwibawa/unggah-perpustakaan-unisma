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
<body class="text-slate-800 antialiased min-h-screen overflow-x-hidden flex bg-[#f6f8f7]">
    <x-mahasiswa.sidebar active="ajukan" />

    <div class="flex-1 min-h-screen flex flex-col min-w-0">
        <x-mahasiswa.header title="Ajukan bebas pustaka" />

        <main class="mx-auto w-full max-w-screen-2xl p-6 sm:p-10 lg:p-12">
            <div class="mb-8">
                <h1 class="mb-3 font-academic text-4xl font-bold text-stone-900 sm:text-5xl">Ajukan bebas pustaka</h1>
                <p class="max-w-4xl text-base leading-relaxed text-stone-600 sm:text-lg">Lengkapi data karya ilmiah dan siapkan tiga berkas PDF untuk pengajuan bebas pustaka.</p>
            </div>

            <div class="grid grid-cols-1 items-start gap-8 xl:grid-cols-12">
                <section class="rounded-xl border border-stone-200/90 bg-white p-6 shadow-sm sm:p-9 xl:col-span-9" data-purpose="form-submission-card">
                    <form id="bebas-pustaka-form" method="POST" action="{{ route('mahasiswa.ajukan.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="mb-6">
                            <h2 class="font-academic text-3xl font-bold text-stone-900">Form pengajuan</h2>
                            <p class="mt-1 text-xs text-stone-500 sm:text-sm">Semua isian bertanda <span class="font-semibold text-red-600">*</span> wajib diisi.</p>
                        </div>
                        @if ($errors->any())
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                                <p class="font-semibold">Periksa kembali isian pengajuan:</p>
                                <ul class="mt-2 list-inside list-disc space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-900" role="status">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="space-y-6">
                            <div class="border-b border-stone-100 pb-3"><h3 class="font-academic text-xl font-bold text-stone-800">Data karya ilmiah</h3></div>
                            <div>
                                <label for="judul_karya" class="mb-2 block text-base font-semibold text-stone-700">Judul karya ilmiah <span class="text-red-600">*</span></label>
                                <input id="judul_karya" name="judul_karya" type="text" value="{{ old('judul_karya') }}" required placeholder="Masukkan judul karya ilmiah lengkap" class="w-full rounded-lg border-stone-300 px-4 py-3 text-base text-stone-800 shadow-sm transition placeholder:text-stone-400 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                            </div>
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="jenis_karya" class="mb-2 block text-base font-semibold text-stone-700">Jenis karya <span class="text-red-600">*</span></label>
                                    <select id="jenis_karya" name="jenis_karya" required class="w-full rounded-lg border-stone-300 px-4 py-3 text-base text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                        <option value="" disabled @selected(! old('jenis_karya'))>Pilih jenis karya</option>
                                        <option value="skripsi" @selected(old('jenis_karya') === 'skripsi')>Skripsi</option><option value="tesis" @selected(old('jenis_karya') === 'tesis')>Tesis</option><option value="disertasi" @selected(old('jenis_karya') === 'disertasi')>Disertasi</option><option value="tugas_akhir" @selected(old('jenis_karya') === 'tugas_akhir')>Tugas Akhir</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="tahun_lulus" class="mb-2 block text-base font-semibold text-stone-700">Tahun lulus <span class="text-red-600">*</span></label>
                                    <input id="tahun_lulus" name="tahun_lulus" type="number" min="1990" max="2035" value="{{ old('tahun_lulus', 2026) }}" required class="w-full rounded-lg border-stone-300 px-4 py-3 text-base text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                </div>
                            </div>
                            <div>
                                <label for="abstrak" class="mb-2 block text-base font-semibold text-stone-700">Abstrak (bahasa Indonesia) <span class="text-red-600">*</span></label>
                                <textarea id="abstrak" name="abstrak" maxlength="2000" rows="6" required placeholder="Tuliskan intisari atau abstrak karya ilmiah..." class="w-full resize-y rounded-lg border-stone-300 p-4 text-base leading-relaxed text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">{{ old('abstrak') }}</textarea>
                                <div class="mt-1.5 text-right text-xs font-medium text-stone-400"><span id="char-counter">0</span> / 2000 karakter</div>
                            </div>
                            <div class="space-y-5">
                                <div>
                                    <label for="kata-kunci-input" class="mb-2 block text-base font-semibold text-stone-700">Kata kunci <span class="text-red-600">*</span></label>
                                    <div class="flex min-h-14 flex-wrap items-center gap-2 rounded-lg border border-stone-300 bg-white px-3 py-2 shadow-sm focus-within:border-[#1B4D3E] focus-within:ring-2 focus-within:ring-[#1B4D3E]/20">
                                        <div id="kata-kunci-chips" class="contents" aria-live="polite"></div>
                                        <input id="kata-kunci-input" type="text" autocomplete="off" placeholder="Ketik kata kunci lalu tekan Enter" class="min-w-[12rem] flex-1 border-0 bg-transparent px-1 py-2 text-base text-stone-800 placeholder:text-stone-400 focus:ring-0">
                                    </div>
                                    <input id="kata_kunci" name="kata_kunci" type="hidden">
                                    <p class="mt-1.5 text-xs leading-normal text-stone-500">Tekan Enter atau koma untuk menambahkan kata kunci; klik silang untuk menghapus.</p>
                                </div>
                                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                    <div>
                                        <label for="dosen_pembimbing" class="mb-2 block text-base font-semibold text-stone-700">Dosen pembimbing 1 <span class="text-red-600">*</span></label>
                                        <div class="relative">
                                            <input id="dosen_pembimbing" name="dosen_pembimbing_label" type="text" value="{{ old('dosen_pembimbing_label') }}" required autocomplete="off" role="combobox" aria-autocomplete="list" aria-controls="dosen-suggestions-1" aria-expanded="false" placeholder="Ketik nama atau inisial dosen" class="w-full rounded-lg border-stone-300 px-4 py-3 text-base text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                            <input id="dosen_pembimbing_id" name="dosen_pembimbing_id" type="hidden" value="{{ old('dosen_pembimbing_id') }}">
                                            <div id="dosen-suggestions-1" class="absolute z-30 mt-1 hidden max-h-64 w-full overflow-y-auto rounded-lg border border-stone-200 bg-white py-1 shadow-lg" role="listbox"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="dosen_pembimbing_2" class="mb-2 block text-base font-semibold text-stone-700">Dosen pembimbing 2 <span class="text-red-600">*</span></label>
                                        <div class="relative">
                                            <input id="dosen_pembimbing_2" name="dosen_pembimbing_2_label" type="text" value="{{ old('dosen_pembimbing_2_label') }}" required autocomplete="off" role="combobox" aria-autocomplete="list" aria-controls="dosen-suggestions-2" aria-expanded="false" placeholder="Ketik nama atau inisial dosen" class="w-full rounded-lg border-stone-300 px-4 py-3 text-base text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                            <input id="dosen_pembimbing_2_id" name="dosen_pembimbing_2_id" type="hidden" value="{{ old('dosen_pembimbing_2_id') }}">
                                            <div id="dosen-suggestions-2" class="absolute z-30 mt-1 hidden max-h-64 w-full overflow-y-auto rounded-lg border border-stone-200 bg-white py-1 shadow-lg" role="listbox"></div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-xs leading-normal text-stone-500">Pilih nama dari daftar sugesti agar kedua pembimbing terhubung dengan data dosen.</p>
                            </div>
                            <div>
                                <label for="akses_naskah" class="mb-2 block text-base font-semibold text-stone-700">Akses naskah di repositori <span class="text-red-600">*</span></label>
                                <select id="akses_naskah" name="akses_naskah" required class="w-full rounded-lg border-stone-300 px-4 py-3 text-base text-stone-800 focus:border-[#1B4D3E] focus:ring-[#1B4D3E]/20">
                                    <option value="" disabled @selected(! old('akses_naskah'))>Pilih jenis akses</option>
                                    <option value="open" @selected(old('akses_naskah') === 'open')>Open Access (Publik)</option><option value="restricted" @selected(old('akses_naskah') === 'restricted')>Restricted (Hanya Civitas Akademika)</option><option value="embargo" @selected(old('akses_naskah') === 'embargo')>Embargo (Ditunda)</option>
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
                    </form>
                </section>

                <aside class="space-y-6 xl:sticky xl:top-24 xl:col-span-3" data-purpose="status-and-guidance-widgets">
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
        const keywordInput = document.getElementById('kata-kunci-input');
        const keywordValue = document.getElementById('kata_kunci');
        const keywordChipList = document.getElementById('kata-kunci-chips');
        const keywordItems = [];
        const dosenInputIds = ['dosen_pembimbing', 'dosen_pembimbing_2'];
        const dosenIdInputs = ['dosen_pembimbing_id', 'dosen_pembimbing_2_id']
            .map((id) => document.getElementById(id));
        const dosenSuggestionsUrl = @json(route('mahasiswa.dosen.suggestions'));

        function renderKeywordChips() {
            keywordChipList.replaceChildren();
            keywordItems.forEach((keyword, index) => {
                const chip = document.createElement('span');
                chip.className = 'inline-flex items-center gap-1 rounded-md bg-emerald-50 px-2.5 py-1 text-sm font-medium text-emerald-900';

                const label = document.createElement('span');
                label.textContent = keyword;

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.className = 'flex h-5 w-5 items-center justify-center rounded text-emerald-800 hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-700';
                removeButton.setAttribute('aria-label', `Hapus kata kunci ${keyword}`);
                removeButton.textContent = '×';
                removeButton.addEventListener('click', () => {
                    keywordItems.splice(index, 1);
                    renderKeywordChips();
                    keywordInput.focus();
                });

                chip.append(label, removeButton);
                keywordChipList.append(chip);
            });

            keywordValue.value = keywordItems.join(', ');
        }

        function addKeywords(value) {
            value.split(',').forEach((candidate) => {
                const keyword = candidate.trim();
                const alreadyAdded = keywordItems.some((item) => item.toLocaleLowerCase() === keyword.toLocaleLowerCase());

                if (keyword && !alreadyAdded) keywordItems.push(keyword);
            });

            keywordInput.value = '';
            keywordInput.setCustomValidity('');
            renderKeywordChips();
        }

        addKeywords(@json(old('kata_kunci', '')));

        keywordInput.addEventListener('input', () => keywordInput.setCustomValidity(''));

        keywordInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ',') {
                event.preventDefault();
                addKeywords(keywordInput.value);
            } else if (event.key === 'Backspace' && !keywordInput.value && keywordItems.length) {
                keywordItems.pop();
                renderKeywordChips();
            }
        });

        function setupDosenAutocomplete(inputId, selectedId, suggestionsId) {
            const input = document.getElementById(inputId);
            const selectedDosenId = document.getElementById(selectedId);
            const suggestions = document.getElementById(suggestionsId);
            let searchTimer;
            let searchController;
            let activeIndex = -1;

            function closeSuggestions() {
                suggestions.classList.add('hidden');
                input.setAttribute('aria-expanded', 'false');
                activeIndex = -1;
            }

            function selectDosen(dosen) {
                input.value = dosen.nama_dosen;
                selectedDosenId.value = dosen.id_dosen;
                input.setCustomValidity('');
                closeSuggestions();
            }

            function renderSuggestions(results, query) {
                suggestions.replaceChildren();
                activeIndex = -1;

                if (!results.length) {
                    const emptyMessage = document.createElement('p');
                    emptyMessage.className = 'px-4 py-3 text-sm text-stone-500';
                    emptyMessage.textContent = `Tidak ada dosen yang cocok dengan "${query}".`;
                    suggestions.append(emptyMessage);
                } else {
                    results.forEach((dosen) => {
                        const option = document.createElement('button');
                        option.type = 'button';
                        option.setAttribute('role', 'option');
                        option.className = 'block w-full px-4 py-3 text-left text-sm text-stone-800 hover:bg-emerald-50 focus:bg-emerald-50 focus:outline-none';

                        const name = document.createElement('span');
                        name.className = 'block font-semibold';
                        name.textContent = dosen.nama_dosen;

                        const initials = document.createElement('span');
                        initials.className = 'mt-0.5 block text-xs text-stone-500';
                        initials.textContent = `Inisial: ${dosen.inisial}`;

                        option.append(name, initials);
                        option.addEventListener('click', () => selectDosen(dosen));
                        suggestions.append(option);
                    });
                }

                suggestions.classList.remove('hidden');
                input.setAttribute('aria-expanded', 'true');
            }

            input.addEventListener('input', () => {
                const query = input.value.trim();
                selectedDosenId.value = '';
                input.setCustomValidity(query ? 'Pilih dosen dari daftar sugesti.' : '');
                window.clearTimeout(searchTimer);
                searchController?.abort();

                if (query.length < 2) {
                    closeSuggestions();
                    return;
                }

                searchTimer = window.setTimeout(async () => {
                    searchController = new AbortController();

                    try {
                        const url = new URL(dosenSuggestionsUrl, window.location.origin);
                        url.searchParams.set('q', query);
                        const response = await fetch(url, { signal: searchController.signal });

                        if (!response.ok) throw new Error('Gagal memuat sugesti dosen.');

                        renderSuggestions(await response.json(), query);
                    } catch (error) {
                        if (error.name !== 'AbortError') renderSuggestions([], query);
                    }
                }, 200);
            });

            input.addEventListener('keydown', (event) => {
                const options = [...suggestions.querySelectorAll('[role="option"]')];

                if (event.key === 'ArrowDown' && options.length) {
                    event.preventDefault();
                    activeIndex = (activeIndex + 1) % options.length;
                    options[activeIndex].focus();
                } else if (event.key === 'Enter' && options.length) {
                    event.preventDefault();
                    options[activeIndex < 0 ? 0 : activeIndex].click();
                } else if (event.key === 'Escape') {
                    closeSuggestions();
                }
            });

            return {
                reset() {
                    selectedDosenId.value = '';
                    input.setCustomValidity('');
                    closeSuggestions();
                },
            };
        }

        const dosenAutocompleteControls = [
            setupDosenAutocomplete('dosen_pembimbing', 'dosen_pembimbing_id', 'dosen-suggestions-1'),
            setupDosenAutocomplete('dosen_pembimbing_2', 'dosen_pembimbing_2_id', 'dosen-suggestions-2'),
        ];

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
                keywordItems.length = 0;
                renderKeywordChips();
                keywordInput.setCustomValidity('');
                dosenAutocompleteControls.forEach((control) => control.reset());
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
            });
        });

        submissionForm.addEventListener('submit', (event) => {
            if (keywordInput.value.trim()) addKeywords(keywordInput.value);
            keywordInput.setCustomValidity(keywordItems.length ? '' : 'Tambahkan minimal satu kata kunci.');
            dosenInputIds.forEach((inputId, index) => {
                const input = document.getElementById(inputId);
                input.setCustomValidity(dosenIdInputs[index].value ? '' : `Pilih dosen pembimbing ${index + 1} dari daftar sugesti.`);
            });

            const firstInvalidField = submissionForm.querySelector(':invalid');
            if (firstInvalidField) {
                event.preventDefault();
                firstInvalidField.reportValidity();
                return;
            }
            const submitButton = submissionForm.querySelector('[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Mengirim pengajuan...';
        });
    </script>
</body>
</html>