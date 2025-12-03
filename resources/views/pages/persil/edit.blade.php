@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="editpersil" class="section team-area">
        <div class="container">

            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Edit Data Persil</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Perbarui Informasi Persil</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Silahkan perbarui data persil dan kelola lampiran di bawah ini.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-12">

                    {{-- Alert Notifikasi --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="lni lni-checkmark-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="single-team shadow-sm p-4 wow fadeInUp bg-white" style="border-radius: 15px;">

                        {{-- PENTING: enctype="multipart/form-data" WAJIB ADA --}}
                        <form action="{{ route('persil.update', $dataPersil->persil_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Kode Persil --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kode Persil</label>
                                <input type="text" name="kode_persil" class="form-control @error('kode_persil') is-invalid @enderror"
                                    value="{{ old('kode_persil', $dataPersil->kode_persil) }}"
                                    placeholder="Masukkan kode persil">
                                @error('kode_persil') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Pemilik --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pemilik Warga</label>
                                <select name="pemilik_warga_id" class="form-select @error('pemilik_warga_id') is-invalid @enderror">
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach ($dataWarga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ $dataPersil->pemilik_warga_id == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} - {{ $w->no_ktp }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pemilik_warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                {{-- Luas --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Luas (m²)</label>
                                    <input type="number" name="luas_m2" class="form-control @error('luas_m2') is-invalid @enderror"
                                        value="{{ old('luas_m2', $dataPersil->luas_m2) }}" placeholder="0">
                                    @error('luas_m2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Penggunaan --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Penggunaan</label>
                                    <input type="text" name="penggunaan" class="form-control @error('penggunaan') is-invalid @enderror"
                                        value="{{ old('penggunaan', $dataPersil->penggunaan) }}"
                                        placeholder="Contoh: Pertanian">
                                    @error('penggunaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Lahan</label>
                                <textarea name="alamat_lahan" class="form-control @error('alamat_lahan') is-invalid @enderror" rows="2" placeholder="Masukkan alamat">{{ old('alamat_lahan', $dataPersil->alamat_lahan) }}</textarea>
                                @error('alamat_lahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- RT & RW --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">RT</label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ old('rt', $dataPersil->rt) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">RW</label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ old('rw', $dataPersil->rw) }}">
                                </div>
                            </div>

                            <hr class="my-4">

                            {{-- =========================================== --}}
                            {{-- BAGIAN LAMPIRAN (EXISTING & NEW) --}}
                            {{-- =========================================== --}}

                            {{-- 1. Daftar Lampiran yang Sudah Ada --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3"><i class="lni lni-files me-1"></i> Lampiran Saat Ini</label>

                                @if($dataPersil->attachments->count() > 0)
                                    <div class="row g-3">
                                        @foreach($dataPersil->attachments as $media)
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center p-2 border rounded bg-light position-relative">

                                                    {{-- Icon File --}}
                                                    <div class="me-3 text-center" style="width: 40px;">
                                                        @if(str_contains($media->mime_type, 'image'))
                                                            <i class="lni lni-image text-success fs-3"></i>
                                                        @elseif(str_contains($media->mime_type, 'pdf'))
                                                            <i class="lni lni-empty-file text-danger fs-3"></i>
                                                        @else
                                                            <i class="lni lni-files text-secondary fs-3"></i>
                                                        @endif
                                                    </div>

                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="mb-0 small fw-bold text-truncate">{{ $media->caption }}</p>
                                                        <a href="{{ asset('storage/uploads/persil/' . $media->file_name) }}" target="_blank" class="small text-primary text-decoration-none">
                                                            Lihat File
                                                        </a>
                                                    </div>

                                                    {{-- Tombol Hapus per File --}}
                                                    {{-- Pastikan route 'media.delete' sudah dibuat --}}
                                                    <button type="button" class="btn btn-sm btn-danger ms-2"
                                                            onclick="confirmDeleteMedia('{{ route('persil.deleteMedia', $media->media_id) }}')">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-secondary py-2 small">
                                        Belum ada lampiran.
                                    </div>
                                @endif
                            </div>

                            {{-- 2. Upload Lampiran Baru --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="lni lni-cloud-upload me-1"></i> Tambah Lampiran Baru
                                </label>
                                <input type="file" name="files[]" class="form-control" multiple accept=".jpg,.jpeg,.png,.pdf">
                                <div class="form-text text-muted small">
                                    Biarkan kosong jika tidak ingin menambah file baru.
                                </div>
                                @error('files.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            {{-- =========================================== --}}

                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('persil.index') }}" class="btn btn-secondary px-4">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="lni lni-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Script & Form Hidden untuk Delete Media --}}
    <form id="delete-media-form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDeleteMedia(url) {
            if (confirm('Apakah Anda yakin ingin menghapus file lampiran ini?')) {
                var form = document.getElementById('delete-media-form');
                form.action = url;
                form.submit();
            }
        }
    </script>
@endsection
