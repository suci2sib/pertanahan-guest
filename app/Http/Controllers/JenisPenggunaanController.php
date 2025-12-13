<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPenggunaan;
use Illuminate\Support\Facades\Auth;

class JenisPenggunaanController extends Controller
{
    public function index(Request $request)
    {
        $searchableColumns = ['nama_penggunaan', 'keterangan'];
        
        $data['dataJenisPenggunaan'] = JenisPenggunaan::search($request, $searchableColumns)
            ->paginate(9)
            ->withQueryString();

        return view('pages.jenispenggunaan.index', $data);
    }

    public function create() { return view('pages.jenispenggunaan.create'); }
    
    public function store(Request $request) {
        $validated = $request->validate(['nama_penggunaan' => 'required|max:50', 'keterangan' => 'required|max:100']);
        JenisPenggunaan::create($validated);
        return redirect()->route('jenispenggunaan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    public function edit(string $id) {
        $data['dataJenisPenggunaan'] = JenisPenggunaan::findOrFail($id);
        return view('pages.jenispenggunaan.edit', $data);
    }

    public function update(Request $request, string $id) {
        $jp = JenisPenggunaan::findOrFail($id);
        $jp->update($request->all());
        return redirect()->route('jenispenggunaan.index')->with('success', 'Perubahan Data Berhasil!');
    }

    public function destroy(string $id)
{
    // Pastikan logikanya: Jika BUKAN Admin DAN BUKAN Super Admin, maka tolak.
    if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Super Admin') {
        return back()->with('error', 'Akses ditolak! Anda tidak memiliki izin.');
    }
        JenisPenggunaan::findOrFail($id)->delete();
        return redirect()->route('jenispenggunaan.index')->with('success', 'Data berhasil dihapus');
    }
}