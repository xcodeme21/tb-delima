<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	protected $table = "transaksi";
	
    protected $fillable = [
        'no_invoice', 'tanggal_transaksi', 'nama_tujuan', 'no_hp_tujuan', 'alamat_tujuan', 'total_bayar', 'metode_pembayaran', 'status_pembayaran'
    ];
}
