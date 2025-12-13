@extends('layouts.guest.app')

@section('content')
<br><br>
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-warning text-white text-center py-3">
                        <h5 class="mb-0 text-white">Edit Data Persil</h5>
                    </div>
                    <div class="card-body p-4">

                        <form action="{{ route('persil.update', $dataPersil->persil_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Data Utama --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Kode Persil</label>
                                    <input type="text" name="kode_persil" class="form-control" value="{{ old('kode_persil', $dataPersil->kode_persil) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Pemilik</label>
                                    <select name="pemilik_warga_id" class="form-select" required>
                                        <option value="">-- Pilih Warga --</option>
                                        @foreach($dataWarga as $w)
                                            <option value="{{ $w->warga_id }}" 
                                                {{ old('pemilik_warga_id', $dataPersil->pemilik_warga_id) == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} - {{ $w->no_ktp }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Luas (m²)</label>
                                    <input type="number" step="0.01" name="luas_m2" class="form-control" value="{{ old('luas_m2', $dataPersil->luas_m2) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Penggunaan</label>
                                    <input type="text" name="penggunaan" class="form-control" value="{{ old('penggunaan', $dataPersil->penggunaan) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Lahan</label>
                                <textarea name="alamat_lahan" class="form-control" rows="2" required>{{ old('alamat_lahan', $dataPersil->alamat_lahan) }}</textarea>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-3 col-6">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control" value="{{ old('rt', $dataPersil->rt) }}">
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control" value="{{ old('rw', $dataPersil->rw) }}">
                                </div>
                            </div>

                            <hr>

                            {{-- BAGIAN 1: GALERI FOTO LAMA --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold">Lampiran Saat Ini</label>
                                @if($dataPersil->attachments->count() > 0)
                                    <div class="d-flex flex-wrap gap-3 p-3 bg-light rounded border">
                                        @foreach($dataPersil->attachments as $file)
                                            <div class="text-center position-relative" style="width: 100px;">
                                                <div class="border rounded overflow-hidden bg-white mb-1 shadow-sm" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                                    @if(str_contains($file->mime_type, 'image'))
                                                        <a href="{{ asset('storage/uploads/persil/' . $file->file_name) }}" target="_blank">
                                                            <img src="{{ asset('storage/uploads/persil/' . $file->file_name) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('storage/uploads/persil/' . $file->file_name) }}" target="_blank" class="text-decoration-none text-danger">
                                                            <i class="lni lni-files fs-2"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                                {{-- Tombol Hapus per Item --}}
                                                <button type="button" class="btn btn-xs btn-danger w-100 py-0" 
                                                   style="font-size: 11px;"
                                                   onclick="confirmDeleteMedia('{{ route('persil.deleteMedia', $file->media_id) }}')">
                                                    <i class="lni lni-trash-can"></i> Hapus
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted small fst-italic">Belum ada lampiran tersimpan.</p>
                                @endif
                            </div>

                            {{-- BAGIAN 2: UPLOAD FOTO BARU --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold">Tambah Lampiran Baru</label>
                                <input type="file" name="files[]" id="file-input" class="form-control" multiple accept="image/*,.pdf">
                                
                                <div class="mt-3">
                                    <label class="small text-muted mb-2 fw-bold">Preview Baru:</label>
                                    <div id="image-preview" class="d-flex flex-wrap gap-2"></div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('persil.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary px-5">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Hidden Form Delete Media --}}
<form id="delete-media-form" action="" method="POST" style="display: none;">
    @csrf @method('DELETE')
</form>

<script>
    // Script Preview
    document.getElementById('file-input').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('image-preview');
        previewContainer.innerHTML = ''; 
        if (this.files.length > 0) {
            Array.from(this.files).forEach(file => {
                const imgDiv = document.createElement('div');
                imgDiv.className = 'border rounded overflow-hidden shadow-sm';
                imgDiv.style.width = '80px';
                imgDiv.style.height = '80px';
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        imgDiv.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                } else {
                    imgDiv.className += ' bg-light d-flex align-items-center justify-content-center text-danger';
                    imgDiv.innerHTML = '<i class="lni lni-files fs-4"></i>';
                }
                previewContainer.appendChild(imgDiv);
            });
        }
    });

    // Script Delete Confirm
    function confirmDeleteMedia(url) {
        if (confirm('Yakin ingin menghapus lampiran ini secara permanen?')) {
            var form = document.getElementById('delete-media-form');
            form.action = url;
            form.submit();
        }
    }
</script>
@endsection