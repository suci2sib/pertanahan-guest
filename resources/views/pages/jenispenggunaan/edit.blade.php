@extends('layouts.guest.app')

@section('content')
<section id="form-jenispenggunaan" class="section contact-area">
    <div class="container">
        <div class="section-title text-center">
            <h3 class="wow zoomIn" data-wow-delay=".2s">Edit Data Jenis Penggunaan</h3>
            <h2 class="wow fadeInUp" data-wow-delay=".4s">Perbarui Informasi Jenis Penggunaan Tanah</h2>
            <p class="wow fadeInUp" data-wow-delay=".6s">
                Ubah data berikut sesuai dengan kebutuhan, lalu simpan perubahan.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg wow fadeInUp" data-wow-delay=".8s" style="border-radius: 15px;">
                    <div class="card-body p-4">

                        {{-- Notifikasi Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Perhatian!</strong> Terdapat kesalahan pada input Anda.<br><br>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('jenispenggunaan.update', $dataJenisPenggunaan->jenis_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="nama_penggunaan" class="form-label">Nama Penggunaan <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penggunaan" id="nama_penggunaan"
                                           value="{{ old('nama_penggunaan', $dataJenisPenggunaan->nama_penggunaan) }}"
                                           class="form-control" maxlength="50" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" maxlength="100" rows="3" required>{{ old('keterangan', $dataJenisPenggunaan->keterangan) }}</textarea>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="lni lni-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('jenispenggunaan.index') }}" class="btn btn-secondary btn-lg px-4 ms-2">
                                    <i class="lni lni-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
