@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold mb-1">Dashboard</h3>
</div>

<div class="row g-3">

    <div class="col-md-3">
        <div class="card p-3 d-flex justify-content-between flex-row" style="border-left:5px solid #198754;">
            <div>
                <h3>{{ $total }}</h3>
                <small>Total Produk</small>
            </div>
            <div style="font-size:38px;">📦</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 d-flex justify-content-between flex-row" style="border-left:5px solid #f59e0b;">
            <div>
                <h3>{{ $stok_minim }}</h3>
                <small>Stok Menipis</small>
            </div>
            <div style="font-size:38px;">⚠️</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 d-flex justify-content-between flex-row" style="border-left:5px solid #dc3545;">
            <div>
                <h3>{{ $hampir_exp }}</h3>
                <small>Hampir Kadaluarsa</small>
            </div>
          <div style="font-size:38px;">⏰</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 d-flex justify-content-between flex-row" style="border-left:5px solid #0d6efd;">
            <div>
                <h3>{{ $transaksi_bulan_ini }}</h3>
                <small>Transaksi Bulan Ini</small>
            </div>
            <div style="font-size:38px;">💰</div>
        </div>
    </div>

</div>

<div class="card mt-4 p-4" style="border:2px solid #f59e0b; background:linear-gradient(135deg,#fff7ed,#fffaf5);">

    <h5 class="fw-bold mb-3">⚠️ Peringatan Barang mendekati Kadaluarsa</h5>

    @forelse ($warning as $barang)

        @php
            $exp = \Carbon\Carbon::parse($barang->exp_date);
            $today = \Carbon\Carbon::today();
            $sisa = $today->diffInDays($exp, false);
        @endphp

        <div class="d-flex justify-content-between p-3 mb-3 rounded" style="background:white;">

            <div>
                <div class="fw-semibold">{{ $barang->nama_produk }}</div>
                <small class="text-muted">
                    Exp: {{ $exp->format('d M Y') }} |
                    Stok: {{ $barang->sisa }} {{ $barang->satuan }}
                    ({{ $sisa }} hari lagi)
                </small>
            </div>

            <div>
                @if ($sisa <= 5)
    <span class="badge bg-danger px-3 py-2">Segera</span>
@else
    <span class="badge bg-warning text-dark px-3 py-2">Perhatian</span>
@endif
            </div>

        </div>

    @empty
        <div class="text-muted">Tidak ada barang</div>
    @endforelse

    @php
        $pesan = "⚠️ Peringatan Barang Mendekati Kadaluarsa%0A%0A";
        foreach($warning as $item){
            $pesan .= "• ".$item->nama_produk." | Stok: ".$item->sisa." ".$item->satuan."%0A";
        }
    @endphp

    <a href="https://wa.me/6285770655979?text={{ $pesan }}" target="_blank" class="btn btn-success mt-2">
        📱 Kirim Notifikasi WhatsApp
    </a>

</div>

@endsection