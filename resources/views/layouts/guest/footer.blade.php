<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Terapkan Font Quicksand ke seluruh footer */
    .footer-area {
        position: relative;
        background: linear-gradient(135deg, #ff6b81 0%, #ff8796 100%);
        color: #ffffff;
        padding-top: 50px;
        padding-bottom: 15px;
        /* FONT BARU DISINI */
        font-family: 'Quicksand', sans-serif; 
        font-weight: 500; /* Agak tebal dikit biar kebaca */
        font-size: 14px;
        margin-top: 60px;
    }

    /* Wave Container */
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

    /* Typography Styles */
    .footer-brand {
        font-family: 'Quicksand', sans-serif;
        font-size: 24px; 
        font-weight: 700; /* Bold bulat */
        color: #ffffff;
        text-decoration: none;
        display: block;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }
    
    .footer-widget h6 {
        font-family: 'Quicksand', sans-serif;
        color: #ffffff;
        font-size: 15px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 15px;
        letter-spacing: 1px;
        border-bottom: 2px solid rgba(255,255,255,0.4);
        display: inline-block;
        padding-bottom: 3px;
    }

    .footer-links li {
        margin-bottom: 8px;
        list-style: none;
    }
    .footer-links li a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: 0.3s;
        font-size: 14px;
        font-weight: 500;
    }
    .footer-links li a:hover {
        color: #ffffff;
        padding-left: 5px;
        font-weight: 700;
        text-shadow: 0 0 5px rgba(255,255,255,0.5);
    }

    /* Social Media Mini */
    .social-btn {
        display: inline-flex;
        width: 34px;
        height: 34px;
        background: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 15px;
        margin-right: 8px;
        transition: 0.3s;
    }
    .social-btn:hover {
        background: #fff;
        color: #ff6b81;
        transform: translateY(-3px) rotate(10deg);
    }

    /* Copyright & Developer */
    .copyright-area {
        margin-top: 25px;
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .dev-badge {
        background: #ffffff;
        color: #ff6b81;
        padding: 5px 18px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 700; /* Bold */
        text-decoration: none;
        transition: 0.3s;
        display: inline-block;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        font-family: 'Quicksand', sans-serif;
    }
    .dev-badge:hover {
        background: #ffe3e8;
        transform: scale(1.05);
    }

    /* Jam Operasional */
    .schedule-list li {
        margin-bottom: 8px;
        color: rgba(255, 255, 255, 0.95);
        font-size: 14px;
        font-weight: 500;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px dashed rgba(255,255,255,0.3);
        padding-bottom: 4px;
    }
    .schedule-list li span:last-child {
        font-weight: 700;
        color: #fff;
    }

    /* WA Float */
    .whatsapp-float {
        position: fixed;
        width: 50px;
        height: 50px;
        bottom: 25px;
        right: 25px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    .whatsapp-icon { width: 28px; }
</style>

<a href="https://wa.me/6281234567890" target="_blank" class="whatsapp-float">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WA" class="whatsapp-icon">
</a>

<footer class="footer-area">
    
    <div class="wave-container">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>

    <div class="container">
        <div class="row justify-content-between">
            
            <div class="col-lg-4 mb-3">
                <a href="#" class="footer-brand">Pertanahan Desa.</a>
                <p style="opacity: 0.95; line-height: 1.6; margin-bottom: 15px;">
                    Sistem pertanahan desa digital yang transparan, aman, dan efisien.
                </p>
                <div>
                    <a href="#" class="social-btn"><i class="lni lni-facebook-original"></i></a>
                    <a href="#" class="social-btn"><i class="lni lni-instagram-original"></i></a>
                    <a href="#" class="social-btn"><i class="lni lni-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6 mb-3">
                <div class="footer-widget">
                    <h6>Navigasi</h6>
                    <ul class="footer-links ps-0">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#layanan">Layanan</a></li>
                        <li><a href="#Kontak">Kontak</a></li>
                        <li><a href="#developer">Developer</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-6 mb-3">
                <div class="footer-widget">
                    <h6>Jam Kerja</h6>
                    <ul class="schedule-list ps-0" style="list-style: none;">
                        <li>
                            <span>Senin - Kamis</span>
                            <span>08.00 - 15.00</span>
                        </li>
                        <li>
                            <span>Jumat</span>
                            <span>08.00 - 11.00</span>
                        </li>
                        <li>
                            <span>Sabtu - Minggu</span>
                            <span>Tutup</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="footer-widget">
                    <h6>Hubungi Kami</h6>
                    <ul class="footer-links ps-0">
                        <li><i class="lni lni-map-marker me-2"></i> Kec. Harapan</li>
                        <li><i class="lni lni-whatsapp me-2"></i> 0812-3456-7890</li>
                        <li><i class="lni lni-envelope me-2"></i> admin@desa.go.id</li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="copyright-area">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <span style="opacity: 0.9; font-size: 13px;">© 2025 Pertanahan Desa. All Rights Reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#developer" class="dev-badge">
                        Developed by sucyy ❤️
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>