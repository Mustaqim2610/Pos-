<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS System – Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }

        body {
            min-height: 100vh;
            display: flex;
            background: #0f172a;
            margin: 0;
        }

        /* ── Left Panel ── */
        .left-panel {
            width: 420px;
            background: linear-gradient(160deg, #1e3a8a 0%, #1e293b 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            color: #fff;
            flex-shrink: 0;
        }
        .left-panel .brand-icon {
            width: 80px; height: 80px;
            background: rgba(255,255,255,.15);
            border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            font-size: 36px;
            margin-bottom: 20px;
        }
        .left-panel h1 { font-size: 26px; font-weight: 700; margin-bottom: 4px; }
        .left-panel .tagline { font-size: 12px; opacity: .7; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 36px; }
        .left-panel p { font-size: 14px; line-height: 1.8; opacity: .75; text-align: center; }
        .left-panel .copyright { margin-top: auto; font-size: 12px; opacity: .45; }

        /* ── Right Panel ── */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #f0f4f8;
        }

        .login-card {
            background: #fff;
            border-radius: 24px;
            padding: 44px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 40px rgba(0,0,0,.08);
        }

        .login-card h2 { font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
        .login-card .subtitle { font-size: 13.5px; color: #64748b; margin-bottom: 28px; }

        .form-label { font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }

        .input-group-text {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-right: none;
            color: #94a3b8;
        }
        .form-control {
            height: 48px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            font-size: 14px;
            border-left: none;
        }
        .form-control:focus {
            background: #fff;
            border-color: #2563eb;
            box-shadow: none;
        }
        .input-group:focus-within .input-group-text {
            border-color: #2563eb;
            background: #fff;
        }

        .form-check-label { font-size: 13px; color: #64748b; }

        .btn-login {
            height: 50px;
            border-radius: 12px;
            background: #2563eb;
            border: none;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .3px;
            transition: all .2s;
        }
        .btn-login:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(37,99,235,.3); }

        .divider { position: relative; text-align: center; margin: 20px 0; }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%; left: 0; right: 0;
            height: 1px;
            background: #e2e8f0;
        }
        .divider span {
            position: relative;
            background: #fff;
            padding: 0 12px;
            font-size: 12px;
            color: #94a3b8;
        }

        .register-link { font-size: 13.5px; text-align: center; color: #64748b; }
        .register-link a { color: #2563eb; font-weight: 600; text-decoration: none; }
        .register-link a:hover { text-decoration: underline; }

        .alert { border-radius: 12px; font-size: 13px; }

        /* toggle password */
        .toggle-pw {
            border: 1px solid #e2e8f0;
            border-left: none;
            background: #f8fafc;
            color: #94a3b8;
            cursor: pointer;
        }
        .toggle-pw:hover { color: #2563eb; }
    </style>
</head>
<body>

<!-- Left decorative panel -->
<div class="left-panel">
    <div class="brand-icon"><i class="fas fa-cart-shopping"></i></div>
    <h1>POS SYSTEM</h1>
    <p class="tagline">Point Of Sale Application</p>
    <p>Sistem penjualan yang<br>memudahkan transaksi,<br>manajemen produk, dan<br>laporan penjualan.</p>
    <p class="copyright">© {{ date('Y') }} POS System. All rights reserved.</p>
</div>

<!-- Right login panel -->
<div class="right-panel">
    <div class="login-card">
        <h2>Login</h2>
        <p class="subtitle">Silakan masuk ke akun Anda</p>

        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                <i class="fas fa-circle-exclamation"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control"
                           placeholder="admin@example.com"
                           value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label class="form-label">Password</label>
                    <a href="#" style="font-size:12px; color:#2563eb; text-decoration:none;">Lupa password?</a>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password"
                           class="form-control" placeholder="••••••••" required>
                    <button type="button" class="btn toggle-pw" onclick="togglePw()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4 d-flex align-items-center gap-2">
                <input class="form-check-input m-0" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary btn-login w-100">
                <i class="fas fa-right-to-bracket me-2"></i>Login
            </button>

            <div class="divider mt-4"><span>atau</span></div>

            <p class="register-link">Belum punya akun? <a href="#">Register</a></p>
        </form>
    </div>
</div>

<script>
function togglePw() {
    const pw = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        pw.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
</body>
</html>
