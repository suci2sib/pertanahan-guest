@extends('layouts.guest.app')

@section('content')

    {{-- Custom CSS Internal --}}
    <style>
        /* --- Hero Section --- */
        .hero-area {
            background-color: #ff6b81; /* Warna Pink Utama */
            padding: 120px 0 100px; /* Padding atas bawah lega */
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            color: #ffffff;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-content p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px;
            margin-bottom: 30px;
            font-weight: 400;
        }

        .hero-content .btn {
            background-color: #ffffff;
            color: #ff6b81;
            font-weight: 600;
            padding: 12px 35px;
            border-radius: 30px; /* Tombol bulat modern */
            border: 2px solid #ffffff;
            transition: all 0.3s ease;
        }

        .hero-content .btn:hover {
            background-color: transparent;
            color: #ffffff;
        }

        /* --- Section Separators (Pemisah Background) --- */
        .section-white {
            background-color: #ffffff;
            padding: 100px 0;
        }

        .section-gray {
            background-color: #f4f6f9; /* Abu-abu muda untuk membedakan section */
            padding: 100px 0;
            border-top: 1px solid #eef2f5;
        }

        /* --- Global Typography --- */
        .section-title {
            margin-bottom: 60px;
            position: relative;
        }

        .section-title h6 {
            color: #ff6b81;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .section-title h2 {
            font-size: 36px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .section-title p {
            color: #7f8c8d;
            font-size: 16px;
            line-height: 1.6;
        }

        /* --- Card Styles (Kotak Layanan) --- */
        .single-card {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Shadow lembut */
            transition: all 0.3s ease-in-out;
            height: 100%; /* Agar tinggi kartu sama rata */
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        /* Efek Hover pada Card */
        .single-card:hover {
            transform: translateY(-10px); /* Naik sedikit saat di-hover */
            box-shadow: 0 15px 35px rgba(255, 107, 129, 0.1); /* Shadow pink tipis */
            border-color: #ff6b81;
        }

        /* Icon Box di dalam Card */
        .single-card .icon-box {
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
            background-color: rgba(255, 107, 129, 0.1); /* Pink transparan */
            color: #ff6b81;
            font-size: 30px;
            text-align: center;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .single-card:hover .icon-box {
            background-color: #ff6b81;
            color: #ffffff;
        }

        /* Variasi Warna Icon (Opsional) */
        .icon-blue { background-color: rgba(52, 152, 219, 0.1) !important; color: #3498db !important; }
        .single-card:hover .icon-blue { background-color: #3498db !important; color: #fff !important; }

        .icon-green { background-color: rgba(46, 204, 113, 0.1) !important; color: #2ecc71 !important; }
        .single-card:hover .icon-green { background-color: #2ecc71 !important; color: #fff !important; }

        .single-card h3, .single-card h4 {
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .single-card p {
            color: #7f8c8d;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* List Styling di dalam Card */
        .table-list {
            padding-left: 0;
            margin-bottom: 0;
        }

        .table-list li {
            list-style: none;
            color: #576574;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .table-list li i {
            color: #ff6b81;
            margin-right: 8px;
            font-weight: bold;
        }

        /* --- Contact Box --- */
        .contact-box {
            background: #ffffff;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }
    </style>

    <section id="home" class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="hero-content text-center text-lg-start">
                        <h1 class="wow fadeInLeft" data-wow-delay=".4s">Sistem Informasi Pertanahan Desa</h1>
                        <p class="wow fadeInLeft" data-wow-delay=".6s">
                            Platform digital untuk mendukung pengelolaan data pertanahan dan pembangunan desa yang lebih
                            transparan, efisien, dan berkelanjutan.
                        </p>
                        <a href="#layanan" class="btn wow fadeInLeft" data-wow-delay=".8s">Jelajahi Layanan</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="hero-image wow fadeInRight text-center mt-5 mt-lg-0" data-wow-delay=".4s">
                        {{-- Pastikan path gambar benar --}}
                        <img src="{{ asset('assets/assets-guest/images/hero/tanah.jpg') }}" alt="Peta Desa" class="img-fluid" style="max-height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="about" class="section-white">
        <div class="container">
            <div class="section-title text-center">
                <h6 class="wow zoomIn" data-wow-delay=".2s">Tentang Kami</h6>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Pengelolaan Pertanahan Desa</h2>
                <p class="wow fadeInUp mx-auto" style="max-width: 700px;" data-wow-delay=".6s">
                    Sistem Pertanahan Desa merupakan bagian dari program <strong>Bina Desa</strong> yang bertujuan untuk
                    membantu pemerintah desa dalam melakukan pendataan, pengelolaan, dan pemetaan tanah secara digital.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-card wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon-box">
                            <i class="lni lni-map-marker"></i>
                        </div>
                        <h3>Pemetaan Digital</h3>
                        <p>Mempermudah pemetaan batas tanah dan kepemilikan menggunakan sistem berbasis peta digital.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-card wow fadeInUp" data-wow-delay=".4s">
                        <div class="icon-box icon-blue">
                            <i class="lni lni-files"></i>
                        </div>
                        <h3>Data Kepemilikan</h3>
                        <p>Semua data tanah dan pemilik tercatat secara akurat dan mudah diakses oleh pihak berwenang.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-card wow fadeInUp" data-wow-delay=".6s">
                        <div class="icon-box icon-green">
                            <i class="lni lni-users"></i>
                        </div>
                        <h3>Transparansi Publik</h3>
                        <p>Meningkatkan kepercayaan masyarakat dengan sistem yang terbuka dan dapat dipantau bersama.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="layanan" class="section-gray">
        <div class="container">
            <div class="section-title text-center">
                <h6 class="wow zoomIn" data-wow-delay=".2s">Layanan Kami</h6>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Dukungan Untuk Semua Pihak</h2>
                <p class="wow fadeInUp mx-auto" style="max-width: 700px;" data-wow-delay=".6s">
                    Kami menyediakan berbagai layanan digital untuk pengguna desa, warga, dan pengelola data pertanahan.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('user.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".2s">
                            <div class="icon-box">
                                <i class="lni lni-user"></i>
                            </div>
                            <h4 class="title">Layanan User</h4>
                            <p>Akses data dan peta pertanahan dengan mudah melalui sistem digital desa.</p>
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Akses peta tanah desa</li>
                                <li><i class="lni lni-checkmark-circle"></i> Melihat batas wilayah</li>
                                <li><i class="lni lni-checkmark-circle"></i> Informasi kepemilikan</li>
                            </ul>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('warga.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".4s">
                            <div class="icon-box icon-blue">
                                <i class="lni lni-home"></i>
                            </div>
                            <h4 class="title">Layanan Warga</h4>
                            <p>Fasilitasi warga dalam pengurusan dan verifikasi data kepemilikan tanah.</p>
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Pengajuan sertifikat</li>
                                <li><i class="lni lni-checkmark-circle"></i> Konsultasi status</li>
                                <li><i class="lni lni-checkmark-circle"></i> Pelaporan konflik</li>
                            </ul>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('jenispenggunaan.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".6s">
                            <div class="icon-box icon-green">
                                <i class="lni lni-layers"></i>
                            </div>
                            <h4 class="title">Jenis Penggunaan</h4>
                            <p>Klasifikasi jenis penggunaan tanah untuk kebutuhan pembangunan desa.</p>
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Pertanian & perkebunan</li>
                                <li><i class="lni lni-checkmark-circle"></i> Pemukiman & fasilitas</li>
                                <li><i class="lni lni-checkmark-circle"></i> Kawasan industri</li>
                            </ul>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('persil.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".2s">
                            <div class="icon-box" style="background-color: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                                <i class="lni lni-map"></i>
                            </div>
                            <h4 class="title">Layanan Persil</h4>
                            <p>Manajemen data persil tanah secara terperinci dan akurat.</p>
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Akses peta persil</li>
                                <li><i class="lni lni-checkmark-circle"></i> Riwayat kepemilikan</li>
                                <li><i class="lni lni-checkmark-circle"></i> Validasi luas tanah</li>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="kontak" class="section-white">
        <div class="container">
            <div class="section-title text-center">
                <h6 class="wow zoomIn" data-wow-delay=".2s">Hubungi Kami</h6>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Kantor Pertanahan Desa</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="contact-box text-center wow fadeInUp" data-wow-delay=".6s">
                        <p class="mb-4 text-muted">Untuk informasi lebih lanjut mengenai pengurusan tanah atau layanan desa, silakan hubungi kami.</p>

                        <div class="row mt-5">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <i class="lni lni-map-marker" style="font-size: 30px; color: #ff6b81;"></i>
                                <h5 class="mt-3" style="font-size: 16px; font-weight: 600;">Lokasi</h5>
                                <p class="small text-muted">Jl. Raya Desa No. 45<br>Kecamatan Harapan</p>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <i class="lni lni-phone" style="font-size: 30px; color: #3498db;"></i>
                                <h5 class="mt-3" style="font-size: 16px; font-weight: 600;">Telepon</h5>
                                <p class="small text-muted">+62 812 3456 7890<br>Senin - Jumat (08:00 - 15:00)</p>
                            </div>
                            <div class="col-md-4">
                                <i class="lni lni-envelope" style="font-size: 30px; color: #2ecc71;"></i>
                                <h5 class="mt-3" style="font-size: 16px; font-weight: 600;">Email</h5>
                                <p class="small text-muted">pertanahan@binadesa.go.id</p>
                            </div>
                        </div>

                        <div class="mt-5">
                            <a href="mailto:pertanahan@binadesa.go.id" class="btn btn-primary" style="background-color: #ff6b81; border: none; padding: 12px 40px; border-radius: 30px;">Kirim Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
