<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Pakaian;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 

if(auth()->user()->can('Dasboard')){
        $total_pakaian = Pakaian::count();
        $total_barang = Barang::count();
        $total_keranjang = Keranjang::where('status', 'new')->count();

        $total_transaksi = Transaksi::select('id_transaksi', 'tbl_transaksi.pembayaran', 'tbl_keranjang.status')
            ->leftJoin('tbl_keranjang', 'tbl_keranjang.pembayaran', '=', 'tbl_transaksi.pembayaran')
            ->where('tbl_keranjang.status', 'proses')
            ->groupBy('id_transaksi', 'tbl_keranjang.status', 'tbl_transaksi.pembayaran')
            ->get();
        $total_transaksi_count = $total_transaksi->count();


      // selectRaw(...): Ini adalah bagian dari Eloquent, ORM (Object-Relational Mapping) yang disediakan oleh Laravel. Ini memulai pembuatan query untuk tabel 
                        $data_donat = Keranjang::selectRaw(
                            "COUNT(CASE WHEN status = 'new' THEN 1 ELSE NULL END) as keranjang_count, 
                             COUNT(CASE WHEN status = 'proses' THEN 1 ELSE NULL END) as proses_count,
                             COUNT(CASE WHEN status = 'selesai' THEN 1 ELSE NULL END) as selesai_count")
                            ->first();

                        // Mendefinisikan label untuk chart donat
                        $label_donat = ["Masuk Keranjang", "Proses Pembayaran", "Selesai Pembayaran"];

                        // Menggabungkan data dari hasil kueri dengan labelnya
                        $data_combined = [
                            $data_donat->keranjang_count ?? 0,
                            $data_donat->proses_count ?? 0,
                            $data_donat->selesai_count ?? 0,
                        ];

                        // Mengembalikan array yang berisi data dan label
                        // return [$data_combined, $label_donat];
                                 
                                 // return $data_donat;
                                 // return $label_donat;

        return view('home', compact('total_pakaian','total_barang','total_keranjang','total_transaksi_count','data_donat','label_donat','data_combined'));
    }else{
        return abort('403');
    }

    }








}
