<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('dosen')) {
            Schema::create('dosen', function (Blueprint $table) {
                $table->id('id_dosen');
                $table->integer('no');
                $table->string('inisial', 10)->unique();
                $table->string('nama_dosen', 100);
                $table->string('npp', 20)->unique();
                $table->string('nidn', 10)->nullable();
                $table->string('unit_kerja', 50)->nullable();
                $table->string('status_kepegawaian', 30)->nullable();
            });
        }

        if (! Schema::hasTable('karyawan')) {
            Schema::create('karyawan', function (Blueprint $table) {
                $table->id('id_karyawan');
                $table->integer('no');
                $table->string('nama', 100);
                $table->string('npp', 20)->unique();
                $table->string('status_kepegawaian', 30)->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
        Schema::dropIfExists('dosen');
    }
};
