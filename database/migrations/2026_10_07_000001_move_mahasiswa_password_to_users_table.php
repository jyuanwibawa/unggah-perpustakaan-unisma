<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('password_hash');
            $table->foreignId('user_id')->unique()->nullable()->constrained('users')->cascadeOnDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->unique()->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nim');
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->string('password_hash')->nullable();
        });
    }
};
