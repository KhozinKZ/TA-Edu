<?php

namespace App\Http\Controllers;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $id = $request->input('barang_id');
        // \Log::info('Data yang diterima dari permintaan: ' . $id);
        $keranjang = Keranjang::select('nama_produk','nama_ukuran','harga','jumlah')
        ->leftjoin('tbl_barang as a','a.id','=','tbl_keranjang.id_barang')
        ->leftjoin('tbl_ukuran as b','b.id_ukuran','=','tbl_keranjang.id_ukuran')
        // ->leftjoin('tbl_transaksi as c','c.pembayaran','=','tbl_keranjang.pembayaran')
       
        ->where('tbl_keranjang.pembayaran', $id)
        ->get();
          // \Log::info('data: ' . $keranjang);    

         $transaksi = Transaksi::select('*')   
        ->where('pembayaran', $id)
        ->get();



         if ($request->ajax()) {
        $response = [
            'id' => $id,
            'keranjang' => $keranjang,
            'transaksi' => $transaksi,
            'gambar' => $transaksi,
        ];
        return response()->json($response);
         }




          // $keranjang = Keranjang::select('*')
          //        ->leftjoin('tbl_barang as a','a.id','=','tbl_keranjang.id_barang')
          //        ->where('tbl_keranjang.pembayaran','=', $id  )
          //        ->get();

       

        return view('tampilan.transaksi.transaksi' , compact('keranjang','transaksi'));
    }




     public function api(Request $request)
    {
     
    // $transaksi = Transaksi::select('*')
                 // ->leftjoin('users as a','a.id','=','tbl_transaksi.id_user')
                 // ->leftjoin('tbl_ukuran as b','b.id_ukuran','=','tbl_keranjang.id_ukuran')
                 // ->where('tbl_keranjang.status','=', 'new')
                 // ->get();
        $transaksi = Transaksi::select('id_transaksi','tbl_transaksi.id_user','name','total_bayar','tgl_pesanan','status','tbl_transaksi.pembayaran')
               ->leftjoin('tbl_keranjang', 'tbl_keranjang.pembayaran','=','tbl_transaksi.pembayaran')
               ->leftjoin('users', 'users.id','=','tbl_transaksi.id_user')
               ->where('tbl_keranjang.status', 'proses')
               ->orWhere('tbl_keranjang.status', 'selesai')
               ->groupBy('id_transaksi','tbl_transaksi.id_user','name','total_bayar','tgl_pesanan','status','tbl_transaksi.pembayaran')
               ->get();



     $datatables= datatables()->of($transaksi)
                             ->addColumn('format_total', function($transaksi){
                                    return format_harga($transaksi->total_bayar);
                                })
                               
                                ->addIndexColumn();

                                 
    return ($datatables->make(true)); 
  
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
         $transaksi=Transaksi::find($id);

        if ($request->hasFile('file_bayar')) {
            $destination = 'transaksi/' . $transaksi->file_bayar;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('file_bayar');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move('transaksi/', $filename);

            $transaksi->update([
                'file_bayar' => $filename,
            ]);
        }



                $pembayaran = $transaksi->pembayaran;
                
                $keranjang = Keranjang::where('pembayaran', $pembayaran)->get();

        
                foreach ($keranjang as $item) {
                        $item->status = 'Selesai';
                        // Menyimpan perubahan status
                        $item->save();
                }
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
