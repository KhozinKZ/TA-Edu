<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

                        // Simpan URL sebelumnya ke dalam session
$previousUrl = '/ukuran'; // Misalnya, URL sebelumnya
session()->put('previous_url', $previousUrl);
\Log::info('URL: ' . $previousUrl);

   
        return view('tampilan.master.ukuran.index');
    }


      public function api(Request $request)
    {
     
     $ukuran = Ukuran::all();

     $datatables= datatables()->of($ukuran)
                            ->addIndexColumn();


         return $datatables->make(true);  
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
      // Ukuran::create($request->all());

        $ukuran=Ukuran::count();
        $kodeawal="UK";
        // $tahun = date("Y");
        if($ukuran == null){
            $nourut = "001"; 
        }else{
            $ambil = Ukuran::all()->last();
            $nourut = substr($ambil->id_ukuran, 2) + 1;
      
            $nourut = str_pad($nourut, 3, "0", STR_PAD_LEFT);
        }

        $kodeid = $kodeawal . $nourut;

        $data = Ukuran::create([
                'id_ukuran' => $kodeid,
                'nama_ukuran' => $request->nama_ukuran
        ]);

      return redirect('ukuran');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function show(Ukuran $ukuran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function edit(Ukuran $ukuran)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ukuran $ukuran)
    {
      $ukuran->update($request->all());

      return redirect('ukuran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ukuran $ukuran)
    {
        $ukuran->delete();
    }
}
