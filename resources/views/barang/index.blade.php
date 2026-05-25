@extends('layouts.app')

@section('content')

<h2 class="mb-4 fw-bold">📦 Manajemen Produk</h2>

<div class="card p-4" style="border-radius:16px;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold">Daftar Produk</h5>

        <form method="GET" action="/barang">
            <input 
                type="text" 
                name="search"
                class="form-control"
                placeholder="🔍 Cari Produk"
                style="width:220px; border-radius:10px;"
                value="{{ request('search') }}"
            >
        </form>
    </div>

    <table class="table align-middle">
        <thead style="background:#f3f7f5;">
            <tr>
                <th>KODE</th>
                <th>TANGGAL MASUK</th>
                <th>NAMA PRODUK</th>
                <th>KATEGORI</th>
                <th>SUBKATEGORI</th>
                <th>STOK</th>
                <th>EXP DATE</th>
                <th>STATUS</th>
            </tr>
        </thead>

        <tbody>

        @forelse ($barangs as $barang)
        <tr>

            <td>PRD-{{ str_pad($barang->id, 3, '0', STR_PAD_LEFT) }}</td>

            <td>{{ \Carbon\Carbon::parse($barang->tanggal)->format('d M Y') }}</td>

            <td class="fw-semibold">{{ $barang->nama_produk }}</td>

            <td>{{ $barang->kategori ?? '-' }}</td>

            <td>{{ $barang->subkategori ?? '-' }}</td>

            <td>{{ $barang->sisa }} {{ $barang->satuan }}</td>

            <td>
                {{ $barang->exp_date 
                    ? \Carbon\Carbon::parse($barang->exp_date)->format('d M Y') 
                    : '-' 
                }}
            </td>

            <!-- STATUS -->
            <td>
                @php
                    $today = \Carbon\Carbon::today();
                    $exp = $barang->exp_date ? \Carbon\Carbon::parse($barang->exp_date) : null;
                    $sisaHari = $exp ? $today->diffInDays($exp, false) : null;
                @endphp

                @if ($exp && $sisaHari < 0)
                    <span class="badge badge-danger-soft">Kadaluarsa</span>
                @endif

                @if ($sisaHari !== null && $sisaHari <= 5 && $sisaHari >= 0)
                    <span class="badge badge-danger-soft">
                        {{ $sisaHari == 0 ? 'Hari ini Exp' : $sisaHari.' hari lagi' }}
                    </span>
                @endif

                @if ($sisaHari !== null && $sisaHari > 5 && $sisaHari <= 30)
                    <span class="badge bg-danger text-white">Hampir Kadaluarsa</span>
                @endif

                @if ($barang->sisa < 10)
                    <span class="badge bg-danger text-white">Stok Minim</span>
                @endif

                @if ($barang->sisa >= 100)
                    <span class="badge badge-success-soft">Stok Banyak</span>
                @endif

                @if (
                    ($sisaHari === null || $sisaHari > 30) &&
                    $barang->sisa >= 10 && $barang->sisa < 100
                )
                    <span class="badge badge-success-soft">Aman</span>
                @endif
            </td>

        </tr>

        @empty
        <tr>
            <td colspan="8" class="text-center text-muted">
                Belum ada data produk
            </td>
        </tr>
        @endforelse

        </tbody>
    </table>

</div>

@endsection