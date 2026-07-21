@extends('layouts.app')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@push('styles')
<style>
    .profile-avatar-wrap {
        position: relative;
        width: 110px;
        height: 110px;
        margin: 0 auto;
    }
    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,.12);
    }
    .avatar-initials {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: 700;
        color: #fff;
        border: 4px solid #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,.12);
    }
    .avatar-edit-btn {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 30px;
        height: 30px;
        background: #2563eb;
        border: 2px solid #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #fff;
        font-size: 12px;
        transition: background .2s;
    }
    .avatar-edit-btn:hover { background: #1d4ed8; }

    .profile-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        border-radius: 20px;
        padding: 36px 28px 28px;
        color: #fff;
        text-align: center;
        margin-bottom: 0;
        position: relative;
        overflow: hidden;
    }
    .profile-header::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        background: rgba(255,255,255,.06);
        border-radius: 50%;
    }
    .profile-header::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -30px;
        width: 200px; height: 200px;
        background: rgba(255,255,255,.04);
        border-radius: 50%;
    }
    .profile-header h5 {
        font-size: 20px;
        font-weight: 700;
        margin: 14px 0 4px;
    }
    .profile-header .role-badge {
        display: inline-block;
        background: rgba(255,255,255,.2);
        padding: 3px 14px;
        border-radius: 99px;
        font-size: 12px;
        font-weight: 500;
    }
    .profile-header .email-text {
        font-size: 13px;
        opacity: .75;
        margin-top: 4px;
    }
    .profile-stat {
        background: rgba(255,255,255,.15);
        border-radius: 12px;
        padding: 12px 16px;
        text-align: center;
        flex: 1;
    }
    .profile-stat .stat-num {
        font-size: 20px;
        font-weight: 700;
    }
    .profile-stat .stat-lbl {
        font-size: 11px;
        opacity: .75;
        margin-top: 2px;
    }

    /* Tabs */
    .profile-tabs {
        display: flex;
        gap: 4px;
        background: #f1f5f9;
        padding: 4px;
        border-radius: 12px;
        margin-bottom: 24px;
    }
    .profile-tab {
        flex: 1;
        text-align: center;
        padding: 9px 12px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 500;
        color: #64748b;
        cursor: pointer;
        transition: all .2s;
        border: none;
        background: transparent;
    }
    .profile-tab.active {
        background: #fff;
        color: #2563eb;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
    }
    .profile-tab:hover:not(.active) { color: #1e293b; }

    /* Form styling */
    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }
    .input-group-text {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-right: none;
        color: #94a3b8;
    }
    .form-control {
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        font-size: 14px;
        border-left: none;
        height: 46px;
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
    .btn-save {
        height: 46px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        padding: 0 28px;
    }

    .tab-panel { display: none; }
    .tab-panel.active { display: block; }

    .toggle-pw {
        border: 1.5px solid #e2e8f0;
        border-left: none;
        background: #f8fafc;
        color: #94a3b8;
        cursor: pointer;
        height: 46px;
    }
    .toggle-pw:hover { color: #2563eb; }
</style>
@endpush

@section('content')

<div class="row g-4 justify-content-center">

    {{-- ── Left: Profile Card ── --}}
    <div class="col-xl-4 col-lg-5">

        {{-- Header / Avatar --}}
        <div class="profile-header">
            <div class="profile-avatar-wrap mx-auto">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                         class="profile-avatar" alt="Avatar">
                @else
                    <div class="avatar-initials">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif

                {{-- Upload avatar trigger --}}
                <label for="avatarInput" class="avatar-edit-btn" title="Ubah foto">
                    <i class="fas fa-camera"></i>
                </label>
            </div>

            <h5>{{ auth()->user()->name }}</h5>
            <div class="role-badge">
                <i class="fas fa-{{ auth()->user()->role->value === 'admin' ? 'shield-halved' : 'user' }} me-1"></i>
                {{ ucfirst(auth()->user()->role->value) }}
            </div>
            <div class="email-text">{{ auth()->user()->email }}</div>

            {{-- Stats --}}
            <div class="d-flex gap-2 mt-4">
                <div class="profile-stat">
                    <div class="stat-num">{{ auth()->user()->transactions()->count() }}</div>
                    <div class="stat-lbl">Transaksi</div>
                </div>
                <div class="profile-stat">
                    <div class="stat-num">{{ auth()->user()->created_at->diffInDays(now()) }}</div>
                    <div class="stat-lbl">Hari Bergabung</div>
                </div>
                <div class="profile-stat">
                    <div class="stat-num">Rp {{ number_format(auth()->user()->transactions()->sum('total') / 1000, 0) }}K</div>
                    <div class="stat-lbl">Total Omset</div>
                </div>
            </div>
        </div>

        {{-- Avatar upload (hidden) --}}
        <form method="POST" action="{{ route('profile.avatar') }}"
              enctype="multipart/form-data" id="avatarForm">
            @csrf
            <input type="file" id="avatarInput" name="avatar"
                   accept="image/*" style="display:none;"
                   onchange="document.getElementById('avatarForm').submit()">
        </form>

        {{-- Info card --}}
        <div class="card card-pos mt-3">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="fas fa-info-circle text-primary"></i>
                    <span style="font-size:13px; font-weight:600; color:#1e293b;">Informasi Akun</span>
                </div>
                <div style="font-size:13px; color:#64748b; line-height:2;">
                    <div><i class="fas fa-calendar me-2 text-muted"></i>
                        Bergabung: <strong>{{ auth()->user()->created_at->format('d M Y') }}</strong>
                    </div>
                    <div><i class="fas fa-clock me-2 text-muted"></i>
                        Terakhir login: <strong>{{ now()->format('d M Y, H:i') }}</strong>
                    </div>
                    <div><i class="fas fa-shield-check me-2 text-muted"></i>
                        Status: <span class="badge bg-success-subtle text-success rounded-3">Aktif</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Right: Edit Form ── --}}
    <div class="col-xl-8 col-lg-7">
        <div class="card card-pos">
            <div class="card-body p-4">

                {{-- Tabs --}}
                <div class="profile-tabs">
                    <button class="profile-tab {{ session('tab') === 'password' ? '' : 'active' }}"
                            onclick="switchTab('info', this)">
                        <i class="fas fa-user me-2"></i>Informasi Pribadi
                    </button>
                    <button class="profile-tab {{ session('tab') === 'password' ? 'active' : '' }}"
                            onclick="switchTab('password', this)">
                        <i class="fas fa-lock me-2"></i>Ubah Password
                    </button>
                </div>

                {{-- Tab: Informasi Pribadi --}}
                <div class="tab-panel {{ session('tab') === 'password' ? '' : 'active' }}" id="tab-info">

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', auth()->user()->name) }}" required>
                                </div>
                                @error('name')
                                    <div class="text-danger" style="font-size:12px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', auth()->user()->email) }}" required>
                                </div>
                                @error('email')
                                    <div class="text-danger" style="font-size:12px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nomor Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="phone"
                                           class="form-control"
                                           value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                           placeholder="08xx-xxxx-xxxx">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-shield-halved"></i></span>
                                    <input type="text" class="form-control"
                                           value="{{ ucfirst(auth()->user()->role->value) }}"
                                           disabled style="background:#f1f5f9; color:#64748b;">
                                </div>
                                <div style="font-size:11px; color:#94a3b8; margin-top:4px;">
                                    Role tidak dapat diubah sendiri
                                </div>
                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="d-flex align-items-center justify-content-between">
                            <div style="font-size:12px; color:#94a3b8;">
                                <i class="fas fa-circle-info me-1"></i>
                                Perubahan langsung aktif setelah disimpan
                            </div>
                            <button type="submit" class="btn btn-primary btn-save">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>

                {{-- Tab: Ubah Password --}}
                <div class="tab-panel {{ session('tab') === 'password' ? 'active' : '' }}" id="tab-password">

                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label">Password Lama <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="current_password" id="pw_old"
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           placeholder="Masukkan password lama" required>
                                    <button type="button" class="btn toggle-pw"
                                            onclick="togglePw('pw_old','eye_old')">
                                        <i class="fas fa-eye" id="eye_old"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="text-danger" style="font-size:12px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock-open"></i></span>
                                    <input type="password" name="password" id="pw_new"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Min. 6 karakter" required>
                                    <button type="button" class="btn toggle-pw"
                                            onclick="togglePw('pw_new','eye_new')">
                                        <i class="fas fa-eye" id="eye_new"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger" style="font-size:12px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-shield-check"></i></span>
                                    <input type="password" name="password_confirmation" id="pw_confirm"
                                           class="form-control"
                                           placeholder="Ulangi password baru" required>
                                    <button type="button" class="btn toggle-pw"
                                            onclick="togglePw('pw_confirm','eye_confirm')">
                                        <i class="fas fa-eye" id="eye_confirm"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="alert alert-warning d-flex gap-2 mt-3 mb-0" style="font-size:13px; border-radius:12px;">
                            <i class="fas fa-triangle-exclamation mt-1 flex-shrink-0"></i>
                            <span>Setelah mengubah password, Anda akan tetap login. Gunakan password baru untuk login berikutnya.</span>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning btn-save text-white">
                                <i class="fas fa-key me-2"></i>Ubah Password
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
function switchTab(tabName, btn) {
    // Hide all panels
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.profile-tab').forEach(b => b.classList.remove('active'));
    // Show selected
    document.getElementById('tab-' + tabName).classList.add('active');
    btn.classList.add('active');
}

function togglePw(inputId, iconId) {
    const pw   = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        pw.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
@endpush
