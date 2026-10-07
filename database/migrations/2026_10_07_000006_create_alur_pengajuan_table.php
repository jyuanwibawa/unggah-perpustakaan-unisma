<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alur_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_status', 30)->unique();
            $table->string('nama_tahap', 100);
            $table->text('deskripsi')->nullable();
            $table->unsignedSmallInteger('urutan')->index();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_final')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        $now = now();

        DB::table('alur_pengajuan')->insert([
            [
                'kode_status' => 'menunggu_review',
                'nama_tahap' => 'Diperiksa petugas',
                'deskripsi' => 'Petugas memeriksa kelengkapan pengajuan dan berkas.',
                'urutan' => 1,
                'is_active' => true,
                'is_final' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_status' => 'menunggu_koreksi',
                'nama_tahap' => 'Perlu revisi',
                'deskripsi' => 'Mahasiswa diminta memperbaiki pengajuan sesuai catatan petugas.',
                'urutan' => 2,
                'is_active' => true,
                'is_final' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_status' => 'disetujui',
                'nama_tahap' => 'Disetujui',
                'deskripsi' => 'Pengajuan dinyatakan lengkap dan disetujui petugas.',
                'urutan' => 3,
                'is_active' => true,
                'is_final' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_status' => 'selesai',
                'nama_tahap' => 'Surat siap',
                'deskripsi' => 'Proses selesai dan surat bebas pustaka tersedia untuk diunduh.',
                'urutan' => 4,
                'is_active' => true,
                'is_final' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_status' => 'ditolak',
                'nama_tahap' => 'Ditolak',
                'deskripsi' => 'Pengajuan tidak dapat dilanjutkan; alasan dicatat oleh petugas.',
                'urutan' => 5,
                'is_active' => true,
                'is_final' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kode_status' => 'dibatalkan',
                'nama_tahap' => 'Dibatalkan',
                'deskripsi' => 'Pengajuan dibatalkan dan tidak diproses lebih lanjut.',
                'urutan' => 6,
                'is_active' => true,
                'is_final' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        Schema::table('pengajuan_bebas_pustaka', function (Blueprint $table) {
            $table->foreign('status')
                ->references('kode_status')
                ->on('alur_pengajuan')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_bebas_pustaka', function (Blueprint $table) {
            $table->dropForeign(['status']);
        });

        Schema::dropIfExists('alur_pengajuan');
    }
};
