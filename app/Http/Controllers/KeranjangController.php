<?php

namespace App\Http\Controllers;
use App\Models\Detailukuran;
use App\Models\Keranjang;
use App\Models\Ukuran;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        


        $keranjang = Keranjang::select('*')
                 ->leftjoin('tbl_barang as a','a.id','=','tbl_keranjang.id_barang')
                 ->where('tbl_keranjang.status','=', 'new')
                 ->get();

        $j_ukuran=Detailukuran::select('*')       
                ->leftjoin('tbl_ukuran as b','b.id_ukuran','=','detailukuran.id_ukuran')
                 ->get();


        $transaksi=Transaksi::count();
        $kodeawal="TR";
        // $tahun = date("Y");
        if($transaksi == null){
            $nourut = "001"; 
        }else{
            $ambil = Transaksi::all()->last();
            $nourut = substr($ambil->pembayaran, 2) + 1;
      
            $nourut = str_pad($nourut, 3, "0", STR_PAD_LEFT);
        }

        $kodeid = $kodeawal . $nourut;         


         return view('tampilan.keranjang.keranjang', compact('keranjang','j_ukuran','kodeid'));
    }

     public function api(Request $request)
    {
     
    $keranjang = Keranjang::select('*')
                 ->leftjoin('tbl_barang as a','a.id','=','tbl_keranjang.id_barang')
                 ->leftjoin('tbl_ukuran as b','b.id_ukuran','=','tbl_keranjang.id_ukuran')
                 ->where('tbl_keranjang.status','=', 'new')
                 ->get();

     $datatables= datatables()->of($keranjang)
                              ->addColumn('format_tgl', function($keranjang){
                                    return convert_date($keranjang->tgl_pesanan);
                                })
                                ->addColumn('format_harga_barang', function($keranjang){
                                    return format_harga($keranjang->harga);
                                })
                               ->addColumn('hitung_total', function ($keranjang) {
                                    return hitungTotal($keranjang->harga, $keranjang->jumlah);
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
       try {
            \DB::beginTransaction();    
       // Mengambil semua entri keranjang dengan status 'new'
    $keranjang = Keranjang::where('status', 'new')->get();

    // Memeriksa apakah ada entri keranjang yang ditemukan
    if ($keranjang->isNotEmpty()) {
        // Melakukan iterasi pada setiap entri keranjang
        foreach ($keranjang as $item) {
            // Mengubah status keranjang sesuai dengan pembayaran yang diterima dari permintaan
            $item->pembayaran = $request->pembayaran;
            $item->status = 'proses';
            $item->save();
            }
        // Tindakan tambahan setelah penyimpanan, jika diperlukan

        $transaksi = new Transaksi;
        $transaksi->id_user = auth()->user()->id;
        $transaksi->total_bayar = $data['total_bayar'];
        $transaksi->pembayaran = $data['pembayaran'];
        $transaksi->save();
        } 


        


          \DB::commit();

        }   catch (\Throwable $exception){
            \DB::rollBack();

            // return redirect()->back()->with('error', $th->getMessage());
            return back()->withError($exception->getMessage())->withInput();
        }  

        return redirect('bayar');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $data = $request->all(); 

        $keranjang=Keranjang::find($id);
         $jumlah = $keranjang->jumlah;
         $id_barang = $keranjang->id_barang;
        
        $barang = Barang::findOrFail($id_barang);
         $stok = $barang->stok;

        $barang->stok += $jumlah ;
        $barang->save();



        $keranjang->jumlah=$data['jumlah'];
        $keranjang->save();

        $barang->stok -= $data['jumlah'] ;
        $barang->save();

        // $keranjang->update([
        //         'jumlah' => $request->jumlah,
        //     ]);

        return redirect('keranjang');
    }
   public function simpan(Request $request)
{

        //  $request->validate([
        //     'id_keranjang' => 'required|integer',
        //     'id_ukuran' => 'required|integer',
        // ]);

        // Lakukan pembaruan data di dalam database
        $keranjang = Keranjang::find($request->id_keranjang);
        $keranjang->id_ukuran = $request->id_ukuran;
        $keranjang->save();

        // Beri respons ke klien
        return response()->json(['message' => 'Data berhasil diperbarui'], 200);



    // // Validasi data jika diperlukan
    // $request->validate([
    //     'id_ukuran' => 'required', // Atur aturan validasi sesuai kebutuhan Anda
    // ]);

    // // Ambil data yang diterima dari permintaan
    // $id_ukuran = $request->input('id_ukuran');

    // // Cari dan perbarui data keranjang yang sesuai dengan ID yang diberikan
    // $keranjang = Keranjang::findOrFail($id);
    // $keranjang->id_ukuran = $id_ukuran;
    // $keranjang->save();

    // // Berikan respons kepada frontend
    // return response()->json(['message' => 'Ukuran berhasil diperbarui'], 200);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keranjang=Keranjang::find($id);
         $jumlah = $keranjang->jumlah;
         $id_barang = $keranjang->id_barang;
        
        $barang = Barang::findOrFail($id_barang);
         $stok = $barang->stok;

        $barang->stok += $jumlah ;
        $barang->save();

         $keranjang->delete(); 
    }
}
