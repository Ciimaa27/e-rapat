<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // nanti kita buat view-nya
    }

    // proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // arahkan sesuai role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('dashboard'); // dashboard admin
                case 'notulis':
                    return redirect()->route('dashboard'); // nanti dashboard cek role juga
                case 'pimpinan':
                    return redirect()->route('dashboard');
                case 'pegawai':
                default:
                    return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
