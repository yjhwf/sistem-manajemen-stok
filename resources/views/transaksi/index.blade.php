@extends('layouts.app')

@section('content')

<h2 class="mb-4 fw-bold">📊 Transaksi</h2>

<div class="card p-4" style="border-radius:16px;">

    <!-- TAB -->
    <div class="d-flex gap-4 mb-4 border-bottom pb-2">

        <!-- BARANG MASUK (ACTIVE) -->
        <a href="/transaksi" style="text-decoration:none;">
            <div style="border-bottom:3px solid #198754; padding-bottom:6px; font-weight:600; color:#198754;">
                Barang Masuk
            </div>
        </a>

        <!-- BARANG KELUAR -->
        <a href="/transaksi/keluar" style="text-decoration:none;">
            <div class="text-muted">
                Barang Keluar
            </div>
        </a>

    </div>

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold">📥 Riwayat Barang Masuk</h5>

        <a href="/transaksi/create" class="btn btn-success shadow-sm">
            + Input Barang Masuk
        </a>
    </div>

    <!-- TABLE -->
     <div class="mb-3">
    <input type="text" id="searchInput"
           class="form-control"
           placeholder="🔍 Cari produk...">
    </div>

    <table class="table align-middle">

        <thead style="background:#f3f7f5;">
            <tr>
                <th>TANGGAL</th>
                <th>NO. TRANSAKSI</th>
                <th>SUPPLIER</th>
                <th>PRODUK</th>
                <th>KATEGORI</th>
                <th>SUBKATEGORI</th>
                <th>JUMLAH</th>
                <th>EXP DATE</th>
                <th style="text-align:center; width:90px;">AKSI</th>
            </tr>
        </thead>

        <tbody id="tableBody">

        @forelse($transaksis as $trx)
        <tr>

            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
            <td>{{ $trx->no_transaksi }}</td>
            <td>{{ $trx->supplier }}</td>
            <td class="fw-semibold">{{ $trx->nama_produk }}</td>
            <td>{{ $trx->kategori ?? '-' }}</td>
            <td>{{ $trx->subkategori ?? '-' }}</td>
            <td>{{ $trx->jumlah }} {{ $trx->satuan }}</td>

            <td>
                {{ $trx->exp_date 
                    ? \Carbon\Carbon::parse($trx->exp_date)->format('d M Y') 
                    : '-' 
                }}
            </td>

            <!-- AKSI -->
            <td style="text-align:center; vertical-align:middle; min-width:90px;">
                <div style="display:flex; justify-content:center; gap:12px;">

                    <!-- EDIT -->
                    <a href="/transaksi/{{ $trx->id }}/edit" style="text-decoration:none;">
                        <i class="bi bi-pencil text-warning"
                           style="font-size:18px; transition:0.2s;"></i>
                    </a>

                    <!-- DELETE -->
                    <form action="/transaksi/{{ $trx->id }}" method="POST"
                          onsubmit="confirmDelete(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="border:none; background:none; padding:0;">
                            <i class="bi bi-trash text-danger"
                               style="font-size:18px; transition:0.2s;"></i>
                        </button>
                    </form>

                </div>
            </td>

        </tr>

        @empty
        <tr>
            <td colspan="9" class="text-center text-muted">
                Belum ada data transaksi
            </td>
        </tr>
        @endforelse

        </tbody>

    </table>

</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {

    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll('#tableBody tr');

    rows.forEach(row => {

        let text = row.innerText.toLowerCase();

        if(text.includes(value)){
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }

    });

});
</script>

@endsection