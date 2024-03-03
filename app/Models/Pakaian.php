<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakaian extends Model
{
    use HasFactory;

    protected $table = "tbl_pakaian";
    public $timestamps = false;
    protected $primaryKey = 'id_pakaian';
    public $incrementing = false;
    protected $fillable = ['id_pakaian','nama_jenis'];
     protected $keyType = 'string';

    public function pakaian(){
        return $this->hasMany('App\Models\Barang', 'id_pakaian');
    }
}
