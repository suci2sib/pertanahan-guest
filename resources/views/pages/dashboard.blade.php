@extends('layouts.guest.app')

@section('content')
    {{-- 1. IMPORT FONT ESTETIK (QUICKSAND) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- 2. CSS GLOBAL & SECTION STYLES --}}
    <style>
        /* --- GLOBAL FONT SETTING --- */
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        div,
        li,
        button {
            font-family: 'Quicksand', sans-serif !important;
        }

        /* Mengatur ketebalan font agar enak dibaca */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            /* Bold untuk judul */
        }

        p,
        li,
        a {
            font-weight: 500;
            /* Medium untuk teks biasa biar gak terlalu tipis */
        }

        /* --- HERO SECTION --- */
        .hero-area {
            background-color: #ff6b81;
            padding: 120px 0 100px;
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            color: #ffffff;
            font-size: 48px;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-content p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px;
            margin-bottom: 30px;
        }

        .hero-content .btn {
            background-color: #ffffff;
            color: #ff6b81;
            font-weight: 700;
            padding: 12px 35px;
            border-radius: 30px;
            border: 2px solid #ffffff;
            transition: all 0.3s ease;
        }

        .hero-content .btn:hover {
            background-color: transparent;
            color: #ffffff;
        }

        /* --- SEPARATORS --- */
        .section-white {
            background-color: #ffffff;
            padding: 80px 0;
        }

        .section-gray {
            background-color: #f9f9f9;
            padding: 80px 0;
            border-top: 1px solid #eee;
        }

        /* --- TITLES --- */
        .section-title {
            margin-bottom: 50px;
            position: relative;
        }

        .section-title h6 {
            color: #ff6b81;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .section-title h2 {
            font-size: 34px;
            color: #333;
            margin-bottom: 15px;
        }

        .section-title p {
            color: #777;
            font-size: 16px;
            line-height: 1.6;
        }

        /* --- CARD LAYANAN --- */
        .single-card {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 20px;
            /* Lebih rounded */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease-in-out;
            height: 100%;
            border: 1px solid #f0f0f0;
        }

        .single-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(255, 107, 129, 0.1);
            border-color: #ff6b81;
        }

        .single-card .icon-box {
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
            background-color: #fff0f3;
            color: #ff6b81;
            font-size: 30px;
            text-align: center;
            margin-bottom: 25px;
            transition: 0.3s;
        }

        .single-card:hover .icon-box {
            background-color: #ff6b81;
            color: #ffffff;
        }

        .icon-blue {
            background-color: #eaf6ff !important;
            color: #3498db !important;
        }

        .single-card:hover .icon-blue {
            background-color: #3498db !important;
            color: #fff !important;
        }

        .icon-green {
            background-color: #eafaf1 !important;
            color: #2ecc71 !important;
        }

        .single-card:hover .icon-green {
            background-color: #2ecc71 !important;
            color: #fff !important;
        }

        .single-card h4.title {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        .table-list li {
            list-style: none;
            color: #666;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .table-list li i {
            color: #ff6b81;
            margin-right: 8px;
            font-weight: 700;
        }

        /* --- CONTACT BOX --- */
        .contact-box {
            background: #ffffff;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        /* --- ABOUT SECTION STYLES --- */
        .about-img-wrapper {
            position: relative;
            max-width: 300px;
            margin: 0 auto;
        }

        .about-img-main {
            width: 100%;
            border-radius: 25px;
            position: relative;
            z-index: 2;
            border: 4px solid #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .about-img-decoration {
            position: absolute;
            top: 15px;
            right: -15px;
            width: 100%;
            height: 100%;
            border: 2px dashed #ff6b81;
            border-radius: 25px;
            z-index: 1;
            opacity: 0.6;
        }

        .blur-shape {
            position: absolute;
            width: 180px;
            height: 180px;
            background: #ffe3e8;
            filter: blur(40px);
            border-radius: 50%;
            z-index: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.5;
        }

        .about-label {
            background: #fff0f3;
            color: #ff6b81;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: inline-block;
        }

        .feature-item {
            display: flex;
            align-items: start;
            margin-bottom: 15px;
        }

        .feature-icon {
            width: 35px;
            height: 35px;
            background: #fff0f3;
            color: #ff6b81;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
            transition: 0.3s;
        }

        .feature-item:hover .feature-icon {
            background: #ff6b81;
            color: #fff;
            transform: rotate(360deg);
        }

        /* Flow Mini */
        .flow-wrapper {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px dashed #ffe3e8;
        }

        .flow-icon-circle {
            width: 45px;
            height: 45px;
            background: #fff;
            border: 2px solid #fff0f3;
            color: #ff6b81;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 18px;
            transition: 0.3s;
        }

        .flow-item:hover .flow-icon-circle {
            background: #ff6b81;
            color: #fff;
            transform: translateY(-5px);
        }

        .flow-step {
            font-size: 11px;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        @media (min-width: 992px) {
            .flow-arrow {
                position: absolute;
                top: 20px;
                right: -50%;
                color: #ffe3e8;
                font-size: 20px;
            }
        }

        /* --- DEVELOPER SECTION --- */
        .dev-card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dev-card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(255, 107, 129, 0.15) !important;
        }

        /* --- FOOTER STYLES (Slim Gacor Wave) --- */
        .footer-area {
            position: relative;
            background: linear-gradient(135deg, #ff6b81 0%, #ff8796 100%);
            color: #ffffff;
            padding-top: 50px;
            padding-bottom: 15px;
            margin-top: 60px;
            font-size: 13px;
        }

        .wave-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: translateY(-99%);
        }

        .wave-container svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 40px;
        }

        .wave-container .shape-fill {
            fill: #ff6b81;
        }

        .footer-brand {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .footer-widget h6 {
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 15px;
            letter-spacing: 1px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            display: inline-block;
            padding-bottom: 3px;
        }

        .footer-links li a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-links li a:hover {
            color: #fff;
            padding-left: 5px;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        .social-btn {
            display: inline-flex;
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            margin-right: 8px;
            transition: 0.3s;
        }

        .social-btn:hover {
            background: #fff;
            color: #ff6b81;
            transform: translateY(-2px);
        }

        .schedule-list li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.3);
            padding-bottom: 4px;
        }

        .copyright-area {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dev-badge {
            background: #fff;
            color: #ff6b81;
            padding: 4px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .dev-badge:hover {
            background: #ffe3e8;
            transform: scale(1.05);
        }

        .whatsapp-float {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 25px;
            right: 25px;
            background: #25d366;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>

    {{-- SECTION 1: HERO AREA (SLIDESHOW) --}}
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
                    <div class="hero-image wow fadeInRight mt-5 mt-lg-0" data-wow-delay=".4s">
                        <div id="heroCarousel" class="carousel slide shadow rounded-4 overflow-hidden"
                            data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0"
                                    class="active"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/assets-guest/images/hero/tanah.jpg') }}"
                                        class="d-block w-100" alt="Peta" style="height: 400px; object-fit: cover;">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/assets-guest/images/hero/tanah-2.jpg') }}"
                                        class="d-block w-100" alt="Pengukuran" style="height: 400px; object-fit: cover;">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/assets-guest/images/hero/tanah-3.jpg') }}"
                                        class="d-block w-100" alt="Kantor" style="height: 400px; object-fit: cover;">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2: ABOUT US (ESTETIK & COMPACT) --}}
    <style>
        /* --- CSS About "All-in-One" --- */
        .section-about-comprehensive {
            padding: 100px 0;
            background-color: #fff;
            position: relative;
            overflow: hidden;
        }

        /* 1. Gambar Kiri (Tetap Estetik) */
        .about-img-wrapper {
            position: relative;
            max-width: 400px;
            margin: 0 auto;
        }

        .about-img-main {
            width: 100%;
            border-radius: 30px;
            position: relative;
            z-index: 2;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            border: 5px solid #fff;
        }

        .about-deco-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 20px;
            left: 20px;
            background-color: #fff0f3;
            border-radius: 30px;
            z-index: 1;
        }

        .floating-stat {
            position: absolute;
            bottom: 30px;
            left: -20px;
            background: #fff;
            padding: 10px 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            z-index: 3;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #ff6b81;
        }

        /* 2. Teks Kanan (Visi Misi Style) */
        .about-label {
            background: #ffe3e8;
            color: #ff6b81;
            font-weight: 700;
            font-size: 12px;
            padding: 5px 15px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .about-title {
            font-size: 36px;
            font-weight: 800;
            color: #333;
            margin: 15px 0;
            line-height: 1.2;
        }

        /* Kotak Visi Misi */
        .vm-box {
            background: #fff;
            border: 1px solid #f0f0f0;
            padding: 20px;
            border-radius: 20px;
            margin-top: 20px;
            transition: 0.3s;
        }

        .vm-box:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-color: #ff6b81;
            transform: translateY(-5px);
        }

        .vm-icon {
            width: 40px;
            height: 40px;
            background: #fff0f3;
            color: #ff6b81;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .vm-title {
            font-weight: 700;
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        .vm-desc {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
            margin: 0;
        }

        /* 3. Bar Statistik (Tengah) */
        .stats-bar {
            background: linear-gradient(135deg, #ff6b81 0%, #ff8796 100%);
            border-radius: 20px;
            padding: 30px;
            margin: 50px 0;
            color: #fff;
            box-shadow: 0 15px 40px rgba(255, 107, 129, 0.2);
        }

        .stat-item {
            text-align: center;
            border-right: 1px solid rgba(255, 255, 255, 0.3);
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 0;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 500;
        }

        /* 4. Alur Mini (Bawah) */
        .flow-mini-title {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
        }

        .flow-item {
            text-align: center;
            position: relative;
        }

        .flow-circle {
            width: 60px;
            height: 60px;
            background: #fff;
            border: 2px solid #fff0f3;
            color: #ff6b81;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 24px;
            transition: 0.3s;
        }

        .flow-item:hover .flow-circle {
            background: #ff6b81;
            color: #fff;
            box-shadow: 0 10px 20px rgba(255, 107, 129, 0.2);
        }

        .flow-text {
            font-size: 14px;
            font-weight: 700;
            color: #444;
        }

        @media (max-width: 768px) {
            .stat-item {
                border-right: none;
                margin-bottom: 20px;
            }

            .about-img-wrapper {
                margin-bottom: 40px;
            }
        }
    </style>

    <section id="about" class="section-about-comprehensive">
        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-5 mb-4 mb-lg-0 wow fadeInLeft">
                    <div class="about-img-wrapper">
                        <div class="about-deco-bg"></div>
                        <img src="{{ asset('assets/assets-guest/images/hero/tanahAbout.jpg') }}" alt="Tentang Web"
                            class="about-img-main">

                        <div class="floating-stat">
                            <i class="lni lni-protection text-danger" style="font-size: 24px;"></i>
                            <div>
                                <h6 style="font-size: 14px; font-weight: 700; margin:0;">Data Valid</h6>
                                <small style="font-size: 11px; color: #777;">Terverifikasi Desa</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 wow fadeInRight">
                    <div class="ps-lg-4">
                        <span class="about-label">Profil Website</span>
                        <h2 class="about-title">Sistem Informasi <br>Pertanahan Desa Digital</h2>
                        <p class="text-muted" style="line-height: 1.7;">
                            Platform digital yang dirancang khusus untuk memodernisasi administrasi pertanahan di tingkat
                            desa. Kami mengubah arsip konvensional menjadi data digital yang aman dan mudah diakses.
                        </p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="vm-box">
                                    <div class="vm-icon"><i class="lni lni-target"></i></div>
                                    <h5 class="vm-title">Visi Kami</h5>
                                    <p class="vm-desc">Mewujudkan tata kelola pertanahan desa yang transparan, akuntabel,
                                        dan bebas sengketa.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="vm-box">
                                    <div class="vm-icon"><i class="lni lni-rocket"></i></div>
                                    <h5 class="vm-title">Misi Utama</h5>
                                    <p class="vm-desc">Mempermudah akses informasi kepemilikan tanah dan mempercepat
                                        pelayanan publik.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stats-bar wow fadeInUp" data-wow-delay=".3s">
                <div class="row">
                    <div class="col-md-4 stat-item">
                        <h3 class="stat-number">100%</h3>
                        <div class="stat-label">Digitalisasi Data</div>
                    </div>
                    <div class="col-md-4 stat-item">
                        <h3 class="stat-number">24/7</h3>
                        <div class="stat-label">Akses Layanan</div>
                    </div>
                    <div class="col-md-4 stat-item">
                        <h3 class="stat-number">Aman</h3>
                        <div class="stat-label">Enkripsi Database</div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center wow fadeInUp" data-wow-delay=".5s">
                <div class="col-12">
                    <h5 class="flow-mini-title">Bagaimana Sistem Bekerja?</h5>
                </div>

                <div class="col-6 col-md-3 mb-4">
                    <div class="flow-item">
                        <div class="flow-circle"><i class="lni lni-files"></i></div>
                        <div class="flow-text">1. Input Data</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="flow-item">
                        <div class="flow-circle"><i class="lni lni-laptop-phone"></i></div>
                        <div class="flow-text">2. Verifikasi</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="flow-item">
                        <div class="flow-circle"><i class="lni lni-map"></i></div>
                        <div class="flow-text">3. Pemetaan</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="flow-item">
                        <div class="flow-circle"><i class="lni lni-certificate"></i></div>
                        <div class="flow-text">4. Publikasi</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- SECTION 3: LAYANAN --}}
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

                {{-- LAYANAN 1: Layanan User --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('user.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".2s">
                            <div class="icon-box"><i class="lni lni-user"></i></div>
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

                {{-- LAYANAN 2: Layanan Warga --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('warga.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".4s">
                            <div class="icon-box icon-blue"><i class="lni lni-home"></i></div>
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

                {{-- LAYANAN 3: Jenis Penggunaan --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('jenispenggunaan.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".6s">
                            <div class="icon-box icon-green"><i class="lni lni-layers"></i></div>
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

                {{-- LAYANAN 4: Dokumen Persil --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('dokumen_persil.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".8s">
                            <div class="icon-box icon-green"><i class="lni lni-files"></i></div>
                            <h4 class="title">Dokumen Persil</h4>
                            <p>Manajemen dan akses dokumen kepemilikan persil tanah secara digital.</p>
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Arsip dokumen fisik & digital</li>
                                <li><i class="lni lni-checkmark-circle"></i> Verifikasi keabsahan dokumen</li>
                                <li><i class="lni lni-checkmark-circle"></i> Riwayat dokumen</li>
                            </ul>
                        </div>
                    </a>
                </div>

                {{-- LAYANAN 5: Layanan Persil --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('persil.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".2s">
                            <div class="icon-box" style="background-color: #f5eef8; color: #9b59b6;"><i
                                    class="lni lni-map"></i></div>
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

                {{-- **TAMBAHAN BARU 1: Sengketa Persil** --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('sengketa_persil.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".4s">
                            <div class="icon-box" style="background-color: #fff0f0; color: #e74c3c;"><i
                                    class="lni lni-warning"></i></div>
                            <h4 class="title">Sengketa Persil</h4>
                            <p>Pencatatan dan pengelolaan riwayat sengketa atau konflik pertanahan.</p>
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Pencatatan kasus konflik</li>
                                <li><i class="lni lni-checkmark-circle"></i> Verifikasi pihak terkait</li>
                                <li><i class="lni lni-checkmark-circle"></i> Status penyelesaian sengketa</li>
                            </ul>
                        </div>
                    </a>
                </div>

                {{-- **TAMBAHAN BARU 2: Peta Persil** --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('peta_persil.index') }}" class="text-decoration-none text-dark">
                        <div class="single-card wow fadeInUp" data-wow-delay=".6s">
                            <div class="icon-box icon-blue"><i class="lni lni-map-marker"></i></div>
                            <h4 class="title">Peta Persil</h4>
                            <p>Akses visualisasi spasial batas-batas persil dalam bentuk peta interaktif.</p>
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Peta interaktif GIS/WebGIS</li>
                                <li><i class="lni lni-checkmark-circle"></i> Overlay data penggunaan</li>
                                <li><i class="lni lni-checkmark-circle"></i> Pengukuran koordinat</li>
                            </ul>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 4: KONTAK OFFICE --}}
    <section id="kontak" class="section-white">
        <div class="container">
            <div class="section-title text-center">
                <h6 class="wow zoomIn" data-wow-delay=".2s">Hubungi Kami</h6>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Kantor Pertanahan Desa</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="contact-box text-center wow fadeInUp" data-wow-delay=".6s">
                        <p class="mb-4 text-muted">Untuk informasi lebih lanjut mengenai pengurusan tanah atau layanan
                            desa, silakan hubungi kami.</p>
                        <div class="row mt-5">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <i class="lni lni-map-marker" style="font-size: 30px; color: #ff6b81;"></i>
                                <h5 class="mt-3" style="font-size: 16px;">Lokasi</h5>
                                <p class="small text-muted">Jl. Raya Desa No. 45<br>Kecamatan Harapan</p>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <i class="lni lni-phone" style="font-size: 30px; color: #3498db;"></i>
                                <h5 class="mt-3" style="font-size: 16px;">Telepon</h5>
                                <p class="small text-muted">+62 812 3456 7890<br>Senin - Jumat (08:00 - 15:00)</p>
                            </div>
                            <div class="col-md-4">
                                <i class="lni lni-envelope" style="font-size: 30px; color: #2ecc71;"></i>
                                <h5 class="mt-3" style="font-size: 16px;">Email</h5>
                                <p class="small text-muted">pertanahan@binadesa.go.id</p>
                            </div>
                        </div>
                        <div class="mt-5">
                            <a href="mailto:pertanahan@binadesa.go.id" class="btn btn-primary"
                                style="background-color: #ff6b81; border: none; padding: 12px 40px; border-radius: 30px; font-weight: 700;">Kirim
                                Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 5: IDENTITAS PENGEMBANG --}}
    <section id="developer" class="section-gray">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h6 class="wow zoomIn" data-wow-delay=".2s">Profile Developer</h6>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Tentang Pengembang</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="card dev-card-hover shadow-lg border-0 rounded-4 overflow-hidden wow fadeInUp"
                        data-wow-delay=".6s">
                        <div class="row g-0">
                            <div class="col-md-5 position-relative" style="min-height: 400px;">
                                <img src="{{ asset('assets/assets-guest/images/hero/fotouci.jpg') }}"
                                    alt="Foto Pengembang" class="img-fluid w-100 h-100"
                                    style="object-fit: cover; object-position: top center;">
                            </div>
                            <div class="col-md-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-start">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 26px;">Suci Ramadani
                                            </h3>
                                            <p class="text-primary fw-bold mb-0" style="font-size: 15px;">Mahasiswa Sistem
                                                Informasi</p>
                                            <p class="text-primary fw-bold mb-0" style="font-size: 15px;">Generasi 24</p>
                                        </div>
                                        <span class="badge rounded-pill"
                                            style="background-color: rgba(255, 107, 129, 0.1); color: #ff6b81; font-weight: 700; padding: 8px 15px; border: 1px solid #ff6b81; font-size: 12px;">NIM:
                                            2457301137</span>
                                    </div>
                                    <p class="text-muted small mb-4" style="font-weight: 600;">Fakultas Teknik, Politeknik
                                        Caltex Riau.</p>
                                    <div class="p-3 rounded-3 mb-4"
                                        style="background-color: #fff0f3; border-left: 5px solid #ff6b81;">
                                        <i class="lni lni-quotation text-muted mb-2 d-block" style="font-size: 18px;"></i>
                                        <p class="fst-italic text-dark mb-0 small"
                                            style="line-height: 1.6; font-weight: 500;">
                                            "Teknologi bukan sekadar kode dan algoritma, melainkan jembatan untuk
                                            menciptakan solusi nyata bagi masyarakat. Teruslah berkarya dan memberi dampak."
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <span class="text-muted small me-2" style="font-weight: 600;">Connect:</span>
                                        <a href="https://linkedin.com/in/suci-ramadani-422b87386" target="_blank"
                                            class="text-decoration-none">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                                style="width: 40px; height: 40px; background: #f0f2f5;"><i
                                                    class="lni lni-linkedin-original"
                                                    style="font-size: 20px; color: #0077b5;"></i></div>
                                        </a>
                                        <a href="https://github.com/suci2sib" target="_blank"
                                            class="text-decoration-none">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                                style="width: 40px; height: 40px; background: #f0f2f5;"><i
                                                    class="lni lni-github-original"
                                                    style="font-size: 20px; color: #333;"></i></div>
                                        </a>
                                        <a href="https://instagram.com/sucyy_rhmdni" target="_blank"
                                            class="text-decoration-none">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                                style="width: 40px; height: 40px; background: #f0f2f5;"><i
                                                    class="lni lni-instagram-original"
                                                    style="font-size: 20px; color: #E1306C;"></i></div>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="https://wa.me/628123456789" class="btn btn-primary shadow-sm"
                                            style="background-color: #ff6b81; border: none; padding: 10px 30px; border-radius: 50px; font-weight: 700; letter-spacing: 0.5px;">
                                            <i class="lni lni-whatsapp me-2"></i> Hubungi Saya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- WA FLOATING BUTTON --}}
    <a href="https://wa.me/6281234567890" target="_blank" class="whatsapp-float">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WA" class="whatsapp-icon"
            style="width: 28px;">
    </a>
@endsection
