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

                        <form action="{{ route('persil.store') }}" method="POST" class="forms-sample">
                            @csrf

                            {{-- Kode Persil --}}
                            <div class="form-group mb-3">
                                <label>Kode Persil</label>
                                <input type="text" name="kode_persil" class="form-control"
                                    placeholder="Kode Persil" value="{{ old('kode_persil') }}">
                            </div>

                            {{-- Pemilik Warga --}}
                            <div class="form-group mb-3">
                                <label>Pemilik Warga</label>
                                <select name="pemilik_warga_id" class="form-select">
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach ($dataWarga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ old('pemilik_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} - {{ $w->no_ktp }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Luas Tanah --}}
                            <div class="form-group mb-3">
                                <label>Luas (m²)</label>
                                <input type="number" name="luas_m2" class="form-control"
                                    placeholder="Contoh: 150" value="{{ old('luas_m2') }}">
                            </div>

                            {{-- Penggunaan --}}
                            <div class="form-group mb-3">
                                <label>Penggunaan</label>
                                <input type="text" name="penggunaan" class="form-control"
                                    placeholder="Contoh: Perumahan, Pertanian, dll"
                                    value="{{ old('penggunaan') }}">
                            </div>

                            {{-- Alamat Lahan --}}
                            <div class="form-group mb-3">
                                <label>Alamat Lahan</label>
                                <textarea name="alamat_lahan" class="form-control" rows="2"
                                    placeholder="Masukkan alamat lahan">{{ old('alamat_lahan') }}</textarea>
                            </div>

                            {{-- RT --}}
                            <div class="form-group mb-3">
                                <label>RT</label>
                                <input type="text" name="rt" class="form-control"
                                    placeholder="RT" value="{{ old('rt') }}">
                            </div>

                            {{-- RW --}}
                            <div class="form-group mb-3">
                                <label>RW</label>
                                <input type="text" name="rw" class="form-control"
                                    placeholder="RW" value="{{ old('rw') }}">
                            </div>

                            {{-- Tombol --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary me-2">
                                    Submit
                                </button>
                                <a href="{{ route('persil.index') }}" class="btn btn-light">
                                    Cancel
                                </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

