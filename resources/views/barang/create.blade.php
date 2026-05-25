@extends('layouts.app')

@section('content')

<h2 class="mb-4">Tambah Produk</h2>

<div class="card" style="max-width: 500px;">

    <form action="/barang" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" placeholder="contoh: Minuman">
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <div class="d-flex">
                <input type="number" name="stok" class="form-control me-2" placeholder="Jumlah" required>

                <select name="satuan" class="form-select">
                    <option value="pcs">pcs</option>
                    <option value="dus">dus</option>
                    <option value="renceng">renceng</option>
                    <option value="box">box</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Expired</label>
            <input type="date" name="exp_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">
            Simpan
        </button>

    </form>

</div>

@endsection