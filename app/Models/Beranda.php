<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    use HasFactory;


    public $incrementing = false;
    public $timestamps = false;
    protected $table = "tbl_keranjang";
    protected $primaryKey = 'id_keranjang';

    protected $fillable = ['tgl_pesanan','id_user','id_barang','jumlah','id_ukuran','status','pembayaran'];

}
