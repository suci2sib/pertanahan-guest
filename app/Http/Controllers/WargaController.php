<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['no_ktp', 'nama', 'telp', 'email'];

        // 1. Filter & Search
        $query = Warga::filter($request, $filterableColumns)
                      ->search($request, $searchableColumns);
        
        // 2. Urutkan & Paginate (Ganti simplePaginate jadi paginate)
        $data['dataWarga'] = $query->latest()
                                   ->paginate(9)
                                   ->withQueryString(); // 3. Agar filter tidak hilang saat ganti halaman

        return view('pages.warga.index', $data);
    }

    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp'      => 'required|string|max:20|unique:warga,no_ktp',
            'nama'        => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'       => 'nullable|string|max:50',
            'pekerjaan'   => 'nullable|string|max:100',
            'telp'        => 'nullable|string|max:20',
            'email'       => 'nullable|string|max:100',
        ]);
        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $data['dataWarga'] = Warga::findOrFail($id);
        return view('pages.warga.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $warga = Warga::findOrFail($id);
        
        // Validasi ulang unique KTP kecuali milik sendiri
        $request->validate([
            'no_ktp' => 'required|max:20|unique:warga,no_ktp,'.$id.',warga_id',
            'nama'   => 'required|max:100',
            // ... validasi lain disederhanakan
        ]);

        $warga->update($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(string $id)
{
    // Pastikan logikanya: Jika BUKAN Admin DAN BUKAN Super Admin, maka tolak.
    if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Super Admin') {
        return back()->with('error', 'Akses ditolak! Anda tidak memiliki izin.');
    }

        $warga = Warga::findOrFail($id);
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}