@extends('layouts.app')

@section('content')

<h2 class="mb-4 fw-bold">Edit Produk</h2>

<div class="card p-4" style="border-radius:16px;">

    <form action="/barang/{{ $barang->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- KIRI -->
            <div class="col-md-6">

                <!-- NAMA -->
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input 
                        type="text" 
                        name="nama_produk" 
                        class="form-control"
                        value="{{ $barang->nama_produk }}"
                        required
                    >
                </div>

                <!-- KATEGORI -->
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input 
                        type="text" 
                        name="kategori" 
                        class="form-control"
                        value="{{ $barang->kategori }}"
                        required
                    >
                </div>

            </div>

            <!-- KANAN -->
            <div class="col-md-6">

                <!-- JUMLAH -->
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input 
                        type="text" 
                        class="form-control"
                        value="{{ $barang->jumlah }} {{ $barang->satuan }}"
                        disabled
                    >
                </div>

                <!-- EXP -->
                <div class="mb-3">
                    <label class="form-label">Exp Date</label>
                    <input 
                        type="text" 
                        class="form-control"
                        value="{{ $barang->exp_date }}"
                        disabled
                    >
                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-3">
            <button class="btn btn-success px-4">
                Update
            </button>

            <a href="/barang" class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </form>

</div>

@endsection