@extends('layouts.admin')

@section('css')

<style type="text/css">
.pre-line {
    white-space: pre-line;
}

.funkyradio div {
  display: inline-block;
}

.funkyradio label {
  width: auto;
  padding-right:10px;
  border-radius: 3px;
  border: 1px solid #D1D3D4;
  font-weight: 900;
}

.funkyradio input[type="checkbox"]:empty {
  display: none;
}

.funkyradio input[type="checkbox"]:empty ~ label {
  position: relative;
  line-height: 2.5em;
  text-indent: 3.25em;
  margin-top: 2em;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.funkyradio input[type="checkbox"]:empty ~ label:before {
  position: absolute;
  display: block;
  top: 0;
  bottom: 0;
  left: 0;
  content: '';
  width: 2.5em;
  background: #D1D3D4;
  border-radius: 3px 0 0 3px;
}

.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
  color: #888;
}

.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #C2C2C2;
}

.funkyradio input[type="checkbox"]:checked ~ label {
  color: #777;
}

.funkyradio input[type="checkbox"]:checked ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #333;
  background-color: #ccc;
}

.funkyradio input[type="checkbox"]:focus ~ label:before {
  box-shadow: 0 0 0 3px #999;
}

.funkyradio-default input[type="checkbox"]:checked ~ label:before {
  color: #333;
  background-color: #ccc;
}

.funkyradio-primary input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #337ab7;
}

.funkyradio-success input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5cb85c;
}

.funkyradio-danger input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #d9534f;
}

.funkyradio-warning input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #f0ad4e;
}

.funkyradio-info input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5bc0de;
}


</style>
@endsection


@section('content')
    <section>
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">{{ auth()->user()->name}}</a></li>
                  <!-- <li class="active">Shopping Cart</li> -->
                    <a href="{{ url('barang')}}" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                </ol>
            </div>
        
            <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Data Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
          <div class="box box-danger " style="padding:20px;">          
          
          <div class="row ">
            <div class="col-md-3 col-md-9">
              <div class="thumbnail">
                <img class="img-rounded text-center" src="{{url('/data_file/'.$barang->gambar)}}" alt="" title="">
                <!-- <div class="caption"> -->
                  <!-- <h3 class="text-center"></h3>
                  <p>...</p> -->   
                <!-- </div> -->
              </div>
            </div>
            <div class="col-md-9 col-md-9">
              <ul class="list-group">
                <li class="list-group-item"><h4>Nama Produk : {{$barang->nama_produk}}</h4></li>
                <li class="list-group-item"><h3 class="text-danger">Harga : {{ format_harga($barang->harga) }}</h3></li>
                <li class="list-group-item"><h4>Jenis Pakaian : {{$barang->nama_jenis}}</h4></li>
                <li class="list-group-item"><h4>Stok Barang : {{$barang->stok}}</h4></li>
                <li class="list-group-item">
                  <h4>Tersedia Ukuran : </h4>
                  
                <div class="funkyradio form-inline">
               @foreach($detail as $data)
                  <div class="funkyradio-success">
                      <input type="checkbox" name="checkbox" id="checkbox3" checked disabled />
                      <label for="checkbox3">{{$data->nama_ukuran}}</label>
                  </div>
               @endforeach 
                </div>
                </li>
              </ul>
            </div>  
          </div>
           <div class="row ">
           
            <div class="col-md-12 col-md-12">
              <ul class="list-group">
                <li class="list-group-item"><h4 class="">Deskripsi Produk</h4>
                 <div class="pre-line">
                    {{ $barang->keterangan }}
                </div>   
                </li>
           
              </ul>
            </div>  
          </div>
          



          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer bg-orange">
       
        </div>
        <!-- /.box-footer-->
      </div> 
        </div>
    </section> <!--/#cart_items-->   

    <section class="container">
        
    </section>  

@endsection
