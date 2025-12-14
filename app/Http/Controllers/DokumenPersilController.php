<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Persil;
use App\Models\DokumenPersil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;

class DokumenPersilController extends Controller
{
    // Nama folder penyimpanan di disk 'public'
    private $storagePath = 'uploads/dokumen_persil';
    // Nama tabel referensi di kolom 'ref_table' tabel Media
    private $refTable = 'dokumen_persil';
    // Nama Primary Key di tabel DokumenPersil
    private $refIdName = 'dokumen_id';


    public function index(Request $request)
    {
        $filterableColumns = ['jenis_dokumen'];
        $searchableColumns = ['nomor', 'keterangan'];

        $data['dataDokumen'] = DokumenPersil::with('persil')
            // Asumsi Anda memiliki scope filter dan search di model DokumenPersil
            // ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.dokumen_persil.index', $data);
    }

    public function create()
    {
        $data['dataPersil'] = Persil::all();
        return view('pages.dokumen_persil.create', $data);
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'persil_id'       => 'required|exists:persil,persil_id',
            'jenis_dokumen'   => 'required|string|max:255',
            'nomor'           => 'nullable|string|max:255',
            'keterangan'      => 'nullable|string',
            'files.*'         => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:5120', // Validasi File
        ]);

        // 2. Simpan Data Dokumen (Buang 'files')
        $dokumen = DokumenPersil::create(Arr::except($validated, ['files']));

        // 3. Logic Upload File
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                // Generate nama file unik
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                // Simpan Fisik ke 'uploads/dokumen_persil'
                $file->storeAs($this->storagePath, $filename, 'public');

                // Simpan Database Media
                Media::create([
                    'ref_table'  => $this->refTable,
                    'ref_id'     => $dokumen->{$this->refIdName}, // Mengambil dokumen_id
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('dokumen_persil.index')->with('success', 'Data Dokumen berhasil ditambahkan!');
    }

    
    public function edit(string $id)
    {
        $data['dataDokumen'] = DokumenPersil::with(['persil', 'attachments'])->findOrFail($id);
        $data['dataPersil']  = Persil::all();

        return view('pages.dokumen_persil.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $dokumen = DokumenPersil::findOrFail($id);

        $validated = $request->validate([
            'persil_id'       => 'required|exists:persil,persil_id',
            'jenis_dokumen'   => 'required|string|max:255',
            'nomor'           => 'nullable|string|max:255',
            'keterangan'      => 'nullable|string',
            'files.*'         => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:5120',
        ]);

        // 1. Update Data Teks
        $dokumen->update(Arr::except($validated, ['files']));

        // 2. Logic Tambah File Baru (Append)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                // Simpan Fisik ke 'uploads/dokumen_persil'
                $file->storeAs($this->storagePath, $filename, 'public');

                // Simpan Database Media
                Media::create([
                    'ref_table'  => $this->refTable,
                    'ref_id'     => $dokumen->{$this->refIdName},
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('dokumen_persil.index')->with('success', 'Data Dokumen berhasil diperbarui!');
    }

    /**
     * Hapus Data Dokumen Beserta Semua Filenya
     */
    public function destroy(string $id)
    {
        $dokumen = DokumenPersil::findOrFail($id);

        $mediaItems = Media::where('ref_table', $this->refTable)
                            ->where('ref_id', $dokumen->{$this->refIdName})
                            ->get();

        foreach ($mediaItems as $media) {
            // Hapus Fisik dari 'uploads/dokumen_persil'
            Storage::disk('public')->delete($this->storagePath . '/' . $media->file_name);
            $media->delete();
        }

        $dokumen->delete();
        return redirect()->route('dokumen_persil.index')->with('success', 'Data Dokumen berhasil dihapus!');
    }

    /**
     * Hapus SATU File Dokumen
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

        return back()->with('success', 'File dokumen berhasil dihapus.');
    }
}
