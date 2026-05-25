@extends('layouts.app')

@section('content')

<h2 class="mb-4 fw-bold">Input Barang Keluar</h2>

<div class="card p-4" style="border-radius:16px;">

<form action="/transaksi/keluar" method="POST">
@csrf

<div class="row">

    <!-- KIRI -->
    <div class="col-md-6">

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Produk</label>
            <select name="nama_produk" id="produkSelect" class="form-select" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk }}">{{ $produk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Batch (Exp Date)</label>
            <select name="batch_id" id="batchSelect" class="form-select" required>
                <option value="">-- Pilih Batch --</option>
                @foreach($batches as $batch)
                    <option 
                        value="{{ $batch->id }}" 
                        data-produk="{{ $batch->nama_produk }}">
                        {{ $batch->nama_produk }} | Exp: {{ $batch->exp_date }} | Stok: {{ $batch->sisa }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <!-- KANAN -->
    <div class="col-md-6">

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" class="form-control" value="dus" readonly>
            <input type="hidden" name="satuan" value="dus">
        </div>

    </div>

</div>

<button class="btn btn-danger mt-3">Simpan</button>

</form>

</div>

<script>
document.getElementById('produkSelect').addEventListener('change', function () {
    let selectedProduk = this.value;
    let batchOptions = document.querySelectorAll('#batchSelect option');

    batchOptions.forEach(option => {
        if (option.value === "") return;

        if (option.getAttribute('data-produk') === selectedProduk) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
});
</script>

@endsection