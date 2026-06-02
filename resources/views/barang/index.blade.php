@extends('layouts.app')

@section('content')

<div class="section-head mb-4">
    <h5 class="mb-0" style="font-size:15px; font-weight:600;">Daftar Produk</h5>
    <form method="GET" action="/barang">
        <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari produk..."
                value="{{ request('search') }}"
            >
        </div>
    </form>
</div>

<div class="table-wrap">
    <table class="table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tgl Masuk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Subkategori</th>
                <th>Stok</th>
                <th>Exp Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

        @forelse ($barangs as $barang)
            <tr>
                <td class="text-code">PRD-{{ str_pad($barang->id, 3, '0', STR_PAD_LEFT) }}</td>

                <td>{{ \Carbon\Carbon::parse($barang->tanggal)->format('d M Y') }}</td>

                <td style="font-weight:600;">{{ $barang->nama_produk }}</td>

                <td>{{ $barang->kategori ?? '-' }}</td>

                <td>{{ $barang->subkategori ?? '-' }}</td>

                <td>{{ $barang->sisa }} {{ $barang->satuan }}</td>

                <td>{{ $barang->exp_date ? \Carbon\Carbon::parse($barang->exp_date)->format('d M Y') : '-' }}</td>

                <td>
                    @php
                        $today    = \Carbon\Carbon::today();
                        $exp      = $barang->exp_date ? \Carbon\Carbon::parse($barang->exp_date) : null;
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
                        <span class="badge badge-danger-soft">Hampir Kadaluarsa</span>
                    @endif

                    @if ($barang->sisa < 10)
                        <span class="badge badge-orange-soft">Stok Minim</span>
                    @endif

                    @if ($barang->sisa >= 100)
                        <span class="badge badge-info-soft">Stok Banyak</span>
                    @endif

                    @if (($sisaHari === null || $sisaHari > 30) && $barang->sisa >= 10 && $barang->sisa < 100)
                        <span class="badge badge-success-soft">Aman</span>
                    @endif
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    <i class="bi bi-inbox" style="font-size:24px; display:block; margin-bottom:6px;"></i>
                    Belum ada data produk
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>

@endsection