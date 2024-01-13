<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.profil-lppm');
            } else {
                return redirect()->route('dosen.profil-lppm');
            }
        }
        return view('all.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nidn', 'password');

        if (Auth::attempt($credentials)) {
            // Cek apakah user adalah admin
            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'nidn' => 'NIDN atau Password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
