@extends('layouts.guest.app')

@section('content')
<br><br>
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-warning text-white text-center py-3">
                        <h5 class="mb-0 text-white">Edit Data Peta Persil</h5>
                    </div>
                    <div class="card-body p-4">

                        {{-- Menggunakan $dataPeta --}}
                        <form action="{{ route('peta_persil.update', $dataPeta->peta_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- PERSIL_ID --}}
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Persil (Lahan) Terkait <span class="text-danger">*</span></label>
                                    <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Persil --</option>
                                        {{-- Menggunakan $dataPersil dari Controller --}}
                                        @foreach($dataPersil as $p)
                                            <option value="{{ $p->persil_id }}"
                                                {{ old('persil_id', $dataPeta->persil_id) == $p->persil_id ? 'selected' : '' }}>
                                                {{ $p->kode_persil ?? 'N/A' }}
                                                ({{ $p->warga->nama ?? 'Pemilik Tidak Diketahui' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('persil_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <h6 class="fw-bold mb-3">Data Geospasial dan Dimensi</h6>

                            {{-- PANJANG M & LEBAR M --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Panjang (meter)</label>
                                    <input type="number" step="0.01" name="panjang_m" class="form-control @error('panjang_m') is-invalid @enderror"
                                        value="{{ old('panjang_m', $dataPeta->panjang_m) }}" placeholder="Panjang lahan">
                                    @error('panjang_m')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Lebar (meter)</label>
                                    <input type="number" step="0.01" name="lebar_m" class="form-control @error('lebar_m') is-invalid @enderror"
                                        value="{{ old('lebar_m', $dataPeta->lebar_m) }}" placeholder="Lebar lahan">
                                    @error('lebar_m')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- GEOJSON --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Data GeoJSON (Koordinat)</label>
                                {{-- GeoJSON harus di-encode ulang jika disimpan sebagai array di model --}}
                                <textarea name="geojson" class="form-control @error('geojson') is-invalid @enderror" rows="5"
                                    placeholder="Paste data GeoJSON atau koordinat peta di sini (format JSON)">{{ old('geojson', json_encode($dataPeta->geojson)) }}</textarea>
                                @error('geojson')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>

                            {{-- BAGIAN 1: GALERI FOTO LAMA --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold">Lampiran Saat Ini ({{ $dataPeta->attachments->count() }} file)</label>
                                @if($dataPeta->attachments->count() > 0)
                                    <div class="d-flex flex-wrap gap-3 p-3 bg-light rounded border">
                                        @foreach($dataPeta->attachments as $file)
                                            <div class="text-center position-relative" style="width: 100px;">
                                                <div class="border rounded overflow-hidden bg-white mb-1 shadow-sm" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                                    @if(str_contains($file->mime_type, 'image'))
                                                        <a href="{{ asset('storage/uploads/peta_persil/' . $file->file_name) }}" target="_blank">
                                                            <img src="{{ asset('storage/uploads/peta_persil/' . $file->file_name) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('storage/uploads/peta_persil/' . $file->file_name) }}" target="_blank" class="text-decoration-none text-danger">
                                                            <i class="lni lni-files fs-2"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                                <small class="d-block text-muted text-truncate" title="{{ $file->caption }}">{{ $file->caption }}</small>

                                                {{-- Tombol Hapus per Item --}}
                                                <button type="button" class="btn btn-xs btn-danger w-100 py-0 mt-1"
                                                     style="font-size: 11px;"
                                                     onclick="confirmDeleteMedia('{{ route('peta_persil.deleteMedia', $file->media_id) }}')">
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
                                <a href="{{ route('peta_persil.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-warning px-5 text-white">Simpan Perubahan</button>
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
    // Script Preview (Disalin dari template sebelumnya)
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

    // Script Delete Confirm (Disalin dari template sebelumnya)
    function confirmDeleteMedia(url) {
        if (confirm('Yakin ingin menghapus lampiran ini secara permanen?')) {
            var form = document.getElementById('delete-media-form');
            form.action = url;
            form.submit();
        }
    }
</script>
@endsection
