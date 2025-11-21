@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="editpersil" class="section team-area">
        <div class="container">

            <!-- Judul -->
            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Edit Data Persil</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Perbarui Informasi Persil</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Silahkan perbarui data persil berikut dengan benar.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-12">

                    <div class="single-team shadow-sm p-4 wow fadeInUp" style="border-radius: 15px;">

                        <form action="{{ route('persil.update', $dataPersil->persil_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Kode Persil --}}
                            <div class="mb-3">
                                <label class="form-label">Kode Persil</label>
                                <input type="text" name="kode_persil" class="form-control"
                                    value="{{ old('kode_persil', $dataPersil->kode_persil) }}"
                                    placeholder="Masukkan kode persil">
                            </div>

                            {{-- Pemilik --}}
                            <div class="mb-3">
                                <label class="form-label">Pemilik Warga</label>
                                <select name="pemilik_warga_id" class="form-select">
                                    <option value="">-- Pilih Pemilik --</option>

                                    @foreach ($dataWarga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ $dataPersil->pemilik_warga_id == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} - {{ $w->no_ktp }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Luas --}}
                            <div class="mb-3">
                                <label class="form-label">Luas (m²)</label>
                                <input type="number" name="luas_m2" class="form-control"
                                    value="{{ old('luas_m2', $dataPersil->luas_m2) }}" placeholder="Masukkan luas tanah">
                            </div>

                            {{-- Penggunaan --}}
                            <div class="mb-3">
                                <label class="form-label">Penggunaan</label>
                                <input type="text" name="penggunaan" class="form-control"
                                    value="{{ old('penggunaan', $dataPersil->penggunaan) }}"
                                    placeholder="Contoh: Perumahan, Pertanian, dll">
                            </div>

                            {{-- Alamat --}}
                            <div class="mb-3">
                                <label class="form-label">Alamat Lahan</label>
                                <textarea name="alamat_lahan" class="form-control" rows="2" placeholder="Masukkan alamat lahan">{{ old('alamat_lahan', $dataPersil->alamat_lahan) }}</textarea>
                            </div>

                            {{-- RT & RW --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ old('rt', $dataPersil->rt) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ old('rw', $dataPersil->rw) }}">
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('persil.index') }}" class="btn btn-secondary">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="lni lni-checkmark"></i> Simpan Perubahan
                                </button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
