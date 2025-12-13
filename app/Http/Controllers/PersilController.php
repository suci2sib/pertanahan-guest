<?php

namespace App\Http\Controllers;

use App\Models\Persil;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class PersilController extends Controller
{
    public function index(Request $request)
    {
        $searchableColumns = ['kode_persil', 'penggunaan', 'alamat_lahan'];

        // Eager load 'warga' dan 'attachments' biar cepat
        $query = Persil::with(['warga', 'attachments']);

        // 1. Logika Pencarian Kompleks (Termasuk cari nama pemilik)
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($searchableColumns, $keyword) {
                // Cari di kolom tabel persil
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $keyword . '%');
                }
                // ATAU cari di nama pemilik (relasi warga)
                $q->orWhereHas('warga', function($qWarga) use ($keyword) {
                    $qWarga->where('nama', 'LIKE', '%' . $keyword . '%');
                });
            });
        }

        $data['dataPersil'] = $query->latest()
                                    ->paginate(9) // Ganti simplePaginate
                                    ->withQueryString();

        return view('pages.persil.index', $data);
    }

    public function create()
    {
        $data['dataWarga'] = Warga::all();
        return view('pages.persil.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_persil'       => 'required|string|max:50|unique:persil,kode_persil',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'luas_m2'          => 'required|numeric|min:1',
            'penggunaan'       => 'required|string|max:100',
            'alamat_lahan'     => 'required|string|max:255',
            'rt'               => 'nullable|string|max:5',
            'rw'               => 'nullable|string|max:5',
            'files.*'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $persil = Persil::create($validated);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();
                $file->storeAs('uploads/persil', $filename, 'public');

                Media::create([
                    'ref_table'  => 'persil',
                    'ref_id'     => $persil->persil_id,
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('persil.index')->with('success', 'Data Persil berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $data['dataPersil'] = Persil::with('attachments')->findOrFail($id);
        $data['dataWarga']  = Warga::all();
        return view('pages.persil.edit', $data);
    }

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
            'files.*'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $persil->update($validated);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();
                $file->storeAs('uploads/persil', $filename, 'public');

                Media::create([
                    'ref_table'  => 'persil',
                    'ref_id'     => $persil->persil_id,
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('persil.index')->with('success', 'Data Persil berhasil diperbarui!');
    }

    public function destroy(string $id)
{
    // Pastikan logikanya: Jika BUKAN Admin DAN BUKAN Super Admin, maka tolak.
    if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Super Admin') {
        return back()->with('error', 'Akses ditolak! Anda tidak memiliki izin.');
    }

        $persil = Persil::findOrFail($id);

        // 1. Hapus File Fisik & Record Media
        $mediaItems = Media::where('ref_table', 'persil')->where('ref_id', $persil->persil_id)->get();
        foreach ($mediaItems as $media) {
            if (Storage::disk('public')->exists('uploads/persil/' . $media->file_name)) {
                Storage::disk('public')->delete('uploads/persil/' . $media->file_name);
            }
            $media->delete();
        }

        // 2. Hapus Data Persil
        $persil->delete();

        return redirect()->route('persil.index')->with('success', 'Data Persil dan berkas terkait berhasil dihapus!');
    }

    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);
        if (Storage::disk('public')->exists('uploads/persil/' . $media->file_name)) {
            Storage::disk('public')->delete('uploads/persil/' . $media->file_name);
        }
        $media->delete();
        return back()->with('success', 'Lampiran berhasil dihapus.');
    }
}