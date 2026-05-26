<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIMAKA') — Sistem Informasi Mahasiswa</title>

    {{-- Bootstrap 5.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome 6.4 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-width: 255px;
            --sidebar-bg: #1a2535;
            --sidebar-hover: #263347;
            --sidebar-active: #2563eb;
        }
        body { background-color: #f1f5f9; font-family: 'Segoe UI', sans-serif; }

        /* ── SIDEBAR ── */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed; top: 0; left: 0; z-index: 1000;
            overflow-x: hidden;
        }
        .sidebar-brand {
            padding: 1.1rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-brand .brand-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: linear-gradient(135deg,#3b82f6,#8b5cf6);
            display: flex; align-items: center; justify-content: center;
        }
        .sidebar-brand h5 { color:#fff; font-weight:700; font-size:.95rem; margin:0; }
        .sidebar-brand p  { color:rgba(255,255,255,.45); font-size:.7rem; margin:0; }

        .nav-section {
            padding: .9rem 1.1rem .25rem;
            font-size: .65rem; font-weight:700;
            text-transform: uppercase; letter-spacing:1px;
            color: rgba(255,255,255,.3);
        }
        #sidebar .nav-item { padding: 0 .6rem; margin-bottom:2px; }
        #sidebar .nav-link {
            color: rgba(255,255,255,.7);
            border-radius: 8px;
            padding: .6rem .9rem;
            display: flex; align-items: center; gap: .7rem;
            font-size: .84rem; transition: all .2s;
        }
        #sidebar .nav-link:hover { background: var(--sidebar-hover); color:#fff; }
        #sidebar .nav-link.active { background: var(--sidebar-active); color:#fff; font-weight:600; }
        #sidebar .nav-link i { width:16px; text-align:center; font-size:.85rem; }

        /* ── MAIN ── */
        #main-wrapper { margin-left: var(--sidebar-width); min-height:100vh; display:flex; flex-direction:column; }
        #topbar {
            height:56px; background:#fff;
            border-bottom:1px solid #e2e8f0;
            display:flex; align-items:center; padding:0 1.5rem;
            position:sticky; top:0; z-index:999;
        }
        #topbar .page-title { font-size:.95rem; font-weight:600; color:#1e293b; margin:0; }
        #content { padding:1.5rem; flex:1; }

        /* ── CARDS ── */
        .stat-card {
            border:none; border-radius:14px;
            padding:1.2rem 1.4rem; color:#fff;
            position:relative; overflow:hidden;
        }
        .stat-card .bg-icon {
            position:absolute; right:1rem; top:50%; transform:translateY(-50%);
            font-size:2.8rem; opacity:.18;
        }
        .card { border:none; border-radius:12px; box-shadow:0 1px 3px rgba(0,0,0,.07); }
        .card-header {
            background:transparent; border-bottom:1px solid #f1f5f9;
            font-weight:600; padding:.9rem 1.2rem;
        }
        .table th {
            font-size:.75rem; font-weight:700;
            text-transform:uppercase; letter-spacing:.5px;
            color:#64748b; border-top:none;
        }
        .badge { border-radius:50px; font-weight:500; }
        .btn { border-radius:8px; font-size:.85rem; }
        footer { background:#fff; border-top:1px solid #e2e8f0; color:#94a3b8; font-size:.78rem; }
    </style>
    @stack('styles')
</head>
<body>

{{-- ══ SIDEBAR ══ --}}
<nav id="sidebar">
    <div class="sidebar-brand d-flex align-items-center gap-2">
        <div class="brand-icon">
            <i class="fas fa-graduation-cap text-white" style="font-size:1rem;"></i>
        </div>
        <div>
            <h5>SIMAKA</h5>
            <p>Univ. PGRI Madiun</p>
        </div>
    </div>

    <ul class="nav flex-column mt-2 pb-5">
        <p class="nav-section">Menu Utama</p>

        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <p class="nav-section mt-2">Data Akademik</p>

        <li class="nav-item">
            <a href="{{ route('mahasiswa.index') }}"
               class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i>
                <span>Data Mahasiswa</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('program-studi.index') }}"
               class="nav-link {{ request()->routeIs('program-studi.*') ? 'active' : '' }}">
                <i class="fas fa-book-open"></i>
                <span>Program Studi</span>
            </a>
        </li>

        <p class="nav-section mt-2">Lainnya</p>

        <li class="nav-item">
            <a href="/api/mahasiswa" target="_blank" class="nav-link">
                <i class="fas fa-code"></i>
                <span>REST API</span>
                <i class="fas fa-external-link-alt ms-auto" style="font-size:.65rem;opacity:.5;"></i>
            </a>
        </li>
    </ul>
</nav>

{{-- ══ MAIN WRAPPER ══ --}}
<div id="main-wrapper">

    {{-- Topbar --}}
    <div id="topbar">
        <h6 class="page-title">
            <i class="fas fa-chevron-right me-2 text-muted" style="font-size:.7rem;"></i>
            @yield('page-title', 'Dashboard')
        </h6>
        <div class="ms-auto d-flex align-items-center gap-3">
            <small class="text-muted">
                <i class="fas fa-calendar-alt me-1"></i>
                {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </small>
        </div>
    </div>

    {{-- Content --}}
    <div id="content">

        {{-- Flash: success --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Flash: error --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="text-center py-3">
        &copy; {{ date('Y') }} <strong>SIMAKA</strong> — Sistem Informasi Mahasiswa · Universitas PGRI Madiun
    </footer>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
</body>
</html>
