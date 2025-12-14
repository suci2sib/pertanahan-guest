@extends('layouts.guest.app')

@section('content')
<br><br>
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0 text-white">Tambah Data Peta Persil Baru</h5>
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

                        {{-- ACTION diubah ke peta_persil.store --}}
                        <form action="{{ route('peta_persil.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- PERSIL_ID --}}
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Persil (Lahan) Terkait <span class="text-danger">*</span></label>
                                    {{-- Menggunakan $dataPersil dari Controller (hanya yang belum punya peta) --}}
                                    <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Persil yang Belum Dipetakan --</option>
                                        @foreach($dataPersil as $p)
                                            <option value="{{ $p->persil_id }}" {{ old('persil_id') == $p->persil_id ? 'selected' : '' }}>
                                                {{ $p->kode_persil ?? 'N/A' }}
                                                ({{ $p->warga->nama ?? 'Pemilik Tidak Diketahui' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('persil_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($dataPersil->isEmpty())
                                        <small class="text-info d-block mt-1">Semua Persil sudah memiliki data peta.</small>
                                    @endif
                                </div>
                            </div>

                            <hr>
                            <h6 class="fw-bold mb-3">Data Geospasial dan Dimensi</h6>

                            {{-- PANJANG M & LEBAR M --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Panjang (meter)</label>
                                    <input type="number" step="0.01" name="panjang_m" class="form-control @error('panjang_m') is-invalid @enderror"
                                        value="{{ old('panjang_m') }}" placeholder="Panjang lahan">
                                    @error('panjang_m')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Lebar (meter)</label>
                                    <input type="number" step="0.01" name="lebar_m" class="form-control @error('lebar_m') is-invalid @enderror"
                                        value="{{ old('lebar_m') }}" placeholder="Lebar lahan">
                                    @error('lebar_m')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- GEOJSON --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Data GeoJSON (Koordinat)</label>
                                <textarea name="geojson" class="form-control @error('geojson') is-invalid @enderror" rows="5"
                                    placeholder="Paste data GeoJSON atau koordinat peta di sini (format JSON)">{{ old('geojson') }}</textarea>
                                <small class="text-muted d-block mt-1">Hanya diisi jika tersedia data geospasial.</small>
                                @error('geojson')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>

                            {{-- UPLOAD SECTION WITH PREVIEW --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold">Upload Scan Peta / Lampiran</label>
                                <div class="alert alert-info py-2 small">
                                    <i class="lni lni-info-alt"></i> Format yang diizinkan: JPG, PNG, PDF. Max 5MB per file.
                                </div>
                                <input type="file" name="files[]" id="file-input" class="form-control @error('files.*') is-invalid @enderror" multiple accept="image/*,.pdf">

                                @error('files.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                {{-- PREVIEW CONTAINER --}}
                                <div class="mt-3">
                                    <label class="small text-muted mb-2 fw-bold">Preview:</label>
                                    <div id="image-preview" class="d-flex flex-wrap gap-2">
                                        <div id="placeholder-preview" class="p-3 bg-light border border-dashed rounded text-center text-muted small w-100">
                                            Belum ada file dipilih.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('peta_persil.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary px-5 text-white">Simpan Peta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- JAVASCRIPT PREVIEW (Dipertahankan dari template sebelumnya) --}}
<script>
    document.getElementById('file-input').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('image-preview');
        const placeholder = document.getElementById('placeholder-preview');
        previewContainer.innerHTML = '';

        if (this.files.length > 0) {
            Array.from(this.files).forEach(file => {
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
                    imgDiv.className += ' bg-light d-flex align-items-center justify-content-center text-danger';
                    imgDiv.innerHTML = '<div class="text-center"><i class="lni lni-files fs-3"></i><br><span style="font-size:9px">File</span></div>';
                }
                previewContainer.appendChild(imgDiv);
            });
        } else {
            previewContainer.innerHTML = '<div class="p-3 bg-light border border-dashed rounded text-center text-muted small w-100">Belum ada file dipilih.</div>';
        }
    });
</script>
@endsection
