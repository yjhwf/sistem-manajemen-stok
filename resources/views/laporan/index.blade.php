@extends('layouts.app')

@section('content')

<div class="table-wrap">
    <div style="padding: 14px 20px; background: #f8fafb; border-bottom: 1px solid #e5e9f0;">
        <h6 class="mb-0" style="font-weight:600; font-size:14px; color:#374151;">Prediksi Stok Per Produk</h6>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Stok Saat Ini</th>
                <th>Rata-rata Barang Keluar</th>
                <th>Rekomendasi Stok 2 Minggu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

        @forelse($data as $item)
            <tr>
                <td style="font-weight:600;">{{ $item->nama_produk }}</td>
                <td>{{ $item->stok }} {{ $item->satuan }}</td>
                <td>{{ $item->ma }} {{ $item->satuan }}</td>
                <td>{{ $item->prediksi }} {{ $item->satuan }}</td>
                <td>
                    @if($item->status == 'Restock')
                        <span class="badge badge-danger-soft">Restock</span>
                    @else
                        <span class="badge badge-success-soft">Aman</span>
                    @endif
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

@endsection