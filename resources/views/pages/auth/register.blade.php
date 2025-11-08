<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Pertanahan Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        /* Kiri */
        .login-left {
            flex: 1;
            background: linear-gradient(rgba(255, 99, 164, 0.4), rgba(255, 99, 164, 0.3));
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .login-left-content {
            position: relative;
            z-index: 3;
            text-align: center;
            width: 100%;
        }

        .login-left h1 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .login-left p {
            font-size: 16px;
            opacity: 0.95;
            margin-bottom: 30px;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.4);
            font-weight: 500;
        }

        /* Kanan */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            padding: 40px;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        .login-box h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .login-box p {
            font-size: 14px;
            color: #555;
            margin-bottom: 25px;
        }

        .login-box a {
            color: #6C63FF;
            text-decoration: none;
            font-weight: 500;
        }

        .login-box a:hover {
            text-decoration: underline;
        }

        .form-group {
            margin-top: 20px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-group input:focus {
            border-color: #6C63FF;
            background: white;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
            outline: none;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #6C63FF, #574bff);
            border: none;
            padding: 12px;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(108, 99, 255, 0.3);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #574bff, #4a3dff);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 99, 255, 0.4);
        }

        .social-login {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e0e0e0;
        }

        .social-login span {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .social-login a {
            display: inline-block;
            margin: 0 8px;
            transition: transform 0.2s ease;
        }

        .social-login img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: all 0.3s ease;
            border: 2px solid #e0e0e0;
        }

        .social-login img:hover {
            transform: scale(1.1);
            border-color: #6C63FF;
        }

        @media(max-width: 900px) {
            body {
                flex-direction: column;
            }

            .login-left {
                height: 300px;
                text-align: center;
                padding: 30px 20px;
            }

            .login-left h1 {
                font-size: 26px;
            }

            .login-left p {
                font-size: 14px;
            }
        }

        /* Fitur tambahan */
        .features {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 30px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 15px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature i {
            font-size: 16px;
        }

        .terms {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            font-size: 13px;
            color: #555;
        }

        .terms input {
            margin: 0;
        }

        .terms label {
            margin: 0;
            font-size: 13px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="login-left" id="loginLeft">
        <div class="login-left-content">
            <h1>BUAT AKUN BARU</h1>
            <p>Bergabung dengan Sistem Pertanahan Desa dan mulai kelola data Anda sekarang</p>
            
            <div class="features">
                <div class="feature">
                    <i class="bi bi-shield-check"></i>
                    <span>Keamanan Data Terjamin</span>
                </div>
                <div class="feature">
                    <i class="bi bi-lightning"></i>
                    <span>Proses Cepat & Mudah</span>
                </div>
                <div class="feature">
                    <i class="bi bi-headset"></i>
                    <span>Dukungan 24/7</span>
                </div>
            </div>
        </div>
    </div>

    <div class="login-right">
        <div class="login-box">
            <h2>Register</h2>
            <p>Sudah punya akun? <a href="{{ route('auth.index') }}">Login sekarang</a></p>

            {{-- Notifikasi Error --}}
            @if ($errors->any())
                <div style="background:#ffe2e2; border:1px solid #ffb3b3; color:#b30000; padding:12px; border-radius:8px; margin-top:15px; font-size:14px;">
                    <strong>⚠️ Perhatian!</strong>
                    <ul style="margin: 8px 0 0 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Buat password yang kuat" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password Anda" required>
                </div>

                <div class="terms">
                    <input type="checkbox" id="agree" name="agree" required>
                    <label for="agree">Saya menyetujui syarat & ketentuan</label>
                </div>

                <button type="submit" name="register" class="btn-login">
                    <i class="bi bi-person-plus"></i> Daftar Sekarang
                </button>

                <div class="social-login">
                    <span>Atau daftar dengan</span>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"></a>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter"></a>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="Google"></a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script untuk load gambar dengan multiple path attempts
        document.addEventListener('DOMContentLoaded', function() {
            const loginLeft = document.getElementById('loginLeft');
            const imagePaths = [
                'assets/assets-guest/images/tanah.jpg',
                '/assets/assets-guest/images/tanah.jpg',
                '../assets/assets-guest/images/tanah.jpg',
                './assets/assets-guest/images/tanah.jpg',
                'images/tanah.jpg',
                '/images/tanah.jpg'
            ];

            function tryLoadImage(pathIndex) {
                if (pathIndex >= imagePaths.length) {
                    console.log('Semua path gambar gagal, menggunakan gradient background');
                    return;
                }

                const img = new Image();
                const path = imagePaths[pathIndex];
                
                img.onload = function() {
                    console.log('Gambar berhasil dimuat dari:', path);
                    loginLeft.style.background = `linear-gradient(rgba(255, 99, 164, 0.4), rgba(255, 99, 164, 0.3)), url('${path}')`;
                    loginLeft.style.backgroundSize = 'cover';
                    loginLeft.style.backgroundPosition = 'center';
                };

                img.onerror = function() {
                    console.log('Gagal memuat gambar dari:', path);
                    tryLoadImage(pathIndex + 1);
                };

                img.src = path;
            }

            // Mulai mencoba dari path pertama
            tryLoadImage(0);
        });
    </script>
</body>

</html>