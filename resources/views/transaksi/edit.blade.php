@extends('layouts.app') 

@section('content')

<h2 class="mb-4 fw-bold">Edit Transaksi</h2>

<div class="card p-4" style="border-radius:16px;">

<form action="/transaksi/{{ $transaksi->id }}" method="POST">
@csrf
@method('PUT')

<div class="row">

    <!-- KIRI -->
    <div class="col-md-6">

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $transaksi->tanggal }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Supplier</label>
            <input type="text" name="supplier" class="form-control" value="{{ $transaksi->supplier }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="{{ $transaksi->nama_produk }}">
        </div>

        <div class="mb-3">
    <label class="form-label">Kategori</label>

    <select name="kategori" id="kategori" class="form-select">

        <option value="Makanan"
            {{ $transaksi->kategori == 'Makanan' ? 'selected' : '' }}>
            Makanan
        </option>

        <option value="Minuman"
            {{ $transaksi->kategori == 'Minuman' ? 'selected' : '' }}>
            Minuman
        </option>

    </select>
</div>

<div class="mb-3">
    <label class="form-label">Subkategori</label>

    <select name="subkategori" id="subkategori" class="form-select">

        <option value="{{ $transaksi->subkategori }}">
            {{ $transaksi->subkategori ?? '-- Pilih Subkategori --' }}
        </option>

    </select>
</div>

    </div>

    <!-- KANAN -->
    <div class="col-md-6">

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $transaksi->jumlah }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control" value="{{ $transaksi->satuan }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Exp Date</label>
            <input type="date" name="exp_date" class="form-control" value="{{ $transaksi->exp_date }}">
        </div>

    </div>

</div>

<div class="mt-3">
    <button class="btn btn-success px-4">Update</button>
    <a href="/transaksi" class="btn btn-secondary">Kembali</a>
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

function tampilkanSubkategori() {

    let kategori = kategoriSelect.value;

    subkategoriSelect.innerHTML = '';

    subkategori[kategori].forEach(function(item) {

        let option = document.createElement('option');

        option.value = item;
        option.text = item;

        if(item === "{{ $transaksi->subkategori }}"){
            option.selected = true;
        }

        subkategoriSelect.appendChild(option);

    });
}

kategoriSelect.addEventListener('change', tampilkanSubkategori);

tampilkanSubkategori();

</script>

@endsection