<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StaffGuideTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_can_manage_workflow_content_and_visibility(): void
    {
        $stage = DB::table('alur_pengajuan')
            ->where('kode_status', 'menunggu_review')
            ->first();

        $this->get(route('staff.panduan.index'))
            ->assertOk()
            ->assertSee('Kelola Panduan')
            ->assertSee(route('staff.panduan.index'));

        $this->put(route('staff.panduan.stage.update', $stage->id), [
            'nama_tahap' => 'Pemeriksaan berkas',
            'deskripsi' => 'Petugas meninjau dokumen mahasiswa.',
            'urutan' => 2,
        ])
            ->assertRedirect(route('staff.panduan.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('alur_pengajuan', [
            'id' => $stage->id,
            'nama_tahap' => 'Pemeriksaan berkas',
            'deskripsi' => 'Petugas meninjau dokumen mahasiswa.',
            'urutan' => 2,
            'is_active' => false,
            'kode_status' => 'menunggu_review',
        ]);

        $this->get(route('mahasiswa.panduan'))
            ->assertOk()
            ->assertDontSee('Pemeriksaan berkas');
    }

    public function test_staff_can_create_update_hide_and_delete_faq_items(): void
    {
        $this->post(route('staff.panduan.faq.store'), [
            'pertanyaan' => 'Bagaimana cara mengecek status?',
            'jawaban' => 'Buka halaman riwayat pengajuan.',
            'urutan' => 1,
            'is_active' => 1,
        ])
            ->assertRedirect(route('staff.panduan.index'))
            ->assertSessionHas('success');

        $question = DB::table('pertanyaan_umum')->where('slug', 'bagaimana-cara-mengecek-status')->first();
        $this->assertNotNull($question);
        $this->get(route('mahasiswa.panduan'))
            ->assertOk()
            ->assertSee('Bagaimana cara mengecek status?');

        $this->put(route('staff.panduan.faq.update', $question->id), [
            'pertanyaan' => 'Bagaimana melihat status pengajuan?',
            'jawaban' => 'Lihat bagian riwayat.',
            'urutan' => 2,
        ])
            ->assertRedirect(route('staff.panduan.index'));

        $this->assertDatabaseHas('pertanyaan_umum', [
            'id' => $question->id,
            'pertanyaan' => 'Bagaimana melihat status pengajuan?',
            'jawaban' => 'Lihat bagian riwayat.',
            'is_active' => false,
        ]);
        $this->get(route('mahasiswa.panduan'))
            ->assertOk()
            ->assertDontSee('Bagaimana melihat status pengajuan?');

        $this->delete(route('staff.panduan.faq.destroy', $question->id))
            ->assertRedirect(route('staff.panduan.index'));

        $this->assertDatabaseMissing('pertanyaan_umum', ['id' => $question->id]);
    }
}
