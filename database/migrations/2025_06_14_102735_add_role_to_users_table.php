<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
        // Tambahkan kolom 'role' setelah kolom 'email'
        // Tipe enum hanya mengizinkan nilai 'admin' atau 'user'.
        // Defaultnya adalah 'user', jadi semua pendaftar baru otomatis menjadi user.
        $table->string('role')->default('user')->after('email');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
    }
};
