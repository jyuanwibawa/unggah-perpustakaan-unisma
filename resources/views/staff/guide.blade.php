<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Panduan - Panel Pustakawan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
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
        <x-staff.sidebar active="panduan" :waiting-count="$waitingCount" />

        <main class="min-w-0 flex-1 overflow-y-auto">
            <x-staff.header
                title="Kelola Panduan"
                subtitle="Atur informasi alur pengajuan dan pertanyaan umum yang ditampilkan kepada mahasiswa."
                :current-date="now()->locale('id')->translatedFormat('l, j F Y')"
                :waiting-count="$waitingCount"
            />

            <div class="mx-auto w-full max-w-[1500px] space-y-8 p-5 sm:p-8 lg:p-10">
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

                <section class="space-y-4" aria-labelledby="workflow-heading">
                    <div>
                        <h2 id="workflow-heading" class="font-serif text-2xl font-bold text-slate-900">Alur pengajuan</h2>
                        <p class="mt-1 text-sm text-slate-600">Perbarui nama tahap, penjelasan, urutan, dan visibilitas. Kode status sistem tidak dapat diubah.</p>
                    </div>

                    @forelse ($stages as $stage)
                        <form method="POST" action="{{ route('staff.panduan.stage.update', $stage->id) }}" class="rounded-xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-6">
                            @csrf
                            @method('PUT')
                            <div class="mb-5 flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-4">
                                <div>
                                    <h3 class="font-semibold text-slate-900">{{ $stage->nama_tahap }}</h3>
                                    <p class="mt-1 font-mono text-xs text-slate-400">{{ $stage->kode_status }}</p>
                                </div>
                                @if ($stage->is_final)
                                    <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-600">Tahap akhir</span>
                                @endif
                            </div>
                            <div class="grid gap-4 md:grid-cols-2">
                                <label class="block text-sm font-medium text-slate-700">
                                    Nama tahap
                                    <input name="nama_tahap" value="{{ $stage->nama_tahap }}" required maxlength="100" class="mt-1.5 w-full rounded-lg border-slate-300 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">
                                </label>
                                <label class="block text-sm font-medium text-slate-700">
                                    Urutan
                                    <input name="urutan" type="number" min="1" max="65535" value="{{ $stage->urutan }}" required class="mt-1.5 w-full rounded-lg border-slate-300 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">
                                </label>
                                <label class="block text-sm font-medium text-slate-700 md:col-span-2">
                                    Deskripsi
                                    <textarea name="deskripsi" rows="2" maxlength="2000" class="mt-1.5 w-full rounded-lg border-slate-300 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">{{ $stage->deskripsi }}</textarea>
                                </label>
                            </div>
                            <div class="mt-4 flex flex-wrap items-center justify-between gap-4">
                                <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-700">
                                    <input type="checkbox" name="is_active" value="1" @checked($stage->is_active) class="rounded border-slate-300 text-[#1b4d3e] focus:ring-[#1b4d3e]/30">
                                    Tampilkan kepada mahasiswa
                                </label>
                                <button type="submit" class="rounded-lg bg-[#1b4d3e] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#164639] focus:outline-none focus:ring-2 focus:ring-[#1b4d3e] focus:ring-offset-2">Simpan tahap</button>
                            </div>
                        </form>
                    @empty
                        <p class="rounded-xl border border-slate-200 bg-white p-6 text-sm text-slate-500">Alur pengajuan belum tersedia.</p>
                    @endforelse
                </section>

                <section class="space-y-4" aria-labelledby="faq-heading">
                    <div>
                        <h2 id="faq-heading" class="font-serif text-2xl font-bold text-slate-900">Pertanyaan umum</h2>
                        <p class="mt-1 text-sm text-slate-600">Tambah, ubah, urutkan, sembunyikan, atau hapus pertanyaan dan jawaban.</p>
                    </div>

                    <form method="POST" action="{{ route('staff.panduan.faq.store') }}" class="rounded-xl border border-emerald-200 bg-white p-5 shadow-sm sm:p-6">
                        @csrf
                        <h3 class="mb-4 text-base font-semibold text-slate-900">Tambah pertanyaan</h3>
                        <div class="grid gap-4 md:grid-cols-2">
                            <label class="block text-sm font-medium text-slate-700">
                                Pertanyaan
                                <input name="pertanyaan" value="{{ old('pertanyaan') }}" required maxlength="255" class="mt-1.5 w-full rounded-lg border-slate-300 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">
                            </label>
                            <label class="block text-sm font-medium text-slate-700">
                                Urutan
                                <input name="urutan" type="number" min="1" max="65535" value="{{ old('urutan', $questions->max('urutan') + 1) }}" required class="mt-1.5 w-full rounded-lg border-slate-300 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">
                            </label>
                            <label class="block text-sm font-medium text-slate-700 md:col-span-2">
                                Jawaban
                                <textarea name="jawaban" rows="3" required maxlength="10000" class="mt-1.5 w-full rounded-lg border-slate-300 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">{{ old('jawaban') }}</textarea>
                            </label>
                        </div>
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-4">
                            <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-700">
                                <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-300 text-[#1b4d3e] focus:ring-[#1b4d3e]/30">
                                Tampilkan kepada mahasiswa
                            </label>
                            <button type="submit" class="rounded-lg bg-[#1b4d3e] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#164639]">Tambah pertanyaan</button>
                        </div>
                    </form>

                    @forelse ($questions as $question)
                        <article class="rounded-xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-6">
                            <form method="POST" action="{{ route('staff.panduan.faq.update', $question->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                                    <h3 class="font-semibold text-slate-900">FAQ #{{ $question->urutan }}</h3>
                                    <span class="font-mono text-xs text-slate-400">{{ $question->slug }}</span>
                                </div>
                                <div class="grid gap-4 md:grid-cols-2">
                                    <label class="block text-sm font-medium text-slate-700">
                                        Pertanyaan
                                        <input name="pertanyaan" value="{{ $question->pertanyaan }}" required maxlength="255" class="mt-1.5 w-full rounded-lg border-slate-300 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">
                                    </label>
                                    <label class="block text-sm font-medium text-slate-700">
                                        Urutan
                                        <input name="urutan" type="number" min="1" max="65535" value="{{ $question->urutan }}" required class="mt-1.5 w-full rounded-lg border-slate-300 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">
                                    </label>
                                    <label class="block text-sm font-medium text-slate-700 md:col-span-2">
                                        Jawaban
                                        <textarea name="jawaban" rows="3" required maxlength="10000" class="mt-1.5 w-full rounded-lg border-slate-300 text-sm focus:border-[#1b4d3e] focus:ring-[#1b4d3e]/20">{{ $question->jawaban }}</textarea>
                                    </label>
                                </div>
                                <div class="mt-4 flex flex-wrap items-center justify-between gap-4">
                                    <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-700">
                                        <input type="checkbox" name="is_active" value="1" @checked($question->is_active) class="rounded border-slate-300 text-[#1b4d3e] focus:ring-[#1b4d3e]/30">
                                        Tampilkan kepada mahasiswa
                                    </label>
                                    <button type="submit" class="rounded-lg bg-[#1b4d3e] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#164639]">Simpan perubahan</button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('staff.panduan.faq.destroy', $question->id) }}" class="mt-4 border-t border-slate-100 pt-4" onsubmit="return confirm('Hapus pertanyaan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-semibold text-rose-700 hover:text-rose-900">Hapus pertanyaan</button>
                            </form>
                        </article>
                    @empty
                        <p class="rounded-xl border border-slate-200 bg-white p-6 text-sm text-slate-500">Belum ada pertanyaan umum.</p>
                    @endforelse
                </section>
            </div>
        </main>
    </div>
</body>
</html>
