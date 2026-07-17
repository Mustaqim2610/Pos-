<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>POS System - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            font-family:'Poppins',sans-serif;
        }

        body{

            min-height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

            background:#f5f7fb;

        }

        .login-card{

            width:420px;

            background:#ffffff;

            border:none;

            border-radius:24px;

            padding:45px;

            box-shadow:
            0 10px 40px rgba(0,0,0,.08);

        }

        .logo{

            width:80px;

            height:80px;

            margin:auto;

            border-radius:20px;

            background:#2563eb;

            display:flex;

            justify-content:center;

            align-items:center;

            color:white;

            font-size:34px;

            margin-bottom:20px;

        }

        h2{

            font-size:28px;

            font-weight:700;

            color:#1f2937;

        }

        p{

            color:#6b7280;

            font-size:14px;

        }

        .form-control{

            height:55px;

            border-radius:15px;

            border:1px solid #e5e7eb;

            background:#f9fafb;

            font-size:15px;

        }

        .form-control:focus{

            background:white;

            border-color:#2563eb;

            box-shadow:0 0 0 .15rem rgba(37,99,235,.15);

        }

        .btn-login{

            height:55px;

            border-radius:15px;

            background:#2563eb;

            border:none;

            font-weight:600;

            transition:.3s;

        }

        .btn-login:hover{

            background:#1d4ed8;

            transform:translateY(-2px);

        }

        .copyright{

            margin-top:25px;

            text-align:center;

            color:#9ca3af;

            font-size:13px;

        }

    </style>

</head>

<body>

<div class="login-card">

    <div class="logo">

        🏪

    </div>

    <h2 class="text-center">

        POS SYSTEM

    </h2>

    <p class="text-center mb-4">

        Silakan masuk untuk melanjutkan

    </p>

    @if ($errors->any())

        <div class="alert alert-danger rounded-4">

            {{ $errors->first() }}

        </div>

    @endif

    <form method="POST" action="{{ route('login.process') }}">

        @csrf

        <div class="mb-3">

            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Email"
                value="{{ old('email') }}"
                required>

        </div>

        <div class="mb-4">

            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Password"
                required>

        </div>

        <button type="submit" class="btn btn-primary btn-login w-100">

            Login

        </button>

    </form>

    <div class="copyright">

        © {{ date('Y') }} POS System

    </div>

</div>

</body>

</html>