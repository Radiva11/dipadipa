<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request)
{
    // 1. Ambil input dan hilangkan spasi tambahan di awal/akhir
    // 2. Gunakan mb_convert_case untuk Nama agar tiap awal kata jadi Huruf Kapital (ucwords)
    $nameInput = mb_convert_case(trim($request->name), MB_CASE_TITLE, "UTF-8");

    // 3. Gunakan strtoupper agar Kelas selalu Huruf Kapital (x jadi X, vii jadi VII)
    $kelasInput = strtoupper(trim($request->kelas));

    // Cari user dengan data yang sudah dibersihkan
    $user = \App\Models\User::where('name', $nameInput)
                            ->where('kelas', $kelasInput)
                            ->first();

    if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        \Illuminate\Support\Facades\Auth::login($user);
        $request->session()->regenerate();

        return $user->role === 'admin'
            ? redirect()->intended('/admin/dashboard')
            : redirect()->intended('/siswa/aspirasi');
    }

    return back()->withErrors(['login' => 'Nama, Kelas, atau Password tidak terdaftar.'])->withInput();
}
    public function logout(Request $request) {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect('/login')->with('success', 'Anda berhasil logout!');
    }
}
