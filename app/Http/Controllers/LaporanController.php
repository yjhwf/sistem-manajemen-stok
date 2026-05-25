<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        $produks = Transaksi::where('tipe', 'keluar')
            ->select('nama_produk', 'satuan')
            ->distinct()
            ->get();

        $data = [];

        foreach ($produks as $produk) {

            // ambil 2 transaksi keluar terakhir
            $riwayat = Transaksi::where('tipe', 'keluar')
                ->where('nama_produk', $produk->nama_produk)
                ->orderBy('tanggal', 'desc')
                ->take(2)
                ->pluck('jumlah')
                ->toArray();

            // moving average
            $ma = count($riwayat) > 0 ? array_sum($riwayat) / count($riwayat) : 0;

            // prediksi 2 minggu
            $prediksi = round($ma * 2);

            // stok saat ini
            $masuk = Transaksi::where('tipe', 'masuk')
                ->where('nama_produk', $produk->nama_produk)
                ->sum('jumlah');

            $keluar = Transaksi::where('tipe', 'keluar')
                ->where('nama_produk', $produk->nama_produk)
                ->sum('jumlah');

            $stok = $masuk - $keluar;

            $status = $stok <= $prediksi ? 'Restock' : 'Aman';

            $data[] = (object)[
                'nama_produk' => $produk->nama_produk,
                'satuan' => $produk->satuan,
                'stok' => $stok,
                'ma' => round($ma),
                'prediksi' => $prediksi,
                'status' => $status
            ];
        }

        return view('laporan.index', compact('data'));
    }
}