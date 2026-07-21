<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kopi Setara – Register</title>

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
        .left-panel h1  { font-size: 26px; font-weight: 700; margin-bottom: 4px; }
        .left-panel .tagline {
            font-size: 12px; opacity: .7;
            letter-spacing: 1px; text-transform: uppercase;
            margin-bottom: 36px;
        }
        .left-panel p   { font-size: 14px; line-height: 1.8; opacity: .75; text-align: center; }
        .left-panel .copyright { margin-top: auto; font-size: 12px; opacity: .45; }

        /* Feature list */
        .feature-item {
            display: flex; align-items: center; gap: 12px;
            background: rgba(255,255,255,.07);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 10px;
            width: 100%;
            font-size: 13px;
        }
        .feature-item i {
            width: 32px; height: 32px;
            background: rgba(255,255,255,.15);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        /* ── Right Panel ── */
        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #f0f4f8;
        }

        .register-card {
            background: #fff;
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 10px 40px rgba(0,0,0,.08);
        }

        .register-card h2    { font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
        .register-card .subtitle { font-size: 13.5px; color: #64748b; margin-bottom: 24px; }

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
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { font-size: 12px; }

        .btn-register {
            height: 50px;
            border-radius: 12px;
            background: #2563eb;
            border: none;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .3px;
            transition: all .2s;
        }
        .btn-register:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37,99,235,.3);
        }

        .login-link { font-size: 13.5px; text-align: center; color: #64748b; }
        .login-link a { color: #2563eb; font-weight: 600; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }

        .alert { border-radius: 12px; font-size: 13px; }

        .toggle-pw {
            border: 1px solid #e2e8f0;
            border-left: none;
            background: #f8fafc;
            color: #94a3b8;
            cursor: pointer;
            height: 48px;
        }
        .toggle-pw:hover { color: #2563eb; }

        /* password strength */
        .strength-bar {
            height: 4px;
            border-radius: 4px;
            background: #e2e8f0;
            margin-top: 6px;
            overflow: hidden;
        }
        .strength-fill {
            height: 100%;
            border-radius: 4px;
            width: 0;
            transition: width .3s, background .3s;
        }
        .strength-label { font-size: 11px; margin-top: 3px; }
    </style>
</head>
<body>

<!-- ── Left Panel ── -->
<div class="left-panel">
    <div style="width:130px; height:130px; margin:0 auto 16px; border-radius:16px; overflow:hidden;">
        <img src="{{ asset('Kopi setara.png') }}" alt="Logo"
             style="width:100%; height:100%; object-fit:contain; filter:brightness(0) invert(1);">
    </div>
    <h1>KOPI SETARA</h1>
    <p class="tagline">Sistem Informasi Kasir (Point of Sale)</p>

    <div style="width:100%; margin-bottom: 8px;">
        <div class="feature-item">
            <i class="fas fa-chart-pie"></i>
            <span>Dashboard real-time & laporan lengkap</span>
        </div>
        <div class="feature-item">
            <i class="fas fa-cash-register"></i>
            <span>Kasir cepat dengan manajemen stok</span>
        </div>
        <div class="feature-item">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Cetak struk & export laporan</span>
        </div>
    </div>

    <p class="copyright">© {{ date('Y') }} Kopi Setara. All rights reserved.</p>
</div>

<!-- ── Right Panel ── -->
<div class="right-panel">
    <div class="register-card">
        <h2>Daftar Akun</h2>
        <p class="subtitle">Buat akun baru untuk mulai menggunakan POS System</p>

        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-start gap-2 mb-3">
                <i class="fas fa-circle-exclamation mt-1"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Masukkan nama lengkap"
                           value="{{ old('name') }}" required autofocus>
                </div>
                @error('name')
                    <div class="text-danger" style="font-size:12px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="email@example.com"
                           value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="text-danger" style="font-size:12px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label">Password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Min. 6 karakter"
                           oninput="checkStrength(this.value)" required>
                    <button type="button" class="btn toggle-pw" onclick="togglePw('password','eye1')">
                        <i class="fas fa-eye" id="eye1"></i>
                    </button>
                </div>
                {{-- Strength bar --}}
                <div class="strength-bar">
                    <div class="strength-fill" id="strengthFill"></div>
                </div>
                <div class="strength-label text-muted" id="strengthLabel"></div>
                @error('password')
                    <div class="text-danger" style="font-size:12px; margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-4">
                <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock-open"></i></span>
                    <input type="password" name="password_confirmation" id="password2"
                           class="form-control"
                           placeholder="Ulangi password" required>
                    <button type="button" class="btn toggle-pw" onclick="togglePw('password2','eye2')">
                        <i class="fas fa-eye" id="eye2"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-register w-100 mb-3">
                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
            </button>

            <p class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </p>

        </form>
    </div>
</div>

<script>
function togglePw(id, iconId) {
    const pw   = document.getElementById(id);
    const icon = document.getElementById(iconId);
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        pw.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

function checkStrength(val) {
    const fill  = document.getElementById('strengthFill');
    const label = document.getElementById('strengthLabel');
    let score = 0;
    if (val.length >= 6)  score++;
    if (val.length >= 10) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { w: '0%',   color: '#e2e8f0', text: '' },
        { w: '25%',  color: '#ef4444', text: 'Sangat lemah' },
        { w: '50%',  color: '#f59e0b', text: 'Sedang' },
        { w: '75%',  color: '#3b82f6', text: 'Kuat' },
        { w: '90%',  color: '#10b981', text: 'Sangat kuat' },
        { w: '100%', color: '#059669', text: 'Sempurna' },
    ];

    const lvl = val.length === 0 ? 0 : Math.min(score, 5);
    fill.style.width      = levels[lvl].w;
    fill.style.background = levels[lvl].color;
    label.textContent     = levels[lvl].text;
    label.style.color     = levels[lvl].color;
}
</script>
</body>
</html>
