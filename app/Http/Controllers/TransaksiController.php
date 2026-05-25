<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // ================== BARANG MASUK ==================
    public function index()
    {
        $transaksis = Transaksi::where('tipe', 'masuk')->latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $tanggal = Carbon::parse($request->tanggal)->format('Ymd');
        $no_transaksi = 'IN-' . $tanggal . '-' . rand(100,999);

        Transaksi::create([
            'tanggal' => $request->tanggal,
            'no_transaksi' => $no_transaksi,
            'supplier' => $request->supplier,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'exp_date' => $request->exp_date,
            'kategori' => $request->kategori,
            'subkategori' => $request->subkategori,
            'tipe' => 'masuk'
        ]);

        return redirect('/transaksi');
    }

    // ================== EDIT ==================
    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $transaksi->update($request->all());
        return redirect('/transaksi');
    }

    // ================== DELETE ==================
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect('/transaksi');
    }

    // ================== BARANG KELUAR ==================
    public function keluar()
    {
        $transaksis = Transaksi::where('tipe', 'keluar')->latest()->get();
        return view('transaksi.keluar', compact('transaksis'));
    }

    public function createKeluar()
    {
        $masuk = Transaksi::where('tipe', 'masuk')->get();
        $keluar = Transaksi::where('tipe', 'keluar')->get();

        $batches = [];

        foreach ($masuk as $item) {

            $totalKeluar = $keluar
                ->where('nama_produk', $item->nama_produk)
                ->where('exp_date', $item->exp_date)
                ->sum('jumlah');

            $sisa = $item->jumlah - $totalKeluar;

            if ($sisa > 0) {
                $item->sisa = $sisa;
                $batches[] = $item;
            }
        }

        $produks = collect($batches)
            ->pluck('nama_produk')
            ->unique();

        return view('transaksi.create_keluar', compact('produks', 'batches'));
    }

    public function storeKeluar(Request $request)
    {
        $tanggal = Carbon::parse($request->tanggal)->format('Ymd');
        $no_transaksi = 'OUT-' . $tanggal . '-' . rand(100,999);

        $batch = Transaksi::find($request->batch_id);

        if (!$batch) {
            return back()->with('error', 'Batch tidak ditemukan!');
        }

        $totalKeluar = Transaksi::where('tipe', 'keluar')
            ->where('nama_produk', $batch->nama_produk)
            ->where('exp_date', $batch->exp_date)
            ->sum('jumlah');

        $sisa = $batch->jumlah - $totalKeluar;

        if ($request->jumlah > $sisa) {
            return back()->with('error', 'Stok tidak cukup!');
        }

        Transaksi::create([
            'tanggal' => $request->tanggal,
            'no_transaksi' => $no_transaksi,
            'supplier' => '-',
            'nama_produk' => $batch->nama_produk,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'exp_date' => $batch->exp_date,
            'kategori' => $batch->kategori,
            'tipe' => 'keluar'
        ]);

        return redirect('/transaksi/keluar');
    }
}