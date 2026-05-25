<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Stok</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
    }

    .wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* 🌿 SIDEBAR SOFT */
    .sidebar {
        width: 260px;
        background: linear-gradient(180deg, #ffffff, #f6fbf8);
        padding: 20px;
        position: fixed;
        height: 100vh;
        display: flex;
        flex-direction: column;
        border-right: 1px solid #e5e7eb;
    }

    .sidebar h5 {
        color: #16a34a;
        font-weight: bold;
    }

    .sidebar small {
        color: #6b7280;
    }

    .menu-link {
        display: block;
        padding: 10px 12px;
        border-radius: 12px;
        color: #374151;
        text-decoration: none;
        margin-bottom: 8px;
        transition: 0.2s;
    }

    .menu-link:hover {
        background: #ecfdf5;
        transform: translateX(3px);
    }

    .menu-link.active {
        background: #d1fae5;
        color: #16a34a;
        font-weight: 600;
    }

    .menu-area {
        flex: 1;
    }

    .content {
    margin-left: 0;
    padding: 30px;
    flex: 1;
}

.auth .content {
    margin-left: 260px;
}

    /* 🌿 TOPBAR CLEAN */
    .topbar {
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(8px);
        padding: 16px 30px;
        margin: -30px -30px 25px -30px;
        border-bottom: 1px solid #eee;

        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    /* 🌿 AVATAR */
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    /* 🌿 CARD */
    .card {
        border-radius: 18px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
        transition: 0.2s;
    }

    .card:hover {
        transform: translateY(-4px);
    }

    table td {
        padding-top: 14px !important;
        padding-bottom: 14px !important;
    }

    .badge-success-soft {
        background: #e6f7ee;
        color: #198754;
    }

    .badge-warning-soft {
        background: #fff4e5;
        color: #f59e0b;
    }

    .badge-danger-soft {
        background: #fde8e8;
        color: #dc3545;
    }

    .btn-success {
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(25,135,84,0.2);
    }
    </style>
</head>

<body class="{{ auth()->check() ? 'auth' : '' }}">

<div class="wrapper">

    @if(auth()->check())

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div>
            <h5>🛒 TOKO ANEKA JAYA</h5>
            <small>Sistem Manajemen Stok</small>
        </div>


<div class="mt-4 menu-area">
    <a href="/dashboard" class="menu-link {{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="bi bi-bar-chart"></i> Dashboard
    </a>

    <a href="/barang" class="menu-link {{ request()->is('barang*') ? 'active' : '' }}">
        <i class="bi bi-box"></i> Produk
    </a>

    <a href="/transaksi" class="menu-link {{ request()->is('transaksi*') ? 'active' : '' }}">
        <i class="bi bi-credit-card"></i> Transaksi
    </a>

    <a href="/laporan" class="menu-link {{ request()->is('laporan') ? 'active' : '' }}">
        <i class="bi bi-file-earmark"></i> Laporan
    </a>
</div>

<div>
    <a href="/logout" class="menu-link text-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>

    </div>

@endif

<!-- CONTENT -->
    <div class="content">

        @if(auth()->check() && request()->is('dashboard'))
          <div class="topbar">

            <div class="d-flex align-items-center gap-3">

                <div class="text-end">
                    <div class="fw-semibold">
                        Halo, {{ auth()->user()->name }} 👋
                    </div>
                    <small class="text-muted">Selamat datang</small>
                </div>

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>

            </div>

        </div>
        @endif

        @yield('content')

    </div>

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
        cancelButtonColor: '#868687',

        background: '#ffffff',

        customClass: {
            popup: 'rounded-4',
            confirmButton: 'rounded-pill px-4',
            cancelButton: 'rounded-pill px-4'
        }

    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });

    return false;
}
</script>
</body>
</html>