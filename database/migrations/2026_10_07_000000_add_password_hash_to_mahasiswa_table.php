<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('password_hash')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropColumn('mahasiswa', 'password_hash');
    }
};
