<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPenggunaan;

class JenisPenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data['dataJenisPenggunaan'] = JenisPenggunaan::all();
		return view('pages.jenispenggunaan.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('pages.jenispenggunaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
    'nama_penggunaan' => 'required|string|max:50',
    'keterangan' => 'required|string|max:100',
]);

$jenisPenggunaan = JenisPenggunaan::create($validated);
return redirect()->route('jenispenggunaan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $data['dataJenisPenggunaan'] = JenisPenggunaan::findOrFail($id);
    return view('pages.jenispenggunaan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $jenis_id = $id;
    $jenisPenggunaan = JenisPenggunaan::findOrFail($jenis_id);

    $jenisPenggunaan->nama_penggunaan = $request->nama_penggunaan;
    $jenisPenggunaan->keterangan = $request->keterangan;

    $jenisPenggunaan->save();

    return redirect()->route('jenispenggunaan.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $jenisPenggunaan = JenisPenggunaan::findOrFail($id);

    $jenisPenggunaan->delete();
    return redirect()->route('jenispenggunaan.index')->with('success', 'Data berhasil dihapus');
    }
}
