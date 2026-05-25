@extends('layouts.app')

@section('content')

<h2 class="mb-4 fw-bold">Input Barang Masuk</h2>

<div class="card p-4" style="border-radius:16px;">

<form action="/transaksi" method="POST">
@csrf

<div class="row">

    <!-- KIRI -->
    <div class="col-md-6">

        <!-- TANGGAL -->
        <div class="mb-3">
            <label class="form-label">Tanggal Masuk</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <!-- SUPPLIER -->
        <div class="mb-3">
            <label class="form-label">Supplier</label>
            <input type="text" name="supplier" class="form-control" required>
        </div>

        <!-- PRODUK -->
        <div class="mb-3">
            <label class="form-label">Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <!-- KATEGORI -->
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" id="kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
            </select>
        </div>
        
<!-- SUBKATEGORI -->
<div class="mb-3">
    <label class="form-label">Subkategori</label>

    <select name="subkategori" id="subkategori" class="form-select" required>

        <option value="">-- Pilih Subkategori --</option>

    </select>
</div>

    </div>

    <!-- KANAN -->
    <div class="col-md-6">

        <!-- NO TRANSAKSI -->
        <div class="mb-3">
            <label class="form-label">No Transaksi</label>
            <input type="text" class="form-control" value="Auto Generate" disabled>
        </div>

        <!-- JUMLAH + SATUAN -->
        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <div class="d-flex gap-2">
                <input type="number" name="jumlah" class="form-control" required>

                <input type="text" class="form-control" value="dus" readonly>
                <input type="hidden" name="satuan" value="dus">
            </div>
        </div>

        <!-- EXP DATE -->
        <div class="mb-3">
            <label class="form-label">Exp Date</label>
            <input type="date" name="exp_date" class="form-control">
        </div>

    </div>

</div>

<!-- BUTTON -->
<div class="mt-3">
    <button class="btn btn-success px-4">Simpan</button>
</div>

</form>

</div>

<script>

const subkategori = {

    Makanan: [
        "Snack / Wafer / Biskuit",
        "Permen",
        "Mie Instan",
        "Sereal",
        "Makanan Bayi"
    ],

    Minuman: [
        "Kopi Sachet",
        "Susu",
        "Minuman Serbuk"
    ]

};

const kategoriSelect = document.getElementById('kategori');
const subkategoriSelect = document.getElementById('subkategori');

kategoriSelect.addEventListener('change', function () {

    let kategori = this.value;

    subkategoriSelect.innerHTML =
        '<option value="">-- Pilih Subkategori --</option>';

    if (subkategori[kategori]) {

        subkategori[kategori].forEach(function(item) {

            let option = document.createElement('option');

            option.value = item;
            option.text = item;

            subkategoriSelect.appendChild(option);

        });

    }

});

</script>

@endsection