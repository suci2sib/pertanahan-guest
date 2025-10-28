@extends('layouts.guest.app')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #f9f9ff, #fff7f0);">
    <div class="container py-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-primary mb-3">
                <i class="fa-solid fa-circle-info me-2"></i> Tentang Sistem Pertanahan Desa
            </h1>
            <p class="text-muted mx-auto" style="max-width: 800px;">
                Sistem informasi pertanahan desa ini mempermudah warga dan aparatur desa dalam
                mengelola data persil, kepemilikan lahan, dan administrasi pertanahan secara digital.
            </p>
        </div>

        <!-- Tujuan Modul -->
        <div class="row g-5 mb-5">
            <div class="col-md-4 text-center">
                <i class="fa-solid fa-users fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Modul Masyarakat</h5>
                <p class="text-muted small">
                    Warga dapat melihat informasi lahan, kepemilikan persil, dan status administrasi secara cepat dan mudah.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fa-solid fa-gears fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Modul Aparatur Desa</h5>
                <p class="text-muted small">
                    Aparatur desa dapat memanage data persil, memvalidasi kepemilikan, dan membuat laporan administrasi pertanahan.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fa-solid fa-map-location-dot fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Modul Transparansi</h5>
                <p class="text-muted small">
                    Memberikan akses terbuka untuk warga mengenai kepemilikan tanah dan status persil agar transparansi terjaga.
                </p>
            </div>
        </div>

        <!-- Alur Penggunaan -->
        <div class="mb-5">
            <h2 class="text-primary mb-4"><i class="fa-solid fa-flow-chart me-2"></i> Alur Penggunaan Sistem</h2>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item">
                    <strong>Login/Guest:</strong> Warga mengakses sistem melalui halaman utama atau sebagai guest.
                </li>
                <li class="list-group-item">
                    <strong>Pencarian Data Persil:</strong> Warga mencari data lahan menggunakan kode persil atau nama pemilik.
                </li>
                <li class="list-group-item">
                    <strong>Informasi Kepemilikan:</strong> Menampilkan detail lahan, luas, alamat, RT/RW, dan penggunaan.
                </li>
                <li class="list-group-item">
                    <strong>Konsultasi & Pengaduan:</strong> Warga dapat mengirim pertanyaan atau laporan terkait sengketa tanah.
                </li>
                <li class="list-group-item">
                    <strong>Validasi Aparatur Desa:</strong> Aparatur memproses data masuk, memvalidasi kepemilikan, dan update status persil.
                </li>
            </ol>
        </div>

        <!-- Gambar Pendukung -->
        <div class="text-center">
            <img src="{{ asset('images/pertanahan-overview.png') }}" alt="Ilustrasi Pertanahan Desa" class="img-fluid rounded-4 shadow-sm" style="max-width: 80%;">
            <p class="text-muted small mt-2">Ilustrasi alur dan modul sistem pertanahan desa</p>
        </div>
    </div>
</section>
@endsection
