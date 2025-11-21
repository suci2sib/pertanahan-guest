<?php
namespace App\Http\Controllers;

use App\Models\Persil;
use App\Models\Warga;
use Illuminate\Http\Request;

class PersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataPersil'] = Persil::with('warga')->simplePaginate(10);
        return view('pages.persil.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua data warga untuk dropdown pemilik
        $data['dataWarga'] = Warga::all();
        return view('pages.persil.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_persil'      => 'required|string|max:50|unique:persil,kode_persil',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'luas_m2'          => 'required|numeric|min:1',
            'penggunaan'       => 'required|string|max:100',
            'alamat_lahan'     => 'required|string|max:255',
            'rt'               => 'nullable|string|max:5',
            'rw'               => 'nullable|string|max:5',
        ]);

        Persil::create($validated);
        return redirect()->route('persil.index')->with('success', 'Data Persil berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPersil'] = Persil::findOrFail($id);
        $data['dataWarga']  = Warga::all(); // untuk dropdown pemilik
        return view('pages.persil.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $persil = Persil::findOrFail($id);

        $validated = $request->validate([
            'kode_persil'      => 'required|string|max:50|unique:persil,kode_persil,' . $persil->persil_id . ',persil_id',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'luas_m2'          => 'required|numeric|min:1',
            'penggunaan'       => 'required|string|max:100',
            'alamat_lahan'     => 'required|string|max:255',
            'rt'               => 'nullable|string|max:5',
            'rw'               => 'nullable|string|max:5',
        ]);

        $persil->update($validated);

        return redirect()->route('persil.index')->with('success', 'Data Persil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $persil = Persil::findOrFail($id);
        $persil->delete();
        return redirect()->route('persil.index')->with('success', 'Data Persil berhasil dihapus!');
    }
}
