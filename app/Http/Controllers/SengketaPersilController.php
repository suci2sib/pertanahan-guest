<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Persil;
use App\Models\SengketaPersil;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class SengketaPersilController extends Controller
{
    // Nama folder penyimpanan di disk 'public'
    private $storagePath = 'uploads/sengketa_persil';
    // Nama tabel referensi di kolom 'ref_table' tabel Media
    private $refTable = 'sengketa_persil';
    // Nama Primary Key di tabel SengketaPersil
    private $refIdName = 'sengketa_id';


    public function index(Request $request)
    {
        $filterableColumns = ['status'];
        $searchableColumns = ['pihak_1', 'pihak_2', 'kronologi'];

        $data['dataSengketa'] = SengketaPersil::with(['persil', 'persil.warga'])
            // Asumsi scope filter dan search sudah diimplementasikan di model SengketaPersil
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.sengketa_persil.index', $data);
    }

    public function create()
    {
        // Memuat data Persil dengan relasi pemilik (warga) untuk dropdown
        $data['dataPersil'] = Persil::with('warga')->get();
        return view('pages.sengketa_persil.create', $data);
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'persil_id'       => 'required|exists:persil,persil_id',
            'pihak_1'         => 'required|string|max:150',
            'pihak_2'         => 'nullable|string|max:150',
            'kronologi'       => 'required|string',
            'status'          => 'required|in:ditolak,diterima,diproses', // Menggunakan ENUM yang sudah kita definisikan
            'penyelesaian'    => 'nullable|string',
            'files.*'         => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:5120', // Validasi File
        ]);

        // 2. Simpan Data Sengketa (Buang 'files')
        $sengketa = SengketaPersil::create(Arr::except($validated, ['files']));

        // 3. Logic Upload File
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                // Generate nama file unik
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                // Simpan Fisik ke 'uploads/sengketa_persil'
                $file->storeAs($this->storagePath, $filename, 'public');

                // Simpan Database Media
                Media::create([
                    'ref_table'  => $this->refTable, // sengketa_persil
                    'ref_id'     => $sengketa->{$this->refIdName}, // sengketa_id
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('sengketa_persil.index')->with('success', 'Data Sengketa berhasil ditambahkan!');
    }


    public function edit(string $id)
    {
        $data['dataSengketa'] = SengketaPersil::with(['persil.warga', 'attachments'])->findOrFail($id);
        $data['dataPersil']  = Persil::with('warga')->get();

        return view('pages.sengketa_persil.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $sengketa = SengketaPersil::findOrFail($id);

        $validated = $request->validate([
            'persil_id'       => 'required|exists:persil,persil_id',
            'pihak_1'         => 'required|string|max:150',
            'pihak_2'         => 'nullable|string|max:150',
            'kronologi'       => 'required|string',
            'status'          => 'required|in:ditolak,diterima,diproses',
            'penyelesaian'    => 'nullable|string',
            'files.*'         => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:5120',
        ]);

        // 1. Update Data Teks
        $sengketa->update(Arr::except($validated, ['files']));

        // 2. Logic Tambah File Baru (Append)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                // Simpan Fisik ke 'uploads/sengketa_persil'
                $file->storeAs($this->storagePath, $filename, 'public');

                // Simpan Database Media
                Media::create([
                    'ref_table'  => $this->refTable,
                    'ref_id'     => $sengketa->{$this->refIdName},
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('sengketa_persil.index')->with('success', 'Data Sengketa berhasil diperbarui!');
    }

    /**
     * Hapus Data Sengketa Beserta Semua Filenya
     */
    public function destroy(string $id)
    {
        $sengketa = SengketaPersil::findOrFail($id);

        $mediaItems = Media::where('ref_table', $this->refTable)
                            ->where('ref_id', $sengketa->{$this->refIdName})
                            ->get();

        foreach ($mediaItems as $media) {
            // Hapus Fisik dari 'uploads/sengketa_persil'
            Storage::disk('public')->delete($this->storagePath . '/' . $media->file_name);
            $media->delete();
        }

        $sengketa->delete();
        return redirect()->route('sengketa_persil.index')->with('success', 'Data Sengketa berhasil dihapus!');
    }

    /**
     * Hapus SATU File Sengketa
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

        return back()->with('success', 'File sengketa berhasil dihapus.');
    }
}
