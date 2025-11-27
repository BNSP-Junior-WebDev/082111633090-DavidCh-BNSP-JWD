<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login.
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Mencoba untuk login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/pinjam');
            }
            return redirect()->intended('/buku');
        }

        // Jika login gagal
        return back()->withErrors([
            'credentials' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan halaman form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi user baru.
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' akan otomatis 'peminjam' sesuai default di migrasi
        ]);

        // Login user yang baru dibuat
        Auth::login($user);

        // Redirect ke halaman daftar buku
        return redirect('/buku');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
