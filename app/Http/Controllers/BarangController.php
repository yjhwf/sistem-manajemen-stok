<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $masuk = Transaksi::where('tipe', 'masuk')->get();
        $keluar = Transaksi::where('tipe', 'keluar')->get();

        $barangs = [];

        foreach ($masuk as $item) {

            $totalKeluar = $keluar
                ->where('nama_produk', $item->nama_produk)
                ->where('exp_date', $item->exp_date)
                ->sum('jumlah');

            $sisa = $item->jumlah - $totalKeluar;

            if ($sisa > 0) {

                if ($search && stripos($item->nama_produk, $search) === false) {
                    continue;
                }

                $item->sisa = $sisa;
                $barangs[] = $item;
            }
        }

        return view('barang.index', compact('barangs'));
    }

    public function edit($id)
    {
        $barang = Transaksi::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Transaksi::findOrFail($id);

        $barang->update([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
        ]);

        return redirect('/barang');
    }

    public function destroy($nama)
    {
        Transaksi::where('nama_produk', $nama)->delete();

        return redirect('/barang');
    }
}