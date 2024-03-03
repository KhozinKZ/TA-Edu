<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    protected $table = "tbl_transaksi";
    protected $primaryKey = 'id_transaksi';

    protected $fillable = ['id_user','total_bayar','pembayaran','file_bayar'];

}
