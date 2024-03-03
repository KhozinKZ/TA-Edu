<?php

namespace App\Helpers;

use App\Models\Detailukuran;

class DetailUkuranService
{
    public static function getDetailById($id)
    {

    	
        return Detailukuran::where('id_barang', $id)->get();
    }
}	

?>