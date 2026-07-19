@extends('layouts.app')

@section('content')

<div class="card p-4">

    <div class="mb-4 pb-3" style="border-bottom: 1px solid #f0f4f8;">
        <h5 class="mb-0" style="font-weight:700;">Input Barang Masuk</h5>
        <p class="text-muted mb-0" style="font-size:13px; margin-top:4px;">Tambahkan data barang yang masuk ke gudang</p>
    </div>

    <form action="/transaksi" method="POST">
        @csrf

        <div class="row g-3">

            {{-- KIRI --}}
            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Supplier</label>
                    <input type="text" name="supplier" class="form-control" placeholder="Nama supplier" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Produk</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Nama produk" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subkategori</label>
                    <select name="subkategori" id="subkategori" class="form-select" required>
                        <option value="">-- Pilih Subkategori --</option>
                    </select>
                </div>

            </div>

            {{-- KANAN --}}
            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">No Transaksi</label>
                    <input type="text" class="form-control" value="Auto Generate" readonly>
                </div>

                <div class="mb-3">
    <label class="form-label">Jumlah</label>
    <div class="d-flex gap-2">
        <input type="number" name="jumlah" class="form-control" placeholder="0" required>
        <select name="satuan" class="form-select" required style="max-width:110px;">
            <option value="dus">Dus</option>
            <option value="renceng">Renceng</option>
            <option value="box">Box</option>
            <option value="pack">Pack</option>
        </select>
    </div>
</div>

                <div class="mb-3">
                    <label class="form-label">Exp Date</label>
                    <input type="date" name="exp_date" class="form-control">
                </div>

            </div>

        </div>

        <div class="d-flex gap-2 mt-2">
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-check-lg me-1"></i> Simpan
            </button>
            <a href="/transaksi" class="btn btn-secondary px-4">Batal</a>
        </div> 

    </form>

</div>

<script>
const subkategori = {
    Makanan: ["Snack / Wafer / Biskuit", "Permen", "Mie Instan", "Sereal", "Makanan Bayi"],
    Minuman: ["Kopi Sachet", "Susu", "Minuman Serbuk"]
};

const kategoriSelect    = document.getElementById('kategori');
const subkategoriSelect = document.getElementById('subkategori');

kategoriSelect.addEventListener('change', function () {
    let kategori = this.value;
    subkategoriSelect.innerHTML = '<option value="">-- Pilih Subkategori --</option>';
    if (subkategori[kategori]) {
        subkategori[kategori].forEach(function (item) {
            let opt = document.createElement('option');
            opt.value = item;
            opt.text  = item;
            subkategoriSelect.appendChild(opt);
        });
    }
});
</script>

@endsection