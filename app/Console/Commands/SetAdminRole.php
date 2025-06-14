<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // <-- Jangan lupa tambahkan ini

class SetAdminRole extends Command
{
    /**
     * Nama dan signature dari console command.
     * {email} berarti kita mengharapkan input email.
     */
    protected $signature = 'user:set-admin {muhamadhafizhalbar@gmail.com}'; // <-- UBAH INI

    /**
     * Deskripsi dari console command.
     */
    protected $description = 'Ubah peran seorang pengguna menjadi admin berdasarkan email'; // <-- UBAH INI

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 1. Ambil input email dari perintah terminal
    $email = $this->argument('email');

    // 2. Cari pengguna di database berdasarkan email tersebut
    $user = User::where('email', $email)->first();

    // 3. Cek apakah pengguna ditemukan
    if (!$user) {
        $this->error("Pengguna dengan email '{$email}' tidak ditemukan.");
        return 1; // Return 1 menandakan ada error
    }

    // 4. Jika ditemukan, ubah perannya menjadi 'admin' dan simpan
    $user->role = 'admin';
    $user->save();

    // 5. Berikan pesan sukses di terminal
    $this->info("Sukses! Pengguna '{$user->name}' ({$email}) sekarang adalah seorang admin.");

    return 0; // Return 0 menandakan sukses
    }
}