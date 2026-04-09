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
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'kelas' => 'ADMIN', 
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        $users = [
            [
                'username' => 'siswa1',
                'name' => 'Radiva Aulia Putri',
                'kelas' => 'X',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa'
            ],
            [
                'username' => 'Siswa2',
                'name' => 'Nabila Varisha',
                'kelas' => 'VII',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa'
            ],
            [
                'username' => 'siswa3',
                'name' => 'Raisya Aninditia',
                'kelas' => 'VII',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa'
            ],

            [
                'username' => 'siswa4',
                'name' => 'Rizky Wahyu',
                'kelas' => 'VIII',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa'
            ],

            [
                'username' => 'siswa5',
                'name' => 'Muhamad Ridho',
                'kelas' => 'VII',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa'
            ],

            [
                'username' => 'siswa6',
                'name' => 'Muhamad Hanif',
                'kelas' => 'X',
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
