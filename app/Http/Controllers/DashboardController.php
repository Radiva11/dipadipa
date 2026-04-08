<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin dengan statistik
     */
    public function index()
    {
        // Cek apakah user adalah admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }

        // Hitung total data
        $totalAspirasi = Aspirasi::count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalKategori = Kategori::count();

        // Ambil 5 aspirasi terbaru dengan relasi
        $aspirasiTerbaru = Aspirasi::with(['siswa', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        // Hitung statistik berdasarkan status
        $statistikStatus = [
            'menunggu' => Aspirasi::where('status', 'menunggu')->count(),
            'proses' => Aspirasi::where('status', 'proses')->count(),
            'selesai' => Aspirasi::where('status', 'selesai')->count(),
        ];

        // Kirim data ke view
        return view('admin.dashboard', compact(
            'totalAspirasi',
            'totalSiswa',
            'totalKategori',
            'aspirasiTerbaru',
            'statistikStatus'
        ));
    }

    /**
     * Menampilkan daftar semua aspirasi untuk admin
     */
    public function aspirasi()
    {
        // Cek apakah user adalah admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }

        // Ambil semua aspirasi dengan relasi
        $aspirasis = Aspirasi::with(['siswa', 'kategori', 'feedbacks.admin'])
            ->latest()
            ->get();

        return view('admin.aspirasi', compact('aspirasis'));
    }
}
