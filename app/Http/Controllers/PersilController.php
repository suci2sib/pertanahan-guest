<?php

namespace App\Http\Controllers;

use App\Models\Persil;
use App\Models\Warga;
use App\Models\Media; // 1. Import Model Media
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // 2. Import Storage untuk hapus file

class PersilController extends Controller
{
    public function index(Request $request)
    {
        $searchableColumns = ['kode_persil', 'penggunaan', 'alamat_lahan'];

        // Tambahkan with('attachments') jika Anda sudah buat relasi di Model Persil
        // Jika belum, hapus bagian ->with('attachments')
        $data['dataPersil'] = Persil::with(['warga', 'attachments'])
            ->search($request, $searchableColumns)
            ->latest()
            ->simplePaginate(9)
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
        // 3. Tambahkan validasi files (gambar/dokumen)
        $validated = $request->validate([
            'kode_persil'      => 'required|string|max:50|unique:persil,kode_persil',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'luas_m2'          => 'required|numeric|min:1',
            'penggunaan'       => 'required|string|max:100',
            'alamat_lahan'     => 'required|string|max:255',
            'rt'               => 'nullable|string|max:5',
            'rw'               => 'nullable|string|max:5',
            'files.*'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120', // Maks 5MB
        ]);

        // Simpan Data Utama
        $persil = Persil::create($validated);

        // 4. LOGIKA UPLOAD FILE
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                // Nama file unik: waktu_index_namaasli
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                // Simpan ke folder 'public/uploads/persil'
                $file->storeAs('uploads/persil', $filename, 'public');

                // Simpan ke Tabel Media
                Media::create([
                    'ref_table'  => 'persil',          // Penanda tabel
                    'ref_id'     => $persil->persil_id, // ID Persil yang baru dibuat
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('persil.index')->with('success', 'Data Persil dan lampiran berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        // Ambil data beserta lampirannya (attachments)
        // Pastikan di Model Persil ada function attachments()
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

        // Update Data Utama
        $persil->update($validated);

        // 5. LOGIKA UPLOAD TAMBAHAN (Update)
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
                    'sort_order' => $index, // Bisa disesuaikan logikanya agar urut
                ]);
            }
        }

        return redirect()->route('persil.index')->with('success', 'Data Persil berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $persil = Persil::findOrFail($id);

        // 6. HAPUS FILE FISIK & DATA MEDIA DULU
        $mediaItems = Media::where('ref_table', 'persil')
                           ->where('ref_id', $persil->persil_id)
                           ->get();

        foreach ($mediaItems as $media) {
            // Hapus file fisik di storage
            if (Storage::disk('public')->exists('uploads/persil/' . $media->file_name)) {
                Storage::disk('public')->delete('uploads/persil/' . $media->file_name);
            }
            // Hapus record di tabel media
            $media->delete();
        }

        // Baru hapus data persil
        $persil->delete();

        return redirect()->route('persil.index')->with('success', 'Data Persil dan berkas terkait berhasil dihapus!');
    }

    /**
     * 7. METHOD TAMBAHAN: Hapus Satu File Media (Dipanggil via AJAX atau Tombol Kecil di Edit)
     */
    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);

        // Hapus fisik
        if (Storage::disk('public')->exists('uploads/persil/' . $media->file_name)) {
            Storage::disk('public')->delete('uploads/persil/' . $media->file_name);
        }

        $media->delete();

        return back()->with('success', 'Lampiran berhasil dihapus.');
    }
}
