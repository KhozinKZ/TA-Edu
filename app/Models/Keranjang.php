<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    use HasFactory;


    public $incrementing = false;
    public $timestamps = false;
    protected $table = "tbl_keranjang";
    protected $primaryKey = 'id_keranjang';

    protected $fillable = ['jumlah','id_ukuran','status','pembayaran'];
}
