@extends('layouts.guest.app')

@section('content')
<section id="form-user" class="section contact-area">
    <div class="container">
        <div class="section-title text-center">
            <h3 class="wow zoomIn" data-wow-delay=".2s">Form Tambah User</h3>
            <h2 class="wow fadeInUp" data-wow-delay=".4s">Input Data Pengguna Baru</h2>
            <p class="wow fadeInUp" data-wow-delay=".6s">
                Silakan lengkapi data berikut untuk menambahkan user baru ke sistem.
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

                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                           class="form-control" maxlength="100" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                           class="form-control" maxlength="100" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password"
                                           class="form-control" maxlength="100" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password"
                                           class="form-control" maxlength="100" required>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="lni lni-save"></i> Simpan Data
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-lg px-4 ms-2">
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
