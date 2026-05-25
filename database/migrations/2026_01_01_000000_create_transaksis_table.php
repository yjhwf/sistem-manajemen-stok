<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->string('no_transaksi');
        $table->string('supplier');
        $table->string('nama_produk');
        $table->integer('jumlah');
        $table->string('satuan');
        $table->date('exp_date')->nullable();
        $table->string('tipe')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
