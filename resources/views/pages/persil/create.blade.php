@extends('layouts.guest.app')

@section('content')
<br><br>
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0 text-white">Tambah Data Persil</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('persil.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- Form Fields --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Kode Persil <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_persil" class="form-control" value="{{ old('kode_persil') }}" placeholder="Contoh: 001/Blok A" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Pemilik (Warga) <span class="text-danger">*</span></label>
                                    <select name="pemilik_warga_id" class="form-select" required>
                                        <option value="">-- Pilih Warga --</option>
                                        @foreach($dataWarga as $w)
                                            <option value="{{ $w->warga_id }}" {{ old('pemilik_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} - {{ $w->no_ktp }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Luas Tanah (m²) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="luas_m2" class="form-control" value="{{ old('luas_m2') }}" placeholder="0" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Penggunaan Lahan <span class="text-danger">*</span></label>
                                    <input type="text" name="penggunaan" class="form-control" value="{{ old('penggunaan') }}" placeholder="Contoh: Sawah, Kebun, Rumah" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Lahan <span class="text-danger">*</span></label>
                                <textarea name="alamat_lahan" class="form-control" rows="2" placeholder="Alamat lengkap lokasi tanah..." required>{{ old('alamat_lahan') }}</textarea>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-3 col-6">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control" value="{{ old('rt') }}">
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control" value="{{ old('rw') }}">
                                </div>
                            </div>

                            <hr>

                            {{-- UPLOAD SECTION WITH PREVIEW --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold">Upload Foto / Dokumen</label>
                                <div class="alert alert-info py-2 small">
                                    <i class="lni lni-info-alt"></i> Bisa pilih banyak file sekaligus. Format: JPG, PNG, PDF.
                                </div>
                                <input type="file" name="files[]" id="file-input" class="form-control" multiple accept="image/*,.pdf">
                                
                                {{-- PREVIEW CONTAINER --}}
                                <div class="mt-3">
                                    <label class="small text-muted mb-2 fw-bold">Preview:</label>
                                    <div id="image-preview" class="d-flex flex-wrap gap-2">
                                        {{-- Placeholder awal --}}
                                        <div id="placeholder-preview" class="p-3 bg-light border border-dashed rounded text-center text-muted small w-100">
                                            Belum ada gambar dipilih.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('persil.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary px-5">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- JAVASCRIPT PREVIEW --}}
<script>
    document.getElementById('file-input').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('image-preview');
        const placeholder = document.getElementById('placeholder-preview');
        
        // Reset preview
        previewContainer.innerHTML = ''; 

        if (this.files.length > 0) {
            Array.from(this.files).forEach(file => {
                // Container per gambar
                const imgDiv = document.createElement('div');
                imgDiv.className = 'position-relative border rounded overflow-hidden shadow-sm';
                imgDiv.style.width = '100px';
                imgDiv.style.height = '100px';

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
                    // Jika PDF/Lainnya
                    imgDiv.className += ' bg-light d-flex align-items-center justify-content-center text-danger';
                    imgDiv.innerHTML = '<div class="text-center"><i class="lni lni-files fs-3"></i><br><span style="font-size:9px">File</span></div>';
                }
                previewContainer.appendChild(imgDiv);
            });
        } else {
            // Balikin placeholder kalau batal pilih
            previewContainer.innerHTML = '<div class="p-3 bg-light border border-dashed rounded text-center text-muted small w-100">Belum ada gambar dipilih.</div>';
        }
    });
</script>
@endsection