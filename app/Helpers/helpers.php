<?php
	function convert_date($value){
		return date('d M Y', strtotime($value));
	}



	function format_harga($angka){
		$hasil="Rp. " . number_format($angka,0,',','.');
		return $hasil;	
	}

	function hitungTotal($harga, $jumlah)
    {
    	$total = $harga * $jumlah ;
    	$hasil_total = "Rp. " . number_format($total,0,',','.');  

        return $hasil_total ;
    }


	function id_barang($id){
         
    $urut_delete = substr($id, 2);

    $urut_delete = str_pad($urut_delete, 4, "0", STR_PAD_LEFT);
    $nomor=  $urut_delete;

	return $nomor;	
	}

	function jumlah_ukuran($jumlah) {
  		
  		$jumlah= $jumlah . ' ' . 'Ukuran';

		return $jumlah;
	}


	function ambil_idukuran($detail) {
  		
  		$output= $detail ;

		return $output;
	}


?>