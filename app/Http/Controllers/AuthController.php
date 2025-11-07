<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    /**
     * Tampilkan halaman register
     */
    public function create()
    {
        return view('pages.auth.register');
    }

    /**
     * Proses login & register (tergantung tombol yang ditekan)
     */
    public function store(Request $request)
    {
        // Jika tombol login ditekan
        if ($request->has('login')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:3',
            ], [
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 3 karakter',
            ]);

            // Cek apakah email ada di tabel user
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->route('dashboard.index')->with('success', 'Login berhasil!');
            }

            return back()->with('error', 'Email atau password salah')->withInput();
        }

        // Jika tombol register ditekan
        if ($request->has('register')) {
            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users',
                'password' => [
                    'required',
                    'min:3',
                    'regex:/[A-Z]/', // harus ada huruf besar
                    'confirmed',     // pastikan ada field password_confirmation
                ],
            ], [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 3 karakter',
                'password.regex' => 'Password harus mengandung minimal satu huruf kapital',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
            ]);

            // Simpan ke tabel users
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('auth.index')->with('success', 'Akun berhasil dibuat, silakan login!');
        }

        // Jika tidak ada aksi
        return back()->with('error', 'Aksi tidak dikenali.');
    }

    /**
     * Logout user
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index')->with('success', 'Anda telah logout.');
    }
}
