<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     */
    public function store(Request $request)
    {
        $request->validate([
            'aspirasi_id' => 'required|exists:aspirasis,id',
            'feedback' => 'required|string',
            'status' => 'required|in:menunggu,proses,selesai',
        ]);

        Feedback::create([
            'aspirasi_id' => $request->aspirasi_id,
            'admin_id' => Auth::id(),
            'feedback' => $request->feedback,
        ]);

      
        $aspirasi = Aspirasi::findOrFail($request->aspirasi_id);
        $aspirasi->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Umpan balik berhasil dikirim dan status diperbarui!');
    }

    /**
     * 
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return back()->with('success', 'Umpan balik berhasil dihapus.');
    }
}
