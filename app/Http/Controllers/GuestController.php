<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Menampilkan halaman utama / daftar data persil
    public function index()
    {
        return view('guest.home');
    }

    // Halaman Tentang
    public function about()
    {
        return view('guest.about');
    }

    // Halaman Layanan
    public function services()
    {
        return view('guest.services');
    }

    // Halaman Kontak (GET)
    public function contact()
    {
        return view('guest.contact');
    }

    // Menangani form Kontak (POST)
    public function sendContact(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'pesan' => 'required|string|max:1000',
        ]);

        // Simpan data ke database atau kirim email di sini
        // Untuk sementara kita tampilkan pesan sukses saja
        return back()->with('success', 'Pesan Anda berhasil dikirim! Terima kasih sudah menghubungi kami.');
    }
}
