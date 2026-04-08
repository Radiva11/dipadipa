<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah login dan role admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login')->with('error', 'Silakan login sebagai admin!');
        }

        $users = User::orderBy('role', 'desc')
                     ->orderBy('name', 'asc')
                     ->get();
        return view('admin.users.index', compact('users'));
    }

    // Menambah user baru
    public function store(Request $request)
    {
        // Cek apakah user sudah login dan role admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login')->with('error', 'Silakan login sebagai admin!');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|unique:users,username|max:50',
            'password' => 'required|min:5',
            'role' => 'required|in:admin,siswa',
            'kelas' => 'nullable|string|max:10'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'kelas' => $request->kelas,
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    // Menghapus user
    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login')->with('error', 'Silakan login sebagai admin!');
        }

        $user = User::findOrFail($id);

    
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat menghapus user admin!');
        }

       
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}


