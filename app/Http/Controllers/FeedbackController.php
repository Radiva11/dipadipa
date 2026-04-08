<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Menyimpan umpan balik dari Admin untuk aspirasi tertentu.
     */
    public function store(Request $request)
    {
        // Validasi input sesuai kebutuhan aplikasi [cite: 52, 56]
        $request->validate([
            'aspirasi_id' => 'required|exists:aspirasis,id',
            'feedback' => 'required|string',
            'status' => 'required|in:menunggu,proses,selesai',
        ]);

        // 1. Simpan data ke tabel feedbacks
        Feedback::create([
            'aspirasi_id' => $request->aspirasi_id,
            'admin_id' => Auth::id(), // Mengambil ID admin yang sedang login
            'feedback' => $request->feedback,
        ]);

        // 2. Update status pada tabel aspirasi [cite: 31, 34]
        $aspirasi = Aspirasi::findOrFail($request->aspirasi_id);
        $aspirasi->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Umpan balik berhasil dikirim dan status diperbarui!');
    }

    /**
     * Menghapus feedback jika diperlukan (Opsional)
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return back()->with('success', 'Umpan balik berhasil dihapus.');
    }
}
