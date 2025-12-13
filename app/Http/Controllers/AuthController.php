<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index')
                ->with('info', 'Anda sudah login!');
        }
        
        return view('pages.auth.login');
    }

    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index')
                ->with('info', 'Anda sudah login!');
        }
        
        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        // ==================== LOGIN ====================
        if ($request->has('login')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:3',
            ]);

            // Gunakan Auth::attempt() untuk handle session otomatis
            $credentials = $request->only('email', 'password');
            
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                
                return redirect()->route('dashboard.index')
                    ->with('success', 'Login berhasil! Selamat datang, ' . Auth::user()->name . '!');
            }

            return back()
                ->with('error', 'Email atau password salah!')
                ->withInput($request->only('email'));
        }

        // ==================== REGISTER ====================
        if ($request->has('register')) {
            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users',
                'role' => 'required|in:Super Admin,Admin,User', // 3 ROLE
                'password' => [
                    'required',
                    'min:3',
                    'regex:/[A-Z]/',
                    'confirmed',
                ],
            ], [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'role.required' => 'Role wajib dipilih',
                'role.in' => 'Role tidak valid',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 3 karakter',
                'password.regex' => 'Password harus mengandung minimal satu huruf kapital',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
            ]);

            // Simpan user baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            // Redirect ke login dengan pesan sukses
            return redirect()->route('auth.index')
                ->with('success', 'Akun berhasil dibuat! Silakan login dengan email dan password Anda.');
        }

        return back()->with('error', 'Aksi tidak valid!')->withInput();
    }

    public function destroy(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.index')
                ->with('error', 'Anda belum login!');
        }
        
        $userName = Auth::user()->name;
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index')
            ->with('success', 'Logout berhasil! Sampai jumpa lagi, ' . $userName . '.');
    }
}