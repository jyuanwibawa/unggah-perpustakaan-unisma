<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_bebas_pustaka', function (Blueprint $table) {
            $table->unsignedBigInteger('dosen_pembimbing_2_id')->nullable()->after('dosen_pembimbing_id');
            $table->foreign('dosen_pembimbing_2_id')
                ->references('id_dosen')
                ->on('dosen')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_bebas_pustaka', function (Blueprint $table) {
            $table->dropForeign(['dosen_pembimbing_2_id']);
            $table->dropColumn('dosen_pembimbing_2_id');
        });
    }
};
