@extends('layouts.guest.app')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #f7e9e9, #f5f8ff);">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="display-5 fw-bold text-primary mb-3">Kontak Kami</h1>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Jika Anda memiliki pertanyaan atau membutuhkan bantuan terkait sistem pertanahan desa, jangan ragu untuk menghubungi kami.
            </p>
        </div>

        <div class="row g-5 align-items-center">
            <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.2s">
                <h5 class="fw-bold text-primary mb-3">Kantor Pertanahan Desa</h5>
                <p class="text-muted mb-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Jl. Raya Desa No. 10, Kecamatan Maju Jaya</p>
                <p class="text-muted mb-2"><i class="fa fa-phone-alt text-primary me-2"></i>(021) 1234 5678</p>
                <p class="text-muted mb-2"><i class="fa fa-envelope text-primary me-2"></i>pertanahan@desa.id</p>
                <p class="text-muted"><i class="fa fa-clock text-primary me-2"></i>Senin - Jumat, 08.00 - 16.00 WIB</p>
            </div>

            <div class="col-md-6 wow fadeInRight" data-wow-delay="0.4s">
                <form method="POST" action="#">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="nama" class="form-control border-0 shadow-sm py-3" placeholder="Nama Anda" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control border-0 shadow-sm py-3" placeholder="Email Anda" required>
                        </div>
                        <div class="col-12">
                            <textarea name="pesan" rows="4" class="form-control border-0 shadow-sm py-3" placeholder="Tulis pesan Anda..." required></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill px-5 py-2" type="submit">Kirim Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
