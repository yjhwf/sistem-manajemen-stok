@extends('layouts.app')

@section('content')

<div class="card p-4">

    <div class="mb-4 pb-3" style="border-bottom: 1px solid #f0f4f8;">
        <h5 class="mb-0" style="font-weight:700;">Input Barang Keluar</h5>
        <p class="text-muted mb-0" style="font-size:13px; margin-top:4px;">Catat barang yang keluar dari gudang</p>
    </div>

    <form action="/transaksi/keluar" method="POST">
        @csrf

        <div class="row g-3">

            {{-- KIRI --}}
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

            {{-- KANAN --}}
            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="0" required>
                </div>

                <div class="mb-3">
    <label class="form-label">Satuan</label>
    <select name="satuan" class="form-select" required>
        <option value="dus">Dus</option>
        <option value="renceng">Renceng</option>
        <option value="box">Box</option>
        <option value="pack">Pack</option>
    </select>
</div>

            </div>

        </div>

        <div class="d-flex gap-2 mt-2">
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-check-lg me-1"></i> Simpan
            </button>
            <a href="/transaksi/keluar" class="btn btn-secondary px-4">Batal</a>
        </div>

    </form>

</div>

<script>
document.getElementById('produkSelect').addEventListener('change', function () {
    let selectedProduk = this.value;
    document.querySelectorAll('#batchSelect option').forEach(option => {
        if (option.value === '') return;
        option.style.display = option.getAttribute('data-produk') === selectedProduk ? 'block' : 'none';
    });
});
</script>

@endsection