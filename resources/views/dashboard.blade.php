@extends('layouts.app')

@section('content')

{{-- STAT CARDS --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#dcfce7;">
                <i class="bi bi-box-seam" style="font-size:22px;color:#16a34a;"></i>
            </div>
            <div class="stat-value">{{ $total }}</div>
            <div class="stat-label">Total Produk</div>
            <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f3f4f6;font-size:11.5px;color:#9ca3af;">
                <span style="color:#16a34a;font-weight:600;">Semua produk</span> terdaftar
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#fef9c3;">
                <i class="bi bi-exclamation-triangle" style="font-size:22px;color:#ca8a04;"></i>
            </div>
            <div class="stat-value">{{ $stok_minim }}</div>
            <div class="stat-label">Stok Menipis</div>
            <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f3f4f6;font-size:11.5px;color:#9ca3af;">
                <span style="color:#ca8a04;font-weight:600;">Perlu perhatian</span> segera
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#fee2e2;">
                <i class="bi bi-calendar-x" style="font-size:22px;color:#dc2626;"></i>
            </div>
            <div class="stat-value">{{ $hampir_exp }}</div>
            <div class="stat-label">Hampir Kadaluarsa</div>
            <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f3f4f6;font-size:11.5px;color:#9ca3af;">
                <span style="color:#dc2626;font-weight:600;">Dalam 30 hari</span> ke depan
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon-wrap" style="background:#dbeafe;">
                <i class="bi bi-bag-check" style="font-size:22px;color:#1A5EB8;"></i>
            </div>
            <div class="stat-value">{{ $transaksi_bulan_ini }}</div>
            <div class="stat-label">Transaksi Bulan Ini</div>
            <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f3f4f6;font-size:11.5px;color:#9ca3af;">
                <span style="color:#1A5EB8;font-weight:600;">Total transaksi</span> bulan ini
            </div>
        </div>
    </div>

</div>

{{-- EXPIRY WARNING CARD --}}
<div class="expiry-card">

    <div class="expiry-header">
        <i class="bi bi-exclamation-triangle-fill text-warning"></i>
        Peringatan Barang Mendekati Kadaluarsa
    </div>

    @forelse ($warning as $barang)

        @php
            $exp   = \Carbon\Carbon::parse($barang->exp_date);
            $today = \Carbon\Carbon::today();
            $sisa  = $today->diffInDays($exp, false);
        @endphp

        <div class="expiry-row">
            <div>
                <div class="expiry-name">{{ $barang->nama_produk }}</div>
                <div class="expiry-meta">
                    Exp: {{ $exp->format('d M Y') }}
                    &nbsp;·&nbsp; Stok: {{ $barang->sisa }} {{ $barang->satuan }}
                    &nbsp;·&nbsp; {{ $sisa }} hari lagi
                </div>
            </div>

            @if ($sisa <= 5)
                <span class="badge badge-danger-soft">Segera!</span>
            @else
                <span class="badge badge-warning-soft">Perhatian</span>
            @endif
        </div>

    @empty
        <div class="expiry-row">
            <span class="text-muted" style="font-size:13px;">Tidak ada barang mendekati kadaluarsa 🎉</span>
        </div>
    @endforelse

    @php
        $pesan = "⚠️ Peringatan Barang Mendekati Kadaluarsa%0A%0A";
        foreach($warning as $item) {
            $pesan .= "• " . $item->nama_produk . " | Stok: " . $item->sisa . " " . $item->satuan . "%0A";
        }
    @endphp

    <div style="padding: 16px 20px;">
        <a href="https://wa.me/6285770655979?text={{ $pesan }}" target="_blank" class="btn-wa">
            <i class="bi bi-whatsapp" style="font-size:18px;"></i>
            Kirim Notifikasi WhatsApp
        </a>
    </div>

</div>

@endsection