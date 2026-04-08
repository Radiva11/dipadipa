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
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }

        $totalAspirasi = Aspirasi::count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalKategori = Kategori::count();

        $aspirasiTerbaru = Aspirasi::with(['siswa', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        $statistikStatus = [
            'menunggu' => Aspirasi::where('status', 'menunggu')->count(),
            'proses' => Aspirasi::where('status', 'proses')->count(),
            'selesai' => Aspirasi::where('status', 'selesai')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalAspirasi',
            'totalSiswa',
            'totalKategori',
            'aspirasiTerbaru',
            'statistikStatus'
        ));
    }

    /**
     */
    public function aspirasi()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }

        $aspirasis = Aspirasi::with(['siswa', 'kategori', 'feedbacks.admin'])
            ->latest()
            ->get();

        return view('admin.aspirasi', compact('aspirasis'));
    }
}
