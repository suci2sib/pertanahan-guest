@extends('layouts.guest.app')

@section('content')
    <!-- Form Edit Warga -->
    <section id="form-warga" class="section contact-area">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Edit Data Warga</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Perbarui Data Warga Desa</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Silakan ubah data yang diperlukan, kemudian simpan untuk memperbarui informasi warga.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card shadow-lg wow fadeInUp" data-wow-delay=".8s" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            {{-- Notifikasi error --}}
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

                            <form action="{{ route('warga.update', $dataWarga->warga_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_ktp" class="form-label">No. KTP <span class="text-danger">*</span></label>
                                        <input type="text" name="no_ktp" id="no_ktp"
                                            value="{{ old('no_ktp', $dataWarga->no_ktp) }}"
                                            class="form-control" maxlength="20" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" id="nama"
                                            value="{{ old('nama', $dataWarga->nama) }}"
                                            class="form-control" maxlength="100" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="agama" class="form-label">Agama</label>
                                        <input type="text" name="agama" id="agama"
                                            value="{{ old('agama', $dataWarga->agama) }}"
                                            class="form-control" maxlength="50">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" id="pekerjaan"
                                            value="{{ old('pekerjaan', $dataWarga->pekerjaan) }}"
                                            class="form-control" maxlength="100">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="telp" class="form-label">No. Telepon</label>
                                        <input type="text" name="telp" id="telp"
                                            value="{{ old('telp', $dataWarga->telp) }}"
                                            class="form-control" maxlength="20">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', $dataWarga->email) }}"
                                            class="form-control" maxlength="100">
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success btn-lg px-4">
                                        <i class="lni lni-save"></i> Perbarui Data
                                    </button>
                                    <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-lg px-4 ms-2">
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
