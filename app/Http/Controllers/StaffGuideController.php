<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StaffGuideController extends Controller
{
    public function index(): View
    {
        $stages = DB::table('alur_pengajuan')
            ->orderBy('urutan')
            ->get();
        $questions = DB::table('pertanyaan_umum')
            ->orderBy('urutan')
            ->get();
        $waitingCount = DB::table('pengajuan_bebas_pustaka')
            ->whereIn('status', ['menunggu_review', 'diproses'])
            ->count();

        return view('staff.guide', compact('stages', 'questions', 'waitingCount'));
    }

    public function updateStage(Request $request, int $stageId): RedirectResponse
    {
        $validated = $request->validate([
            'nama_tahap' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
            'urutan' => ['required', 'integer', 'min:1', 'max:65535'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $stage = DB::table('alur_pengajuan')->where('id', $stageId)->first(['id']);
        abort_unless($stage, 404);

        DB::table('alur_pengajuan')
            ->where('id', $stageId)
            ->update([
                'nama_tahap' => $validated['nama_tahap'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'urutan' => $validated['urutan'],
                'is_active' => $request->boolean('is_active'),
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return redirect()->route('staff.panduan.index')->with('success', 'Alur pengajuan berhasil diperbarui.');
    }

    public function storeQuestion(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban' => ['required', 'string', 'max:10000'],
            'urutan' => ['required', 'integer', 'min:1', 'max:65535'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
        $now = now();

        DB::table('pertanyaan_umum')->insert([
            'slug' => $this->uniqueQuestionSlug($validated['pertanyaan']),
            'pertanyaan' => $validated['pertanyaan'],
            'jawaban' => $validated['jawaban'],
            'urutan' => $validated['urutan'],
            'is_active' => $request->boolean('is_active'),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('staff.panduan.index')->with('success', 'Pertanyaan umum berhasil ditambahkan.');
    }

    public function updateQuestion(Request $request, int $questionId): RedirectResponse
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban' => ['required', 'string', 'max:10000'],
            'urutan' => ['required', 'integer', 'min:1', 'max:65535'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $question = DB::table('pertanyaan_umum')->where('id', $questionId)->first(['id']);
        abort_unless($question, 404);

        DB::table('pertanyaan_umum')
            ->where('id', $questionId)
            ->update([
                'pertanyaan' => $validated['pertanyaan'],
                'jawaban' => $validated['jawaban'],
                'urutan' => $validated['urutan'],
                'is_active' => $request->boolean('is_active'),
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return redirect()->route('staff.panduan.index')->with('success', 'Pertanyaan umum berhasil diperbarui.');
    }

    public function destroyQuestion(int $questionId): RedirectResponse
    {
        $deleted = DB::table('pertanyaan_umum')->where('id', $questionId)->delete();
        abort_unless($deleted, 404);

        return redirect()->route('staff.panduan.index')->with('success', 'Pertanyaan umum berhasil dihapus.');
    }

    private function uniqueQuestionSlug(string $question): string
    {
        $baseSlug = Str::slug($question);
        $slug = $baseSlug;
        $suffix = 2;

        while (DB::table('pertanyaan_umum')->where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
