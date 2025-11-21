<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['no_ktp','nama','telp','email'];
        $data['dataWarga'] = Warga::filter($request,$filterableColumns)
                                    ->search($request, $searchableColumns)
                                    ->simplePaginate(9)->onEachSide(2) ;
		return view('pages.warga.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp'        => 'required|string|max:20|unique:warga,no_ktp',
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'         => 'nullable|string|max:50',
            'pekerjaan'     => 'nullable|string|max:100',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|string|max:100',
        ]);
        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
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
        $data['dataWarga'] = Warga::findOrFail($id);
        return view('pages.warga.edit', $data);
    }

/**
 * Update the specified resource in storage.
 */
    public function update(Request $request, string $id)
    {
        $warga_id = $id;
        $warga    = Warga::findOrFail($warga_id);

        $warga->no_ktp        = $request->no_ktp;
        $warga->nama          = $request->nama;
        $warga->jenis_kelamin = $request->jenis_kelamin;
        $warga->agama         = $request->agama;
        $warga->pekerjaan     = $request->pekerjaan;
        $warga->telp          = $request->telp;
        $warga->email         = $request->email;

        $warga->save();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

/**
 * Remove the specified resource from storage.
 */
    public function destroy(string $id)
    {
        $warga = Warga::findOrFail($id);

        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
