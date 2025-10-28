@extends('layouts.guest.app')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #f9f9ff, #fff7f0);">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="display-5 fw-bold text-primary mb-3">Layanan Pertanahan Desa</h1>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Kami menyediakan berbagai layanan yang berkaitan dengan pengelolaan data pertanahan dan administrasi desa.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                    <i class="fa fa-map text-primary fa-2x mb-3"></i>
                    <h5 class="fw-bold text-primary mb-2">Pencarian Data Persil</h5>
                    <p class="text-muted small">Masyarakat dapat mencari informasi lahan berdasarkan kode persil atau nama pemilik secara cepat dan akurat.</p>
                </div>
            </div>

            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.4s">
                <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                    <i class="fa fa-users text-primary fa-2x mb-3"></i>
                    <h5 class="fw-bold text-primary mb-2">Informasi Kepemilikan</h5>
                    <p class="text-muted small">Memberikan data mengenai pemilik tanah, luas lahan, dan penggunaan lahan di wilayah desa.</p>
                </div>
            </div>

            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.6s">
                <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                    <i class="fa fa-envelope text-primary fa-2x mb-3"></i>
                    <h5 class="fw-bold text-primary mb-2">Konsultasi & Pengaduan</h5>
                    <p class="text-muted small">Layanan konsultasi dan pelaporan terkait sengketa tanah atau pembaruan data pertanahan.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
