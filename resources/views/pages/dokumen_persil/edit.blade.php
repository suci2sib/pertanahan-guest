@extends('layouts.guest.app')

@section('content')
<br><br>
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-warning text-white text-center py-3">
                        <h5 class="mb-0 text-white">Edit Data Dokumen Persil</h5>
                    </div>
                    <div class="card-body p-4">

                        {{-- ACTION diubah ke dokumen_persil.update --}}
                        {{-- Menggunakan $dataDokumen --}}
                        <form action="{{ route('dokumen_persil.update', $dataDokumen->dokumen_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- PERSIL_ID --}}
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Persil (Lahan) Terkait <span class="text-danger">*</span></label>
                                    <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Persil --</option>
                                        {{-- Menggunakan $dataPersil dari Controller --}}
                                        @foreach($dataPersil as $p)
                                            <option value="{{ $p->persil_id }}"
                                                {{ old('persil_id', $dataDokumen->persil_id) == $p->persil_id ? 'selected' : '' }}>
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

                            {{-- JENIS DOKUMEN --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Jenis Dokumen</label>
                                    <input type="text" name="jenis_dokumen" class="form-control @error('jenis_dokumen') is-invalid @enderror"
                                        value="{{ old('jenis_dokumen', $dataDokumen->jenis_dokumen) }}" required>
                                    @error('jenis_dokumen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- NOMOR DOKUMEN --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nomor Dokumen</label>
                                    <input type="text" name="nomor" class="form-control @error('nomor') is-invalid @enderror"
                                        value="{{ old('nomor', $dataDokumen->nomor) }}">
                                    @error('nomor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- KETERANGAN --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Keterangan Tambahan</label>
                                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="2"
                                    placeholder="Detail tentang dokumen ini (Opsional)">{{ old('keterangan', $dataDokumen->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>

                            {{-- BAGIAN 1: GALERI FOTO LAMA --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold">Lampiran Saat Ini ({{ $dataDokumen->attachments->count() }} file)</label>
                                @if($dataDokumen->attachments->count() > 0)
                                    <div class="d-flex flex-wrap gap-3 p-3 bg-light rounded border">
                                        {{-- Menggunakan $dataDokumen->attachments --}}
                                        @foreach($dataDokumen->attachments as $file)
                                            <div class="text-center position-relative" style="width: 100px;">
                                                <div class="border rounded overflow-hidden bg-white mb-1 shadow-sm" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                                    @if(str_contains($file->mime_type, 'image'))
                                                        {{-- PATH diubah ke uploads/dokumen_persil --}}
                                                        <a href="{{ asset('storage/uploads/dokumen_persil/' . $file->file_name) }}" target="_blank">
                                                            <img src="{{ asset('storage/uploads/dokumen_persil/' . $file->file_name) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                        </a>
                                                    @else
                                                        {{-- PATH diubah ke uploads/dokumen_persil --}}
                                                        <a href="{{ asset('storage/uploads/dokumen_persil/' . $file->file_name) }}" target="_blank" class="text-decoration-none text-danger">
                                                            <i class="lni lni-files fs-2"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                                <small class="d-block text-muted text-truncate" title="{{ $file->caption }}">{{ $file->caption }}</small>

                                                {{-- Tombol Hapus per Item --}}
                                                {{-- ROUTE diubah ke dokumen_persil.deleteMedia --}}
                                                <button type="button" class="btn btn-xs btn-danger w-100 py-0 mt-1"
                                                    style="font-size: 11px;"
                                                    onclick="confirmDeleteMedia('{{ route('dokumen_persil.deleteMedia', $file->media_id) }}')">
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
                                <input type="file" name="files[]" id="file-input" class="form-control" multiple accept="image/*,.pdf,.doc,.docx">

                                <div class="mt-3">
                                    <label class="small text-muted mb-2 fw-bold">Preview Baru:</label>
                                    <div id="image-preview" class="d-flex flex-wrap gap-2"></div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('dokumen_persil.index') }}" class="btn btn-secondary">Batal</a>
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

{{-- JAVASCRIPT PREVIEW & DELETE (Dipertahankan) --}}
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
