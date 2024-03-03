@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">{{ auth()->user()->name}}</a></li>
                  <!-- <li class="active">Shopping Cart</li> -->
                </ol>
            </div>
        
            <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
          <div class="box box-info">
         
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{url('barang/'.$barang->id)}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
              <div class="box-body p-2">
                 @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                  @endif
                <div class="form-group">
                  <label for="produk" class="col-sm-2 control-label">Nama Produk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="produk" name="nama_produk" placeholder="Nama Produk"  value="{{$barang->nama_produk}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="harga" class="col-sm-2 control-label">Harga</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" value="{{$barang->harga}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="stok" class="col-sm-2 control-label">Stok Barang</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" value="{{$barang->stok}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="file" class="col-sm-2 control-label">file Barang</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="file" name="file" placeholder="file" value="{{ old('file')}}">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
             <div class="box-footer text-center">
               <button type="submit" class="btn btn-success">Simpan</button>
            </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
       
        </div>
        <!-- /.box-footer-->
      </div> 
        </div>
    </section> <!--/#cart_items-->   

    <section class="container">
        
    </section>  

@endsection
