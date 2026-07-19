<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PrediksiController;
use App\Models\Transaksi;
use Carbon\Carbon;

/* ================== AUTH ================== */
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);


/* ================== PROTECTED ROUTES ================== */
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::get('/dashboard', function () {

        // ================== AMBIL DATA ==================
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
                $item->sisa = $sisa;
                $barangs[] = $item;
            }
        }

        // ================== HITUNG DASHBOARD ==================

        $total = collect($barangs)
        ->pluck('nama_produk')
        ->unique()
         ->count();

        $stok_minim = collect($barangs)
            ->where('sisa', '<', 10)
            ->count();

        $hampir_exp = collect($barangs)
            ->filter(function ($item) {

                if (!$item->exp_date) return false;

                $exp = Carbon::parse($item->exp_date);
                $today = Carbon::today();

                $sisa = $today->diffInDays($exp, false);

                return $sisa >= 0 && $sisa <= 30;
            })
            ->count();

        $transaksi_bulan_ini = Transaksi::where('tipe', 'keluar')
            ->count();

        $warning = collect($barangs)
            ->filter(function ($item) {

                if (!$item->exp_date) return false;

                $exp = Carbon::parse($item->exp_date);
                $today = Carbon::today();

                $sisa = $today->diffInDays($exp, false);

                return $sisa >= 0 && $sisa <= 30;
            })
            ->values();

        return view('dashboard', compact(
            'total',
            'stok_minim',
            'hampir_exp',
            'transaksi_bulan_ini',
            'warning'
        ));
    });


    /* ================== PRODUK ================== */
    Route::resource('barang', BarangController::class);
    Route::delete('/barang/{nama}', [BarangController::class, 'destroy']);


    /* ================== TRANSAKSI ================== */

    // BARANG MASUK
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/create', [TransaksiController::class, 'create']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::get('/transaksi/{transaksi}/edit', [TransaksiController::class, 'edit']);
    Route::put('/transaksi/{transaksi}', [TransaksiController::class, 'update']);
    Route::delete('/transaksi/{transaksi}', [TransaksiController::class, 'destroy']);

    // BARANG KELUAR
    Route::get('/transaksi/keluar', [TransaksiController::class, 'keluar']);
    Route::get('/transaksi/keluar/create', [TransaksiController::class, 'createKeluar']);
    Route::post('/transaksi/keluar', [TransaksiController::class, 'storeKeluar']);


    /* ================== LAPORAN ================== */
   Route::get('/laporan', [LaporanController::class, 'index']);

   Route::get('/prediksi', [PrediksiController::class, 'index']); 

});