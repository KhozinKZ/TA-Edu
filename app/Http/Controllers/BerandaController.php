<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use App\Models\Barang;
use App\Models\Detailukuran;
// use App\Models\keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $barang = DB::table('tbl_barang')->get();
        // return view('tampilan.beranda.index', ['barang' => $barang]);
        return view('tampilan.beranda.index');
    }

    public function api(){

        // $barang = Barang::all();

        $barang = Barang::select('*')
                ->leftjoin('tbl_pakaian as c','c.id_pakaian','=','tbl_barang.id_pakaian')
                ->get();

        return json_encode($barang);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $keranjang = new Beranda;
        if ($keranjang !== null) {
            $keranjang->id_barang = $data['id_barang'];
             $keranjang->tgl_pesanan = $data['tgl_pesanan'];
             $keranjang->id_user = auth()->user()->id;
             $keranjang->jumlah = $data['jumlah'];
             $keranjang->id_ukuran = $data['id_ukuran'];
             $keranjang->status = 'new';
             $keranjang->save();
            // Lanjutkan dengan manipulasi objek atau entitas lainnya


             $barang = Barang::findOrFail($data['id_barang']);
             if($barang->stok > $data['jumlah']){
                $barang->stok -= $data['jumlah'];
                $barang->save();
             }else{

             }
                
        } else {
            // Tindakan yang sesuai jika objek tidak tersedia
        }




        
        
// return redirect()->back();

        return redirect('beranda');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beranda  $beranda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang=Barang::join('tbl_pakaian as c','c.id_pakaian','=','tbl_barang.id_pakaian')
        ->where('tbl_barang.id','=', $id)
        ->first();

        $detail = Detailukuran::join('tbl_ukuran as b','b.id_ukuran','=','detailukuran.id_ukuran')
        ->where('detailukuran.id_barang', $id)
        ->get();


        return view('tampilan.beranda.detail', compact('barang','detail'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beranda  $beranda
     * @return \Illuminate\Http\Response
     */
    public function edit(Beranda $beranda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beranda  $beranda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beranda $beranda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beranda  $beranda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beranda $beranda)
    {
        //
    }
}
