<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;

class PrediksiController extends Controller
{
    public function index()
    {
        $hasil = [];

        $produk = Transaksi::where('tipe', 'keluar')
            ->orderBy('tanggal')
            ->get()
            ->groupBy('nama_produk');

        foreach ($produk as $nama => $data) {

            // Total penjualan per minggu
            $mingguan = [];

            foreach ($data->groupBy(function ($item) {
                return Carbon::parse($item->tanggal)->format('o-W');
            }) as $rows) {

                $mingguan[] = $rows->sum('jumlah');
            }

            // Ambil 8 minggu terakhir
            $mingguan = array_slice($mingguan, -8);

            // Jika kurang dari 8 minggu, tambahkan angka 0 di depan
            while (count($mingguan) < 8) {
                array_unshift($mingguan, 0);
            }

            // Moving Average 2
            $ma2 = ($mingguan[6] + $mingguan[7]) / 2;

            // Linear Regression dari Google Colab
            $prediksi = 0.12180630948613924 + (0.8940087875173437 * $ma2);

            $hasil[] = [
                'nama_produk' => $nama,

                'm1' => $mingguan[0],
                'm2' => $mingguan[1],
                'm3' => $mingguan[2],
                'm4' => $mingguan[3],
                'm5' => $mingguan[4],
                'm6' => $mingguan[5],
                'm7' => $mingguan[6],
                'm8' => $mingguan[7],

                'ma2' => round($ma2,2),
                'prediksi' => round($prediksi)
            ];
        }

        return view('prediksi.index', compact('hasil'));
    }
}