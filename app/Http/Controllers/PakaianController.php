<?php

namespace App\Http\Controllers;

use App\Models\Pakaian;
use Illuminate\Http\Request;

class PakaianController extends Controller
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
$previousUrl = '/pakaian'; // Misalnya, URL sebelumnya
session()->put('previous_url', $previousUrl);
\Log::info('URL: ' . $previousUrl);


        $pakaian=Pakaian::count();
        $kodeawal="PK";
        // $tahun = date("Y");
        if($pakaian == null){
            $nourut = "001"; 
        }else{
            $ambil = Pakaian::all()->last();
            $nourut = substr($ambil->id_pakaian, 2) + 1;
      
            $nourut = str_pad($nourut, 3, "0", STR_PAD_LEFT);
        }

        $kodeid = $kodeawal . $nourut;



        return view('tampilan.master.jenis.index', compact('kodeid'));
    }


      public function api(Request $request)
    {
     
     $pakaian = Pakaian::select('*')
                ->orderBy('nama_jenis','asc')
                ->get();
     $datatables= datatables()->of($pakaian)
                            ->addColumn('action', function($pakaian){
                                return view('tampilan.master.jenis.action', [
                                    'pakaian' => $pakaian,
                                    'edit_url' => route('pakaian.edit', $pakaian->id_pakaian),
                                    'destroy' =>  route('pakaian.destroy', $pakaian->id_pakaian)
                                ]);  
                            })      
                            ->rawColumns(['action'])
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
        // return $request;


        $request->validate([
            'nama_jenis' => 'required',
        ], [
            'nama_jenis.required' => 'Nama Pakaian Tidak boleh Kosong',
        ]);

            $data = Pakaian::create([
                'id_pakaian' => $request->id_pakaian,  
                'nama_jenis' => $request->nama_jenis,
              
            ]);
        
            return redirect('pakaian')->with('success','Data Jenis Berhasil Di Tambahkan');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pakaian  $pakaian
     * @return \Illuminate\Http\Response
     */
    public function show(Pakaian $pakaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pakaian  $pakaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pakaian $pakaian)
    {
        return view('tampilan.master.jenis.edit', compact('pakaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pakaian  $pakaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pakaian $pakaian)
    {
          
        $messages = [
           'required' => ':attribute wajib diisi',
        ];

        $this->validate($request,[
                 'nama_jenis' => 'required'  
        ],$messages);

        $pakaian->update($request->all());
        
        return redirect('pakaian')->with('success','Data Jenis Berhasil Di Ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pakaian  $pakaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pakaian $pakaian)
    {
        $pakaian->delete();
       return redirect('pakaian');
    }
}
