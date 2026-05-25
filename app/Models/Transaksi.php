<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'tanggal',
        'no_transaksi',
        'supplier',
        'nama_produk',
        'jumlah',
        'satuan',
        'exp_date',
        'tipe',
        'kategori',
        'subkategori'
    ];
}
