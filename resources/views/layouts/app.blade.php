<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Aneka Jaya — Manajemen Stok</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --blue:         #1A5EB8;
        --blue-dark:    #154ea0;
        --blue-mid:     #1e6fd4;
        --sidebar-w:    240px;
        --bg:           #f4f6f9;
        --surface:      #ffffff;
        --border:       #e5e9f0;
        --text-primary: #111827;
        --text-muted:   #6b7280;
        --radius-card:  14px;
        --radius-btn:   9px;
        --shadow-card:  0 1px 4px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
    }

    html, body {
        margin: 0; padding: 0; height: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--text-primary);
        font-size: 14px;
    }

    .wrapper { display: flex; min-height: 100vh; }

    /* ── SIDEBAR ── */
    .sidebar {
        width: var(--sidebar-w);
        background: linear-gradient(180deg, #1a3f6f 0%, #1e5298 55%, #1a3f6f 100%);
        position: fixed;
        top: 0; left: 0; bottom: 0;
        display: flex;
        flex-direction: column;
        z-index: 100;
        overflow: hidden;
    }

    .sidebar::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,.04);
        pointer-events: none;
    }

    .sidebar-brand {
        padding: 22px 20px 18px;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .brand-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        background: rgba(255,255,255,.12);
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .brand-name {
        font-size: 13px;
        font-weight: 700;
        color: #ffffff;
        letter-spacing: .3px;
        line-height: 1.2;
    }

    .brand-sub {
        font-size: 11px;
        color: rgba(255,255,255,.45);
        margin-top: 2px;
    }

    .nav-section {
        padding: 14px 12px;
        flex: 1;
    }

    .nav-label {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: rgba(255,255,255,.3);
        padding: 0 8px;
        margin: 10px 0 6px;
    }

    .menu-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 12px;
        border-radius: 9px;
        color: rgba(255,255,255,.55);
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 500;
        margin-bottom: 2px;
        transition: background .15s, color .15s;
    }

    .menu-link i { font-size: 16px; flex-shrink: 0; }

    .menu-link:hover {
        background: rgba(255,255,255,.08);
        color: rgba(255,255,255,.9);
    }

    .menu-link.active {
        background: rgba(255,255,255,.15);
        color: #ffffff;
        font-weight: 600;
    }

    .menu-link.active i { color: #93c5fd; }

    .sidebar-footer {
        padding: 14px 12px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .logout-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 12px;
        border-radius: 9px;
        color: rgba(255,255,255,.4);
        text-decoration: none;
        font-size: 13px;
        transition: background .15s, color .15s;
    }

    .logout-link:hover {
        background: rgba(239,68,68,.15);
        color: #fca5a5;
    }

    /* ── MAIN ── */
    .main-area {
        margin-left: var(--sidebar-w);
        flex: 1;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        min-width: 0; /* fix nabrak */
    }

    /* ── TOPBAR ── */
    .topbar {
        height: 64px;
        background: var(--surface);
        border-bottom: 1px solid var(--border);
        padding: 0 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 50;
        flex-shrink: 0;
    }

    .topbar-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }

    .greeting-text { text-align: right; line-height: 1.3; }
    .greeting-text .name { font-size: 13.5px; font-weight: 600; color: var(--text-primary); }
    .greeting-text .sub  { font-size: 11.5px; color: var(--text-muted); }

    .avatar {
        width: 38px; height: 38px;
        border-radius: 50%;
        background: var(--blue);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 700; font-size: 14px;
        flex-shrink: 0;
    }

    /* ── PAGE CONTENT ── */
    .page-content {
        padding: 28px;
        flex: 1;
        min-width: 0; /* fix nabrak */
    }

    /* ── CARD ── */
    .card {
        background: var(--surface);
        border: 1px solid var(--border) !important;
        border-radius: var(--radius-card) !important;
        box-shadow: var(--shadow-card) !important;
    }

    /* ── STAT CARDS ── */
    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-card);
        padding: 22px 20px;
        box-shadow: var(--shadow-card);
        transition: transform .2s, box-shadow .2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,.08) !important;
    }

    .stat-icon-wrap {
        width: 46px; height: 46px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        margin-bottom: 16px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
        margin-bottom: 6px;
    }

    .stat-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: .6px;
    }

    /* ── TABLE ── */
    .table { margin: 0; font-size: 13.5px; }

    .table thead th {
        background: #f8fafb;
        color: #6b7280;
        font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: .7px;
        padding: 12px 16px !important;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    .table tbody tr td {
        padding: 13px 16px !important;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        color: var(--text-primary);
    }

    .table tbody tr:last-child td { border-bottom: none; }
    .table tbody tr:hover td { background: #f0f6ff !important; }

    /* ── BADGES ── */
    .badge { font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
    .badge-success-soft { background: #dbeafe; color: #1e40af; }
    .badge-warning-soft { background: #fef9c3; color: #a16207; }
    .badge-danger-soft  { background: #fee2e2; color: #b91c1c; }
    .badge-info-soft    { background: #dbeafe; color: #1d4ed8; }

    .badge-orange-soft {
    background: #ffedd5;
    color: #c2410c;
}

    /* ── BUTTONS ── */
    .btn { font-size: 13px; font-weight: 500; border-radius: var(--radius-btn); }

    .btn-success, .btn-primary {
        background: var(--blue);
        border-color: var(--blue);
        color: #fff;
        box-shadow: 0 2px 8px rgba(26,94,184,.25);
    }

    .btn-success:hover, .btn-primary:hover {
        background: var(--blue-dark);
        border-color: var(--blue-dark);
        color: #fff;
    }

    .btn-danger { background: #ef4444; border-color: #ef4444; }
    .btn-outline-secondary { border-color: #d1d5db; color: #6b7280; }
    .btn-outline-secondary:hover { background: #f3f4f6; color: #374151; border-color: #d1d5db; }

    .btn-icon {
        width: 30px; height: 30px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 7px; border: none;
        cursor: pointer; font-size: 14px;
        transition: background .15s;
    }

    .btn-edit  { background: #eff6ff; color: #2563eb; }
    .btn-edit:hover  { background: #dbeafe; }
    .btn-trash { background: #fef2f2; color: #dc2626; }
    .btn-trash:hover { background: #fee2e2; }

    /* ── FORM ── */
    .form-label { font-size: 12px; font-weight: 600; color: #374151; letter-spacing: .4px; margin-bottom: 6px; }

    .form-control, .form-select {
        border: 1px solid #d1d5db; border-radius: 8px;
        font-size: 13.5px; padding: 9px 12px;
        color: var(--text-primary); background: #fff;
        transition: border-color .15s, box-shadow .15s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(26,94,184,.12);
        outline: none;
    }

    .form-control[readonly], .form-control:disabled {
        background: #f8fafb; color: var(--text-muted);
    }

    .input-group-text {
        background: #f9fafb; border-color: #d1d5db; color: #9ca3af;
    }

    /* ── SEARCH ── */
    .search-wrap { position: relative; }
    .search-wrap i {
        position: absolute; left: 11px; top: 50%;
        transform: translateY(-50%);
        color: #9ca3af; font-size: 15px; pointer-events: none;
    }
    .search-wrap input { padding-left: 34px !important; width: 220px; }

    /* ── TABS ── */
    .tab-nav { display: flex; border-bottom: 2px solid #f0f0f0; margin-bottom: 22px; }
    .tab-nav a {
        text-decoration: none; padding: 10px 20px;
        font-size: 13.5px; font-weight: 500; color: var(--text-muted);
        border-bottom: 2px solid transparent; margin-bottom: -2px;
        transition: color .15s, border-color .15s;
    }
    .tab-nav a:hover { color: var(--blue); }
    .tab-nav a.active { color: var(--blue); border-bottom-color: var(--blue); font-weight: 600; }

    /* ── SECTION HEADER ── */
    .section-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
    .section-head h5 { font-size: 15px; font-weight: 600; color: var(--text-primary); margin: 0; }

    /* ── EXPIRY CARD ── */
    .expiry-card {
        background: var(--surface);
        border: 1px solid #fde68a;
        border-radius: var(--radius-card);
        overflow: hidden;
        box-shadow: var(--shadow-card);
    }

    .expiry-header {
        background: #fffbeb;
        border-bottom: 1px solid #fde68a;
        padding: 14px 20px;
        display: flex; align-items: center; gap: 8px;
        font-weight: 600; font-size: 14px; color: #92400e;
    }

    .expiry-row {
        display: flex; align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        border-bottom: 1px solid #f9fafb;
    }

    .expiry-row:last-of-type { border-bottom: none; }
    .expiry-name { font-weight: 600; font-size: 13.5px; color: var(--text-primary); }
    .expiry-meta { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

    /* ── WA BUTTON (tidak diubah) ── */
    .btn-wa {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 13px;
        background: linear-gradient(135deg, #25d366, #128c7e);
        color: #fff;
        font-weight: 600;
        font-size: 14px;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        margin-top: 16px;
        transition: opacity .2s;
    }

    .btn-wa:hover { opacity: .9; color: #fff; }

    /* ── GUEST ── */
    body.guest {
        background: linear-gradient(135deg, #e8f0fb 0%, #f4f6f9 50%, #eef2fb 100%);
    }

    /* ── AUTH CARD ── */
    .auth-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 38px 34px;
        width: 380px;
        box-shadow: 0 4px 24px rgba(26,94,184,.10);
    }

    .auth-logo {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: var(--blue);
        display: flex; align-items: center; justify-content: center;
        font-size: 24px;
        margin: 0 auto 14px;
    }

    .auth-title { font-size: 20px; font-weight: 700; text-align: center; color: var(--text-primary); margin-bottom: 4px; }
    .auth-sub   { font-size: 13px; text-align: center; color: var(--text-muted); margin-bottom: 28px; }

    .auth-card .form-control { padding: 11px 14px; font-size: 14px; border-radius: 10px; }

    .btn-auth {
        width: 100%; padding: 12px;
        background: var(--blue);
        border: none; border-radius: 10px;
        color: #fff; font-weight: 600; font-size: 14px;
        cursor: pointer; margin-top: 4px;
        transition: background .2s;
    }

    .btn-auth:hover { background: var(--blue-dark); }

    .auth-link { display: block; text-align: center; margin-top: 18px; font-size: 13px; color: var(--text-muted); }
    .auth-link a { color: var(--blue); font-weight: 600; text-decoration: none; }

    /* ── ALERTS ── */
    .alert { border-radius: 9px; font-size: 13.5px; padding: 10px 14px; border: none; }
    .alert-danger  { background: #fee2e2; color: #991b1b; }
    .alert-success { background: #dbeafe; color: var(--blue); }

    .text-code { font-family: 'Courier New', monospace; font-size: 12px; color: var(--text-muted); }
    </style>
</head>

<body class="{{ auth()->check() ? '' : 'guest' }}">
<div class="wrapper">

@if(auth()->check())
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">🛒</div>
            <div class="brand-name">TOKO ANEKA JAYA</div>
            <div class="brand-sub">Sistem Manajemen Stok</div>
        </div>

        <nav class="nav-section">
            <div class="nav-label">Menu</div>
            <a href="/dashboard" class="menu-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="/barang" class="menu-link {{ request()->is('barang*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Produk
            </a>
            <a href="/transaksi" class="menu-link {{ request()->is('transaksi*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Transaksi
            </a>
            <a href="/laporan" class="menu-link {{ request()->is('laporan') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i> Laporan
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="/logout" class="logout-link">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </aside>

    <div class="main-area">
        <header class="topbar">
            <span class="topbar-title">
                @if(request()->is('dashboard'))      Dashboard
                @elseif(request()->is('barang*'))    Manajemen Produk
                @elseif(request()->is('transaksi*')) Transaksi
                @elseif(request()->is('laporan'))    Laporan &amp; Prediksi Stok
                @else Toko Aneka Jaya
                @endif
            </span>
            <div class="topbar-right">
                <div class="greeting-text">
                    <div class="name">Halo, {{ auth()->user()->name }} 👋</div>
                    <div class="sub">Selamat datang</div>
                </div>
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="page-content">
            @yield('content')
        </main>
    </div>

@else
    <div class="flex-grow-1">
        @yield('content')
    </div>
@endif

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(event) {
    event.preventDefault();
    const form = event.target;
    Swal.fire({
        title: 'Yakin hapus data?',
        text: 'Data yang dihapus tidak bisa dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        background: '#ffffff',
        customClass: {
            popup: 'rounded-4',
            confirmButton: 'rounded-pill px-4',
            cancelButton: 'rounded-pill px-4'
        }
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });
    return false;
}
</script>
</body>
</html>