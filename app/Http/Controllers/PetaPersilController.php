<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\PetaPersil;
use App\Models\Persil;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class PetaPersilController extends Controller
{
    // Nama folder penyimpanan di disk 'public'
    private $storagePath = 'uploads/peta_persil';
    // Nama tabel referensi di kolom 'ref_table' tabel Media
    private $refTable = 'peta_persil';
    // Nama Primary Key di tabel PetaPersil
    private $refIdName = 'peta_id';


    public function index(Request $request)
    {
        $searchableColumns = ['panjang_m', 'lebar_m'];

        $data['dataPeta'] = PetaPersil::with(['persil', 'persil.warga'])
            // Anda dapat menambahkan scope filter/search di Model PetaPersil
            // ->search($request, $searchableColumns)
            ->latest()
            ->simplePaginate(10)
            ->withQueryString();

        return view('pages.peta_persil.index', $data);
    }

    public function create()
    {
        // Memuat data Persil dengan relasi pemilik (warga) yang belum memiliki PetaPersil
        // Asumsi relasi Persil ke PetaPersil adalah One-to-One,
        // sehingga kita hanya menampilkan Persil yang belum terdaftar di tabel peta_persil
        $persilIdsWithMap = PetaPersil::pluck('persil_id')->toArray();
        $data['dataPersil'] = Persil::with('warga')
                                    ->whereNotIn('persil_id', $persilIdsWithMap)
                                    ->get();

        return view('pages.peta_persil.create', $data);
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'persil_id'     => 'required|unique:peta_persil,persil_id|exists:persil,persil_id',
            'geojson'       => 'nullable|json',
            'panjang_m'     => 'nullable|numeric|min:0',
            'lebar_m'       => 'nullable|numeric|min:0',
            'files.*'       => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120', // Hanya format gambar atau PDF untuk scan
        ]);

        // 2. Simpan Data Peta (Buang 'files')
        $peta = PetaPersil::create(Arr::except($validated, ['files']));

        // 3. Logic Upload File
        if ($request->hasFile('files')) {
            // Urutkan file berdasarkan nama aslinya untuk konsistensi sort_order
            $files = $request->file('files');
            // Sort files based on their original name (optional, helps maintain order)
            usort($files, fn ($a, $b) => strcmp($a->getClientOriginalName(), $b->getClientOriginalName()));


            foreach ($files as $index => $file) {
                // Generate nama file unik
                $filename = time() . '_' . $peta->{$this->refIdName} . '_' . ($index + 1) . '.' . $file->getClientOriginalExtension();

                // Simpan Fisik ke 'uploads/peta_persil'
                $file->storeAs($this->storagePath, $filename, 'public');

                // Simpan Database Media
                Media::create([
                    'ref_table'  => $this->refTable, // peta_persil
                    'ref_id'     => $peta->{$this->refIdName}, // peta_id
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('peta_persil.index')->with('success', 'Data Peta Persil berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Memuat relasi persil, pemilik persil, dan lampiran media
        $peta = PetaPersil::with(['persil.warga', 'attachments'])->findOrFail($id);
        return view('pages.peta_persil.show', compact('peta'));
    }

    public function edit(string $id)
    {
        $data['dataPeta'] = PetaPersil::with(['persil.warga', 'attachments'])->findOrFail($id);

        // Daftar Persil yang boleh dipilih: Persil yang sedang diedit ATAU Persil yang belum punya peta
        $persilIdsWithMap = PetaPersil::where('persil_id', '!=', $data['dataPeta']->persil_id)
                                    ->pluck('persil_id')
                                    ->toArray();

        $data['dataPersil'] = Persil::with('warga')
                                    ->whereNotIn('persil_id', $persilIdsWithMap)
                                    ->get();

        return view('pages.peta_persil.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $peta = PetaPersil::findOrFail($id);

        $validated = $request->validate([
            // Persil ID unik diabaikan untuk data yang sedang diedit
            'persil_id'     => 'required|unique:peta_persil,persil_id,' . $id . ',' . $this->refIdName . '|exists:persil,persil_id',
            'geojson'       => 'nullable|json',
            'panjang_m'     => 'nullable|numeric|min:0',
            'lebar_m'       => 'nullable|numeric|min:0',
            'files.*'       => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // 1. Update Data Teks
        $peta->update(Arr::except($validated, ['files']));

        // 2. Logic Tambah File Baru (Append)
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            usort($files, fn ($a, $b) => strcmp($a->getClientOriginalName(), $b->getClientOriginalName()));

            $latestSortOrder = Media::where('ref_table', $this->refTable)
                                    ->where('ref_id', $peta->{$this->refIdName})
                                    ->max('sort_order') ?? 0;

            foreach ($files as $index => $file) {
                $filename = time() . '_' . $peta->{$this->refIdName} . '_' . ($index + 1) . '.' . $file->getClientOriginalExtension();

                // Simpan Fisik ke 'uploads/peta_persil'
                $file->storeAs($this->storagePath, $filename, 'public');

                // Simpan Database Media dengan urutan lanjutan
                Media::create([
                    'ref_table'  => $this->refTable,
                    'ref_id'     => $peta->{$this->refIdName},
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $latestSortOrder + $index + 1, // Urutan dilanjutkan
                ]);
            }
        }

        return redirect()->route('peta_persil.index')->with('success', 'Data Peta Persil berhasil diperbarui!');
    }

    /**
     * Hapus Data Peta Beserta Semua Filenya
     */
    public function destroy(string $id)
    {
        $peta = PetaPersil::findOrFail($id);

        $mediaItems = Media::where('ref_table', $this->refTable)
                            ->where('ref_id', $peta->{$this->refIdName})
                            ->get();

        foreach ($mediaItems as $media) {
            // Hapus Fisik dari 'uploads/peta_persil'
            Storage::disk('public')->delete($this->storagePath . '/' . $media->file_name);
            $media->delete();
        }

        $peta->delete();
        return redirect()->route('peta_persil.index')->with('success', 'Data Peta Persil berhasil dihapus!');
    }

    /**
     * Hapus SATU File Peta/Media
     */
    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);

        // Path penyimpanan yang benar
        $path = $this->storagePath . '/' . $media->file_name;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $media->delete();

        return back()->with('success', 'File peta berhasil dihapus.');
    }
}
