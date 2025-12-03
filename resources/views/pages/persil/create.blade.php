@extends('layouts.guest.app')

@section('content')

    <br><br>
    <section id="formpersil" class="section team-area">
        <div class="container">

            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Form Input Data Persil</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Tambah Data Persil Baru</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Silahkan isi form berikut untuk menambahkan data persil ke dalam sistem desa.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-12 mb-4">
                    <div class="single-team wow fadeInUp shadow-sm p-4 bg-white"
                        style="border-radius: 15px;">

                        {{-- PENTING: Tambahkan enctype="multipart/form-data" --}}
                        <form action="{{ route('persil.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                            @csrf

                            {{-- Kode Persil --}}
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-1">Kode Persil</label>
                                <input type="text" name="kode_persil" class="form-control @error('kode_persil') is-invalid @enderror"
                                    placeholder="Kode Persil" value="{{ old('kode_persil') }}" required>
                                @error('kode_persil') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Pemilik Warga --}}
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-1">Pemilik Warga</label>
                                <select name="pemilik_warga_id" class="form-select @error('pemilik_warga_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach ($dataWarga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ old('pemilik_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} - {{ $w->no_ktp }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pemilik_warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                {{-- Luas Tanah --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-bold mb-1">Luas (m²)</label>
                                    <input type="number" name="luas_m2" class="form-control @error('luas_m2') is-invalid @enderror"
                                        placeholder="Contoh: 150" value="{{ old('luas_m2') }}" required>
                                    @error('luas_m2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Penggunaan --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-bold mb-1">Penggunaan</label>
                                    <input type="text" name="penggunaan" class="form-control @error('penggunaan') is-invalid @enderror"
                                        placeholder="Contoh: Perumahan" value="{{ old('penggunaan') }}" required>
                                    @error('penggunaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Alamat Lahan --}}
                            <div class="form-group mb-3">
                                <label class="fw-bold mb-1">Alamat Lahan</label>
                                <textarea name="alamat_lahan" class="form-control @error('alamat_lahan') is-invalid @enderror" rows="2"
                                    placeholder="Masukkan alamat lahan" required>{{ old('alamat_lahan') }}</textarea>
                                @error('alamat_lahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                {{-- RT --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-bold mb-1">RT</label>
                                    <input type="text" name="rt" class="form-control"
                                        placeholder="RT" value="{{ old('rt') }}">
                                </div>

                                {{-- RW --}}
                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-bold mb-1">RW</label>
                                    <input type="text" name="rw" class="form-control"
                                        placeholder="RW" value="{{ old('rw') }}">
                                </div>
                            </div>

                            {{-- =========================================== --}}
                            {{-- KOLOM UPLOAD FILE (BARU DITAMBAHKAN) --}}
                            {{-- =========================================== --}}
                            <div class="form-group mb-4">
                                <label class="fw-bold mb-1">Upload Lampiran (Foto/Dokumen)</label>
                                <div class="p-3 bg-light border rounded">
                                    <input type="file" name="files[]" class="form-control" multiple accept=".jpg,.jpeg,.png,.pdf">
                                    <div class="form-text text-muted mt-2">
                                        <i class="fa fa-info-circle me-1"></i>
                                        Bisa pilih banyak file sekaligus. Format: JPG, PNG, PDF (Maks 5MB/file).
                                    </div>

                                    {{-- Menampilkan Error Upload --}}
                                    @if ($errors->has('files.*'))
                                        <div class="text-danger small mt-2">
                                            {{ $errors->first('files.*') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- =========================================== --}}

                            {{-- Tombol --}}
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary me-2 px-4">
                                    <i class="fa fa-save me-1"></i> Simpan Data
                                </button>
                                <a href="{{ route('persil.index') }}" class="btn btn-light px-4 border">
                                    Batal
                                </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
