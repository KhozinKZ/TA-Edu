<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    use HasFactory;

    protected $table = "tbl_ukuran";
    public $timestamps = false;
    protected $primaryKey = 'id_ukuran';
    public $incrementing = false;
    protected $fillable = ['id_ukuran','nama_ukuran'];
    // protected $keyType = 'string';

     public function Detailukuran(){
        return $this->hasMany('App\Models\Detailukuran', 'id_ukuran');
        
    }

}
