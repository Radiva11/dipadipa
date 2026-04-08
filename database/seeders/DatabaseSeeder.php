<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT ADMIN
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'kelas' => 'ADMIN', // Sesuaikan dengan pilihan di dropdown login
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. BUAT SISWA CONTOH (Sesuai Dropdown)
        $users = [
            [
                'username' => 'siswa1',
                'name' => 'Radiva Aulia Putri',
                'kelas' => 'X', // Harus sama persis dengan <option value="X">
                'password' => Hash::make('siswa123'),
                'role' => 'siswa'
            ],
            [
                'username' => 'siswa2',
                'name' => 'Nabila Varisha',
                'kelas' => 'VII',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa'
            ],
            [
                'username' => 'siswa3',
                'name' => 'Rizky Pratama',
                'kelas' => 'VII',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa'
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(['username' => $user['username']], $user);
        }

        // 3. BUAT KATEGORI
        $kategoris = [
            ['nama_kategori' => 'Laboratorium Komputer', 'deskripsi' => 'Fasilitas lab'],
            ['nama_kategori' => 'Ruang Kelas', 'deskripsi' => 'Fasilitas kelas'],
            ['nama_kategori' => 'Toilet', 'deskripsi' => 'Fasilitas toilet'],
        ];

        foreach ($kategoris as $k) {
            Kategori::firstOrCreate(['nama_kategori' => $k['nama_kategori']], $k);
        }
    }
}
