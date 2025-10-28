<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view('guest.auth.login'); // arahkan ke view resources/views/auth/login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input awal
        $request->validate([
            'username' => 'required|max:10',
            'password' => 'required|min:3',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Cek password mengandung huruf kapital
        if (!preg_match('/[A-Z]/', $password)) {
            return redirect('/auth')
                ->withInput()
                ->with('error', 'Password harus mengandung minimal satu huruf kapital.');
        }

        // Jika username atau password kosong (cek tambahan)
        if (empty($username) || empty($password)) {
            return redirect('/auth')
                ->withInput()
                ->with('error', 'Username dan password wajib diisi.');
        }

        // Cek login sederhana
        if ($username === 'Suci' && $password === 'Ucicomel20') {
            // Simpan nama di session
            session(['guest_name' => ucfirst($username)]);
            return redirect('/guest/persil')->with('success', 'Login berhasil!');
        } else {
            return redirect('/auth')
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
