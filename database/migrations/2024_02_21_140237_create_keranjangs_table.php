<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_keranjang', function (Blueprint $table) {
            $table->bigIncrements('id_keranjang');
            $table->date('tgl_pesanan');
            $table->integer('id_user'); 
            $table->string('id_barang', 200);
            $table->integer('jumlah');  
            $table->string('id_ukuran', 20);
            $table->string('status', 10);
            $table->string('pembayaran',10)->nullable(); ;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_keranjang');
    }
}
