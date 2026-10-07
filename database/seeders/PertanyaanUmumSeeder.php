<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanUmumSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('pertanyaan_umum')->insertOrIgnore([
            [
                'slug' => 'berkas-yang-harus-diunggah',
                'pertanyaan' => 'Berkas apa saja yang harus diunggah?',
                'jawaban' => 'Siapkan tiga berkas PDF: naskah lengkap, lembar pengesahan yang sudah ditandatangani, dan pernyataan orisinalitas yang sudah ditandatangani.',
                'urutan' => 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'pengajuan-perlu-revisi',
                'pertanyaan' => 'Pengajuan saya perlu revisi. Apa yang harus dilakukan?',
                'jawaban' => 'Buka Riwayat pengajuan, baca catatan revisi petugas, perbaiki berkas yang diminta, lalu kirim ulang melalui halaman Ajukan bebas pustaka.',
                'urutan' => 2,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'jenis-akses-naskah',
                'pertanyaan' => 'Apa bedanya pilihan akses naskah?',
                'jawaban' => 'Open Access membuat naskah dapat dibaca publik. Restricted membatasi akses untuk civitas akademika. Embargo menunda pembukaan naskah sampai masa yang ditentukan.',
                'urutan' => 3,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'penyimpanan-draf-form',
                'pertanyaan' => 'Apakah isian form tersimpan kalau halaman ditutup?',
                'jawaban' => 'Penyimpanan draf otomatis belum tersedia. Pengajuan baru tersimpan setelah form dikirim dan berhasil divalidasi; isian yang belum dikirim dapat hilang jika halaman ditutup atau dimuat ulang.',
                'urutan' => 4,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'kontak-bantuan-perpustakaan',
                'pertanyaan' => 'Siapa yang bisa saya hubungi kalau ada masalah?',
                'jawaban' => 'Silakan menghubungi layanan referensi Perpustakaan UNISMA melalui kanal kontak resmi perpustakaan.',
                'urutan' => 5,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
