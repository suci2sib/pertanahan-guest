<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Guest</title>
    <style>
        /* ====== Gaya Umum ====== */
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #f8d7e0, #fbe9d7);
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* ====== Container ====== */
        .container {
            max-width: 400px;
            margin: 100px auto;
            background: #fff;
            padding: 35px 40px;
            border-radius: 20px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            color: #7b3f00;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 14px;
            margin-bottom: 25px;
        }

        /* ====== Form ====== */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #d8c8b0;
            border-radius: 8px;
            background: #fffaf4;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #b67b3f;
            box-shadow: 0 0 5px rgba(182, 123, 63, 0.4);
        }

        button {
            width: 85%;
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 8px;
            background-color: #8b5e3c;
            color: white;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #a97b54;
        }

        /* ====== Pesan ====== */
        .alert {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        /* ====== Responsif ====== */
        @media (max-width: 500px) {
            .container {
                width: 90%;
                margin: 60px auto;
                padding: 25px;
            }
            input, button { width: 90%; }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Login Guest</h2>
        <p>Masukkan nama pengguna dan kata sandi Anda</p>

        @if (session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="/auth/login" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Masukkan Username" value="{{ old('username') }}">
            <input type="password" name="password" placeholder="Masukkan Password">
            <button type="submit">Masuk</button>
        </form>
    </div>

</body>
</html>
