@extends('layouts.guest.app')
@section('content')
    <!-- Home Section -->
    <section id="home" class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="hero-content">
                        <h1 class="wow fadeInLeft" data-wow-delay=".4s">Sistem Informasi Pertanahan Desa</h1>
                        <p class="wow fadeInLeft" data-wow-delay=".6s">
                            Platform digital untuk mendukung pengelolaan data pertanahan dan pembangunan desa yang lebih
                            transparan, efisien, dan berkelanjutan.
                        </p>
                        <a href="#layanan" class="btn wow fadeInLeft" data-wow-delay=".8s">Jelajahi Layanan</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="hero-image wow fadeInRight" data-wow-delay=".4s">
                        <img src="{{ asset('assets/assets-guest/images/hero/land-map.png') }}" alt="Peta Desa">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Home -->

    <!-- About Section -->
    <section id="about" class="features section">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Tentang Kami</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Pengelolaan Pertanahan Desa</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Sistem Pertanahan Desa merupakan bagian dari program <strong>Bina Desa</strong> yang bertujuan untuk
                    membantu pemerintah desa dalam melakukan pendataan, pengelolaan, dan pemetaan tanah secara digital.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <i class="lni lni-map-marker"></i>
                        <h3>Pemetaan Digital</h3>
                        <p>Mempermudah pemetaan batas tanah dan kepemilikan menggunakan sistem berbasis peta digital.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <i class="lni lni-files"></i>
                        <h3>Data Kepemilikan</h3>
                        <p>Semua data tanah dan pemilik tercatat secara akurat dan mudah diakses oleh pihak berwenang.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <i class="lni lni-users"></i>
                        <h3>Transparansi Publik</h3>
                        <p>Meningkatkan kepercayaan masyarakat dengan sistem yang terbuka dan dapat dipantau bersama.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About -->

    <!-- Layanan Section -->
    <section id="layanan" class="pricing-table section">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Layanan Kami</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Dukungan Untuk Semua Pihak</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Kami menyediakan berbagai layanan digital untuk pengguna desa, warga, dan pengelola data pertanahan.
                </p>
            </div>
            <div class="row">
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-table wow fadeInUp" data-wow-delay=".2s">
                        <div class="table-head">
                            <h4 class="title">Layanan User</h4>
                            <p>Akses data dan peta pertanahan dengan mudah melalui sistem digital desa.</p>
                        </div>
                        <div class="table-content">
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Akses peta tanah desa</li>
                                <li><i class="lni lni-checkmark-circle"></i> Melihat batas wilayah</li>
                                <li><i class="lni lni-checkmark-circle"></i> Informasi kepemilikan tanah</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-table wow fadeInUp" data-wow-delay=".4s">
                        <div class="table-head">
                            <h4 class="title">Layanan Warga</h4>
                            <p>Fasilitasi warga dalam pengurusan dan verifikasi data kepemilikan tanah.</p>
                        </div>
                        <div class="table-content">
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Pengajuan sertifikat tanah</li>
                                <li><i class="lni lni-checkmark-circle"></i> Konsultasi status lahan</li>
                                <li><i class="lni lni-checkmark-circle"></i> Pelaporan konflik pertanahan</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-table wow fadeInUp" data-wow-delay=".6s">
                        <div class="table-head">
                            <h4 class="title">Jenis Penggunaan Tanah</h4>
                            <p>Klasifikasi jenis penggunaan tanah untuk kebutuhan pembangunan desa.</p>
                        </div>
                        <div class="table-content">
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Pertanian & perkebunan</li>
                                <li><i class="lni lni-checkmark-circle"></i> Pemukiman & fasilitas umum</li>
                                <li><i class="lni lni-checkmark-circle"></i> Kawasan industri & komersial</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Layanan -->

    <!-- Kontak Section -->
    <section id="kontak" class="section call-action">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Hubungi Kami</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Kantor Pertanahan Desa</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Untuk informasi lebih lanjut, silakan hubungi kami melalui kontak di bawah ini.
                </p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="contact-info text-center">
                        <p><i class="lni lni-map-marker"></i> Jl. Raya Desa No. 45, Kecamatan Harapan, Kabupaten Bina
                        </p>
                        <p><i class="lni lni-phone"></i> +62 812 3456 7890</p>
                        <p><i class="lni lni-envelope"></i> pertanahan@binadesa.go.id</p>
                        <a href="mailto:pertanahan@binadesa.go.id" class="btn btn-primary mt-3">Kirim Pesan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Kontak -->
@endsection
