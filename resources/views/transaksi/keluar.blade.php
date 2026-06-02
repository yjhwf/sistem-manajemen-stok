@extends('layouts.app')

@section('content')

{{-- TABS --}}
<div class="tab-nav">
    <a href="/transaksi">Barang Masuk</a>
    <a href="/transaksi/keluar" class="active">Barang Keluar</a>
</div>

{{-- HEADER --}}
<div class="section-head">
    <h5>
        <i class="bi bi-box-arrow-up-right me-1" style="color:#16a34a;"></i>
        Riwayat Barang Keluar
    </h5>
    <div class="d-flex gap-2 align-items-center">
        <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" class="form-control" placeholder="Cari produk...">
        </div>
        <a href="/transaksi/keluar/create" class="btn btn-success d-flex align-items-center gap-1">
            <i class="bi bi-plus-lg"></i> Input Barang Keluar
        </a>
    </div>
</div>

{{-- TABLE --}}
<div class="table-wrap">
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No. Transaksi</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody id="tableBody">

        @forelse($transaksis as $trx)
            <tr>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                <td class="text-code">{{ $trx->no_transaksi }}</td>
                <td style="font-weight:600;">{{ $trx->nama_produk }}</td>
                <td>{{ $trx->jumlah }} {{ $trx->satuan }}</td>

                <td style="text-align:center;">
                    <div class="d-flex justify-content-center gap-2">
                        <a href="/transaksi/{{ $trx->id }}/edit" class="btn-icon btn-edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="/transaksi/{{ $trx->id }}" method="POST" onsubmit="confirmDelete(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-trash">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    <i class="bi bi-inbox" style="font-size:24px; display:block; margin-bottom:6px;"></i>
                    Belum ada data barang keluar
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let value = this.value.toLowerCase();
    document.querySelectorAll('#tableBody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
    });
});
</script>

@endsection