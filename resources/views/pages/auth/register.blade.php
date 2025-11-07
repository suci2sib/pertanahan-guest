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
            background: #ff63e5;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
        }

        .login-left h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
        }

        .login-left p {
            font-size: 15px;
            opacity: 0.9;
            text-align: center;
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
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .login-box p {
            font-size: 14px;
            color: #555;
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

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            background-color: #6C63FF;
            border: none;
            padding: 10px;
            color: white;
            border-radius: 6px;
            font-size: 15px;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background-color: #574bff;
        }

        @media(max-width: 900px) {
            body {
                flex-direction: column;
            }

            .login-left {
                height: 250px;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="login-left">
        <h1>BUAT AKUN BARU</h1>
        <p>Bergabung dengan Sistem Pertanahan Desa<br>dan mulai kelola data Anda sekarang.</p>
    </div>

    <div class="login-right">
        <div class="login-box">
            <h2>Register</h2>
            <p>Sudah punya akun? <a href="{{ route('auth.index') }}">Login sekarang</a></p>

            {{-- Notifikasi Error --}}
            @if ($errors->any())
                <div style="background:#ffe2e2; border:1px solid #ffb3b3; color:#b30000; padding:10px; border-radius:6px; margin-top:15px;">
                    <strong>Perhatian!</strong>
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
                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit" name="register" class="btn-login">Daftar Sekarang</button>
            </form>
        </div>
    </div>
</body>

</html>
