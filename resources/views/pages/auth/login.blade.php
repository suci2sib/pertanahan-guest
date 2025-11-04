<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pertanahan Desa</title>
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
            background: #6C63FF;
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
        }

        .login-left p {
            font-size: 15px;
            opacity: 0.9;
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

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .remember {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 13px;
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

        .social-login {
            text-align: center;
            margin-top: 25px;
        }

        .social-login span {
            display: block;
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
        }

        .social-login a {
            display: inline-block;
            margin: 0 8px;
        }

        .social-login img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            transition: transform 0.2s ease;
        }

        .social-login img:hover {
            transform: scale(1.1);
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
        <h1>LEARN TO CODE<br>WITH US.</h1>
        <p>Learn to code • Gain a new skill • Get a new job</p>
    </div>

    <div class="login-right">
        <div class="login-box">
            <h2>Login</h2>
            <p>Don’t have an account? <a href="#">Create your account</a></p>

            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Username atau Email</label>
                    <input type="text" id="email" name="email" placeholder="Masukkan email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password">
                </div>

                <div class="remember">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                    <a href="#">Lupa password?</a>
                </div>

                <button type="submit" class="btn-login">Login</button>

                <div class="social-login">
                    <span>Or login with</span>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png"
                            alt="Facebook"></a>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png"
                            alt="Twitter"></a>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/281/281764.png"
                            alt="Google"></a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
