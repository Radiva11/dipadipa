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
    $nameInput = mb_convert_case(trim($request->name), MB_CASE_TITLE, "UTF-8");

    $kelasInput = strtoupper(trim($request->kelas));

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
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect('/login')->with('success', 'Anda berhasil logout!');
    }
}
