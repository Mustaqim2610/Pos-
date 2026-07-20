<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'POS System')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }

        body { background: #f0f4f8; margin: 0; padding: 0; }

        /* ── Sidebar ── */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: #fff;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 24px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            text-align: center;
        }
        .sidebar-logo .logo-icon {
            width: 52px; height: 52px;
            background: #2563eb;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            margin: 0 auto 10px;
        }
        .sidebar-logo h6 {
            font-size: 15px; font-weight: 700;
            margin: 0; letter-spacing: .5px;
        }
        .sidebar-logo small {
            font-size: 11px; color: #94a3b8;
        }

        .sidebar-section {
            padding: 16px 16px 4px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            font-weight: 600;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            margin: 2px 8px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            transition: all .2s;
        }
        .sidebar-link:hover,
        .sidebar-link.active {
            background: #2563eb;
            color: #fff;
        }
        .sidebar-link i { width: 18px; text-align: center; font-size: 14px; }

        .sidebar-footer {
            margin-top: auto;
            padding: 12px 8px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        /* ── Main ── */
        .main-wrapper {
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar ── */
        .topbar {
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .topbar-title { font-size: 17px; font-weight: 700; color: #1e293b; }
        .topbar-right { display: flex; align-items: center; gap: 16px; }

        .btn-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            border: none;
            background: #f1f5f9;
            display: flex; align-items: center; justify-content: center;
            color: #64748b;
            font-size: 15px;
            cursor: pointer;
            transition: background .2s;
        }
        .btn-icon:hover { background: #e2e8f0; }

        .user-chip {
            display: flex; align-items: center; gap: 8px;
            background: #f1f5f9;
            padding: 5px 12px 5px 6px;
            border-radius: 99px;
            cursor: pointer;
        }
        .user-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: #2563eb;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 13px; font-weight: 600;
        }
        .user-chip span { font-size: 13px; font-weight: 500; color: #1e293b; }

        /* ── Page content ── */
        .page-content { padding: 28px; flex: 1; }

        /* ── Cards ── */
        .stat-card {
            border-radius: 16px;
            padding: 22px;
            color: #fff;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,.08);
        }
        .stat-card .label { font-size: 12px; opacity: .85; font-weight: 500; }
        .stat-card .value { font-size: 26px; font-weight: 700; margin: 4px 0 0; }
        .stat-card .sub   { font-size: 11px; opacity: .75; }
        .stat-card .icon-wrap {
            width: 48px; height: 48px;
            background: rgba(255,255,255,.2);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
        }

        .card-pos {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,.06);
        }
        .card-pos .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            border-radius: 16px 16px 0 0 !important;
            padding: 16px 20px;
            font-weight: 600;
            font-size: 14px;
            color: #1e293b;
        }
        .card-pos .card-body { padding: 20px; }

        /* ── Tables ── */
        .table-pos thead th {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #64748b;
            border-bottom: 2px solid #f1f5f9;
            background: #f8fafc;
            padding: 10px 14px;
        }
        .table-pos tbody td {
            font-size: 13.5px;
            vertical-align: middle;
            padding: 10px 14px;
            color: #334155;
        }
        .table-pos tbody tr:hover { background: #f8fafc; }

        /* ── Badge ── */
        .badge-pos {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        /* ── Alert toast ── */
        .alert { border-radius: 12px; font-size: 13.5px; }
    </style>

    @stack('styles')
</head>
<body>

<!-- ═══ SIDEBAR ═══ -->
<div class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon"><i class="fas fa-cart-shopping"></i></div>
        <h6>POS SYSTEM</h6>
        <small>Point Of Sale Application</small>
    </div>

    {{-- Dashboard --}}
    <div class="sidebar-section">Dashboard</div>
    <a href="{{ route('dashboard') }}"
       class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fas fa-chart-pie"></i>
        <span>Dashboard</span>
    </a>

    {{-- Master Data --}}
    <div class="sidebar-section">Master Data</div>
    <a href="{{ route('categories.index') }}"
       class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
        <i class="fas fa-tag"></i>
        <span>Kategori</span>
    </a>
    <a href="{{ route('products.index') }}"
       class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
        <i class="fas fa-box-archive"></i>
        <span>Produk</span>
    </a>

    {{-- Transaksi --}}
    <div class="sidebar-section">Transaksi</div>
    <a href="{{ route('sales.create') }}"
       class="sidebar-link {{ request()->routeIs('sales.create') ? 'active' : '' }}">
        <i class="fas fa-cash-register"></i>
        <span>Penjualan</span>
    </a>
    <a href="{{ route('sales.index') }}"
       class="sidebar-link {{ request()->routeIs('sales.index') ? 'active' : '' }}">
        <i class="fas fa-clock-rotate-left"></i>
        <span>Riwayat Transaksi</span>
    </a>

    {{-- Laporan --}}
    <div class="sidebar-section">Laporan</div>
    <a href="{{ route('reports.index') }}"
       class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>Laporan Penjualan</span>
    </a>

    {{-- Pengaturan --}}
    <div class="sidebar-section">Pengaturan</div>
    <a href="{{ route('users.index') }}"
       class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <i class="fas fa-users-gear"></i>
        <span>User</span>
    </a>
    <a href="#" class="sidebar-link">
        <i class="fas fa-circle-user"></i>
        <span>Profil</span>
    </a>

    {{-- Logout --}}
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link w-100 border-0 text-start"
                    style="background:rgba(239,68,68,.1); color:#fca5a5;">
                <i class="fas fa-right-from-bracket" style="color:#f87171;"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>

<!-- ═══ MAIN ═══ -->
<div class="main-wrapper">

    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-right">
            <button class="btn-icon"><i class="fas fa-moon"></i></button>
            <button class="btn-icon position-relative">
                <i class="fas fa-bell"></i>
                <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger" style="font-size:9px;">3</span>
            </button>
            <div class="user-chip dropdown" data-bs-toggle="dropdown">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <span>{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down" style="font-size:10px; color:#94a3b8;"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger"><i class="fas fa-right-from-bracket me-2"></i>Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Content -->
    <div class="page-content">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-circle-exclamation me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

@stack('scripts')
</body>
</html>
