<?php

namespace App\Http\Controllers;

use App\Models\Detailukuran;
use App\Models\Barang;
use App\Models\Pakaian;
use App\Models\Ukuran;
use App\Helpers\DetailUkuranService;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class BarangController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function viewDetail(Request $request, $id_barang)
{
        // $id = $request->input('id_barang'); 
        // \Log::info('Nilai $id dari request Modal: ' . $id);

        // if ($request->ajax()) {
        // $response = [
        //     'id' => $id,
        // ];
        // return response()->json($response);
        //  }
return view('detail', ['id_barang' => $id_barang]);


    //         if ($id) {
    //             $detail = Detailukuran::where('id_barang', $id)->get();
    //             \Log::info('data: ' . $detail);
    //         } else {
    //             $detail = collect();
           
    //         }
        
    //      $jsonData = json_encode(['id' => $id]); 
    //      \Log::info('Nilai $id dari jsonData: ' . $id);
  

    // // Kirim respons dalam bentuk JSON dengan nilai ID
    // return response()->json(['id' => $id]);
}




    public function index(Request $request)
    {
       
        // Simpan URL sebelumnya ke dalam session
$previousUrl = '/barang'; // Misalnya, URL sebelumnya adalah '/barang'
session()->put('previous_url', $previousUrl);
\Log::info('URL: ' . $previousUrl);

        $id_modal = $request->input('id_barang'); 
        // \Log::info('Nilai $id dari request Modal: ' . $id_modal);



        $j_pakaian=Pakaian::all();
        $j_ukuran=Ukuran::all();
        // $j_barang=Barang::all();
        
        $id = $request->input('barang_id');
        // \Log::info('Data yang diterima dari permintaan: ' . $id);



        $detail = Detailukuran::where('id_barang', $id)->get();
        // \Log::info('data: ' . $detail);
        
       if ($detail->isNotEmpty()) {
            $selectedUkurans = $detail->pluck('id_ukuran')->toArray();
        } else {
            $selectedUkurans = [];
        }

//          $jsonData = json_encode(['id' => $id]); 
//          \Log::info('Nilai $id dari jsonData: ' . $id);


//          // Format response sebagai JSON jika permintaan AJAX
    // if ($request->ajax()) {
    //     $response = [
    //         'id' => $id,
    //         'detail' => $detail,
    //         'selectedUkurans' => $selectedUkurans,
    //     ];

    //     return response()->json($response);
    // }

    
        // $j_barang = Barang::where('id', 'BR002')
        //        ->get();

          
          //detailUkuran terhubung dengan model     
        // $j_barang = Barang::with('detailUkuran')->find('BR002');
        
        // $barang=Barang::all();
        // dd($barang);

        // $cek=Barang::count();
        // // dd($cek);
        // if($cek == 0){
        //     $urut = 10000001;
        //     $nomor = 'BR' . $urut;
        //     // dd($nomor);
        // }else{
        //     $ambil = Barang::all()->last();
        //     $urut = (int)substr($ambil->id, -8) + 1;
        //     $nomor='BR' . $urut;
        // }



        $barang=Barang::count();
        $kodeawal="BR";
        // $tahun = date("Y");
        if($barang == null){
            $nourut = "001"; 
        }else{
            $ambil = Barang::all()->last();
            $nourut = substr($ambil->id, 2) + 1;
      
            $nourut = str_pad($nourut, 3, "0", STR_PAD_LEFT);
        }

        $kodeid = $kodeawal . $nourut;
      
        
       if ($request->ajax()) {
        $response = [
            'idmodal' => $kodeid,
            'id' => $id,
            'detail' => $detail,
            'selectedUkurans' => $selectedUkurans,
        ];
        return response()->json($response);
         }

        // return response()->json([
        //     'kodeid' => $kodeid,
        //     'pesan' => 'Data Barang Telah Ditambahkan',
        // ]);
// , 'detail', 'selectedUkurans
        return view('tampilan.barang.barang', compact('j_pakaian', 'kodeid', 'j_ukuran', 'detail', 'selectedUkurans'));
    }


   public function api(Request $request)
    {
     
    $detail = Detailukuran::all(); 

        $barang = Barang::select('tbl_barang.id','tbl_barang.nama_produk','tbl_barang.id_pakaian','tbl_barang.harga','tbl_barang.stok','tbl_barang.gambar','tbl_barang.keterangan','b.id_barang','c.nama_jenis',
            \DB::raw('count(b.id_barang) as jumlah')
            )
                 ->leftjoin('tbl_pakaian as c','c.id_pakaian','=','tbl_barang.id_pakaian')
                 ->leftjoin('detailukuran as b','b.id_barang','=','tbl_barang.id')
                 ->groupBy('tbl_barang.id','tbl_barang.nama_produk','tbl_barang.id_pakaian','tbl_barang.harga','tbl_barang.stok','tbl_barang.gambar','tbl_barang.keterangan','b.id_barang','c.nama_jenis')
                 ->get();
    // $detail = Detailukuran::all();
     $datatables= datatables()->of($barang)
                                ->addColumn('format_total', function($barang){
                                    return format_harga($barang->harga);
                                })
                                ->addColumn('jumlah_ukuran', function($barang){
                                    return jumlah_ukuran($barang->jumlah);
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

         // dd($data);     
        try {
            \DB::beginTransaction();
       
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

            // Pengecekan ekstensi file yang diizinkan jika diperlukan
                $allowedExtensions = ['jpg', 'jpeg']; // Ganti sesuai kebutuhan
                $fileExtension = $file->getClientOriginalExtension();

            if (!in_array($fileExtension, $allowedExtensions)) {
                throw new \Exception('Tipe file tidak diizinkan.');
            }

            // Simpan file di dalam folder
                $nama_file = $file->getClientOriginalName();
                $tujuan_upload = 'data_file';
                
                if($file->move($tujuan_upload, $nama_file)){

                    // $data = Barang::create([
                    //     'id' => $request->id,
                    //     'nama_produk' => $request->nama_produk,
                    //     'id_pakaian' => $request->id_pakaian,
                    //     'harga' => $request->harga,
                    //     'stok' => $request->stok,
                    //     'gambar' => $nama_file,
                    //     'keterangan' => $request->keterangan
                    // ]);

                    $barang = new Barang;
                    $barang->id = $data['id'];
                    $barang->nama_produk = $data['nama_produk'];
                    $barang->id_pakaian = $data['id_pakaian'];
                    $barang->harga = $data['harga'];
                    $barang->stok = $data['stok'];
                    $barang->gambar = $nama_file;
                    $barang->keterangan = $data['keterangan'];
                    $barang->save();

                    $jmlh_ukuran = isset($data['id_ukuran']) ? count($data['id_ukuran']) : 0;
                    if ($jmlh_ukuran > 0) {
                        foreach ($data['id_ukuran'] as $ukuranId) {
                            $detailUkuran = new Detailukuran;
                            $detailUkuran->id_barang = $barang->id;
                            $detailUkuran->id_ukuran = $ukuranId;
                            $detailUkuran->save();
                        }
                    }

                }
        }
               

            // }

          
             \DB::commit();

        }   catch (\Throwable $exception){
            \DB::rollBack();

            // return redirect()->back()->with('error', $th->getMessage());
            return back()->withError($exception->getMessage())->withInput();
        }  

        
            return redirect('barang');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $barang=Barang::join('tbl_pakaian as c','c.id_pakaian','=','tbl_barang.id_pakaian')
        ->where('tbl_barang.id','=', $id)
        ->first();

        // $detail = Detailukuran::where('id_barang', $id)
        // ->get();
        $detail = Detailukuran::join('tbl_ukuran as b','b.id_ukuran','=','detailukuran.id_ukuran')
        ->where('detailukuran.id_barang', $id)
        ->get();
        // $barang=Barang::find($id);    
        return view('tampilan.barang.detail', compact('barang','detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
         return view('tampilan.barang.edit', compact('barang'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all(); 
           
        try {
            \DB::beginTransaction();

            $barang=Barang::find($id);

            
        if ($request->hasFile('gambar')) {
            $destination = 'data_file/' . $barang->gambar;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move('data_file/', $filename);

            $barang->update([
                'nama_produk' => $request->nama_produk,
                'id_pakaian' => $request->id_pakaian,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'gambar' => $filename,
                'keterangan' => $request->keterangan
            ]);
        } else {
            // Jika tidak ada gambar yang diunggah, update data tanpa mengubah gambar
            $barang->update([
                'nama_produk' => $request->nama_produk,
                'id_pakaian' => $request->id_pakaian,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'keterangan' => $request->keterangan
            ]);

        // Ambil pilihan ukuran yang sebelumnya dipilih
            $selectedUkuransBefore = $barang->detailukuran->pluck('id_ukuran')->toArray();

        // Cek perubahan pada pilihan ukuran
           if (isset($data['id_ukuran']) && $data['id_ukuran'] != $selectedUkuransBefore)  {

            $jmlh_ukuran = isset($data['id_ukuran']) ? count($data['id_ukuran']) : 0;
            if ($jmlh_ukuran > 0) {

                $d_ukuran=Detailukuran::whereid_barang($id);
                $d_ukuran->delete();

                foreach ($data['id_ukuran'] as $ukuranId) {
                    $detailUkuran = new Detailukuran;
                    $detailUkuran->id_barang = $barang->id;
                    $detailUkuran->id_ukuran = $ukuranId;
                    $detailUkuran->save();
                }
            }

            }



        }

            \DB::commit();

            } catch (\Throwable $exception){
                \DB::rollBack();
                // return redirect()->back()->with('error', $th->getMessage());
                return back()->withError($exception->getMessage())->withInput();
        } 

        

        return redirect('barang');

         

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  $BorrowDetails=BorrowDetail::select('*')
        // ->where('borrow_details.id_pinjam', $id);
        // $barang->delete();

// menghapus gambar yang ada di dalam folder penyimpanan
        $barang=Barang::find($id);
            $destination = 'data_file/' . $barang->gambar;
            if (File::exists($destination)) {
                File::delete($destination);
        }

        $barang=Barang::select('*')
            ->where('tbl_barang.id', $id);
        $barang->delete(); 
        $detail=Detailukuran::select('*')
            ->where('detailukuran.id_barang', $id);
        $detail->delete(); 


    }
}
