<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    protected $table = "tbl_barang";
    protected $primaryKey = 'id';
    // protected $keyType = 'string';
    // protected $casts = ['id' => 'integer'];
    
    protected $fillable = ['id','nama_produk','id_pakaian','harga','stok','gambar','keterangan'];

    public function pakaian(){
        return $this->belongsTo('App\Models\Pakaian', 'id_pakaian');
        
    }

    

    public function detailUkuran()
    {
    return $this->hasMany(Detailukuran::class, 'id_barang');
    }


}
