@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-12">
                    <div class="card shadow-sm" style="border-radius: 15px;">
                        <div class="card-header bg-warning text-white text-center py-3">
                            <h5 class="mb-0 text-white">Edit Data Sengketa Persil</h5>
                        </div>
                        <div class="card-body p-4">

                            {{-- Menggunakan $dataSengketa --}}
                            <form action="{{ route('sengketa_persil.update', $dataSengketa->sengketa_id) }}" method="POST"
                                enctype="multipart/form-data">
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
                                        <label class="form-label fw-bold">Persil (Lahan) Terkait <span
                                                class="text-danger">*</span></label>
                                        <select name="persil_id"
                                            class="form-select @error('persil_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Persil --</option>
                                            {{-- Menggunakan $dataPersil dari Controller --}}
                                            @foreach ($dataPersil as $p)
                                                <option value="{{ $p->persil_id }}"
                                                    {{ old('persil_id', $dataSengketa->persil_id) == $p->persil_id ? 'selected' : '' }}>
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

                                {{-- PIHAK 1 (Penggugat) & PIHAK 2 (Tergugat) --}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Pihak 1</label>
                                        <input type="text" name="pihak_1"
                                            class="form-control @error('pihak_1') is-invalid @enderror"
                                            value="{{ old('pihak_1', $dataSengketa->pihak_1) }}" required>
                                        @error('pihak_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Pihak 2</label>
                                        <input type="text" name="pihak_2"
                                            class="form-control @error('pihak_2') is-invalid @enderror"
                                            value="{{ old('pihak_2', $dataSengketa->pihak_2) }}">
                                        @error('pihak_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- KRONOLOGI --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Kronologi</label>
                                    <textarea name="kronologi" class="form-control @error('kronologi') is-invalid @enderror" rows="3" required>{{ old('kronologi', $dataSengketa->kronologi) }}</textarea>
                                    @error('kronologi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- STATUS & PENYELESAIAN --}}
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Status</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror"
                                            required>
                                            @foreach (['diproses', 'diterima', 'ditolak'] as $s)
                                                <option value="{{ $s }}"
                                                    {{ old('status', $dataSengketa->status) == $s ? 'selected' : '' }}>
                                                    {{ ucfirst($s) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label fw-bold">Penyelesaian</label>
                                        <input type="text" name="penyelesaian"
                                            class="form-control @error('penyelesaian') is-invalid @enderror"
                                            value="{{ old('penyelesaian', $dataSengketa->penyelesaian) }}"
                                            placeholder="Hasil penyelesaian (Opsional)">
                                        @error('penyelesaian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                {{-- BAGIAN 1: GALERI FOTO LAMA --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Lampiran Bukti Saat Ini
                                        ({{ $dataSengketa->attachments->count() }} file)</label>
                                    @if ($dataSengketa->attachments->count() > 0)
                                        <div class="d-flex flex-wrap gap-3 p-3 bg-light rounded border">
                                            @foreach ($dataSengketa->attachments as $file)
                                                <div class="text-center position-relative" style="width: 100px;">
                                                    <div class="border rounded overflow-hidden bg-white mb-1 shadow-sm"
                                                        style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                                        @if (str_contains($file->mime_type, 'image'))
                                                            <a href="{{ asset('storage/uploads/sengketa_persil/' . $file->file_name) }}"
                                                                target="_blank">
                                                                <img src="{{ asset('storage/uploads/sengketa_persil/' . $file->file_name) }}"
                                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                                            </a>
                                                        @else
                                                            <a href="{{ asset('storage/uploads/sengketa_persil/' . $file->file_name) }}"
                                                                target="_blank" class="text-decoration-none text-danger">
                                                                <i class="lni lni-files fs-2"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <small class="d-block text-muted text-truncate"
                                                        title="{{ $file->caption }}">{{ $file->caption }}</small>

                                                    {{-- Tombol Hapus per Item --}}
                                                    <button type="button" class="btn btn-xs btn-danger w-100 py-0 mt-1"
                                                        style="font-size: 11px;"
                                                        onclick="confirmDeleteMedia('{{ route('sengketa_persil.deleteMedia', $file->media_id) }}')">
                                                        <i class="lni lni-trash-can"></i> Hapus
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted small fst-italic">Belum ada lampiran bukti tersimpan.</p>
                                    @endif
                                </div>

                                {{-- BAGIAN 2: UPLOAD FOTO BARU --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Tambah Lampiran Baru</label>
                                    <input type="file" name="files[]" id="file-input" class="form-control" multiple
                                        accept="image/*,.pdf,.doc,.docx">

                                    <div class="mt-3">
                                        <label class="small text-muted mb-2 fw-bold">Preview Baru:</label>
                                        <div id="image-preview" class="d-flex flex-wrap gap-2"></div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('sengketa_persil.index') }}" class="btn btn-secondary">Batal</a>
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
                        imgDiv.className +=
                            ' bg-light d-flex align-items-center justify-content-center text-danger';
                        imgDiv.innerHTML = '<i class="lni lni-files fs-4"></i>';
                    }
                    previewContainer.appendChild(imgDiv);
                });
            }
        });

        // Script Delete Confirm
        function confirmDeleteMedia(url) {
            if (confirm('Yakin ingin menghapus lampiran bukti ini secara permanen?')) {
                var form = document.getElementById('delete-media-form');
                form.action = url;
                form.submit();
            }
        }
    </script>
@endsection
