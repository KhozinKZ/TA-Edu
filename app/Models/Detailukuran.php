<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailukuran extends Model
{
    use HasFactory;


    public $incrementing = false;
    public $timestamps = false;
    protected $table = "detailukuran";
    protected $primaryKey = 'id_detail_ukuran';
    // protected $keyType = 'string';
    // protected $casts = ['id' => 'integer'];
    
    protected $fillable = ['id_barang','id_ukuran'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id');
    }

     public function ukuran(){
        return $this->belongsTo(Ukuran::class, 'id_ukuran');
    }
}
