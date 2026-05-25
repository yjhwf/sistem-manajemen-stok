@extends('layouts.app')

@section('content')

<h2 class="mb-4 fw-bold">📊 Laporan & Prediksi Stok</h2>

<div class="card p-4">

    <h5 class="fw-semibold mb-4">📦 Prediksi Stok Per Produk</h5>

    <table class="table align-middle">

        <thead style="background:#f3f7f5;">
            <tr>
                <th>PRODUK</th>
                <th>STOK SAAT INI</th>
                <th>RATA-RATA BARANG KELUAR</th>
                <th>REKOMENDASI STOK 2 MINGGU</th>
                <th>STATUS</th>
            </tr>
        </thead>

<tbody>

@forelse($data as $item)
<tr>
    <td class="fw-semibold">{{ $item->nama_produk }}</td>

    <td>{{ $item->stok }} {{ $item->satuan }}</td>

    <td>{{ $item->ma }} {{ $item->satuan }}</td>

    <td>{{ $item->prediksi }} {{ $item->satuan }}</td>

    <td>
        @if($item->status == 'Restock')
            <span class="badge bg-danger">Restock</span>
        @else
            <span class="badge bg-success">Aman</span>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center text-muted">
        Belum ada data barang keluar
    </td>
</tr>
@endforelse

</tbody>

    </table>

</div>

@endsection