<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'mysql') {
            $dosenIdType = DB::selectOne(
                "SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'dosen' AND COLUMN_NAME = 'id_dosen'"
            )->COLUMN_TYPE;

            if ($dosenIdType !== 'bigint unsigned') {
                Schema::table('dosen', function (Blueprint $table) {
                    $table->unsignedBigInteger('id_dosen')->autoIncrement()->change();
                });
            }
        }

        $tableWasCreated = ! Schema::hasTable('pengajuan_bebas_pustaka');

        if ($tableWasCreated) {
            Schema::create('pengajuan_bebas_pustaka', function (Blueprint $table) {
                $table->id();
                $table->string('nomor_pengajuan', 30)->unique();
                $table->bigInteger('nim');
                $table->unsignedBigInteger('user_id');
                $table->string('judul_karya', 200);
                $table->string('jenis_karya', 30);
                $table->unsignedSmallInteger('tahun_lulus');
                $table->text('abstrak');
                $table->text('kata_kunci')->nullable();
                $table->unsignedBigInteger('dosen_pembimbing_id')->nullable();
                $table->string('akses_naskah', 20);
                $table->string('status', 30)->default('menunggu_review');
                $table->text('status_keterangan')->nullable();
                $table->timestamp('tanggal_diajukan')->default(now());
                $table->timestamp('tanggal_diperiksa')->nullable();
                $table->timestamp('tanggal_disetujui')->nullable();
                $table->timestamps();

                $table->foreign('nim')
                    ->references('nim')
                    ->on('mahasiswa')
                    ->cascadeOnDelete();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete();
                $table->foreign('dosen_pembimbing_id')
                    ->references('id_dosen')
                    ->on('dosen')
                    ->nullOnDelete();
            });
        }

        if (! Schema::hasTable('pengajuan_bebas_pustaka_dokumen')) {
            Schema::create('pengajuan_bebas_pustaka_dokumen', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('pengajuan_id');
                $table->string('jenis_dokumen', 30);
                $table->string('nama_asli', 255);
                $table->string('path', 500);
                $table->string('mime_type', 100)->default('application/pdf');
                $table->unsignedBigInteger('ukuran_bytes');
                $table->string('sha256', 64)->nullable();
                $table->timestamps();

                $table->foreign('pengajuan_id')
                    ->references('id')
                    ->on('pengajuan_bebas_pustaka')
                    ->cascadeOnDelete();
                $table->unique(
                    ['pengajuan_id', 'jenis_dokumen'],
                    'uq_pengajuan_dokumen_jenis',
                );
            });
        }

        if (! $tableWasCreated && Schema::hasTable('pengajuan_bebas_pustaka')) {
            $foreignKeys = collect(DB::select(
                "SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'pengajuan_bebas_pustaka'"
            ))->pluck('CONSTRAINT_NAME')->all();

            if (! in_array('pengajuan_bebas_pustaka_dosen_pembimbing_id_foreign', $foreignKeys, true)) {
                Schema::table('pengajuan_bebas_pustaka', function (Blueprint $table) {
                    $table->unsignedBigInteger('dosen_pembimbing_id')->nullable()->change();
                    $table->foreign('dosen_pembimbing_id')
                        ->references('id_dosen')
                        ->on('dosen')
                        ->nullOnDelete();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_bebas_pustaka_dokumen');
        Schema::dropIfExists('pengajuan_bebas_pustaka');
    }
};
