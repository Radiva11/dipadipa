<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index() {
        $kategoris = Kategori::all();
        $histori = Aspirasi::where('siswa_id', Auth::id())
        ->with(['kategori', 'feedbacks']) 
        ->latest()
        ->get();
        return view('siswa.aspirasi', compact('kategoris', 'histori'));
    }

    public function store(Request $request) {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi' => 'required|string|max:50', 
            'keterangan' => 'required|string|max:255'
        ]);

        Aspirasi::create([
            'siswa_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'status' => 'menunggu'
        ]);

        return back()->with('success', 'Aspirasi berhasil dikirim!');
    }
}
 