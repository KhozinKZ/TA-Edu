@extends('layouts.admin')

@section('css')

@endsection


@section('content')

<div id="controller">
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
          <h3 class="box-title">Input Data Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
          <div class="box box-info">
         
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" enctype="multipart/form-data" action="{{url('barang')}}" method="POST" autocomplete="on">
                    @csrf

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
                    <div class="alert alert-success" id="msg">
                        <p>{{ $message }}</p>
                    </div>
                  @endif

                <div class="form-group">
                  <label for="produk" class="col-sm-2 control-label">Nama Produk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="produk" name="nama_produk" placeholder="Nama Produk"  value="{{ old('nama_produk') }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="harga" class="col-sm-2 control-label">Harga</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" value="{{ old('harga')}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="stok" class="col-sm-2 control-label">Stok Barang</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" value="{{ old('stok')}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="file" class="col-sm-2 control-label">file Barang</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="file" name="file" placeholder="file" value="{{ old('file')}}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="file" class="col-sm-2 control-label">Ukuran Tersedia</label>
                  <div class="col-sm-10">
                      <label for="info" class="btn btn-info">Info <input type="checkbox" id="info" class="badgebox"><span class="badge">&check;</span></label>
        <label for="success" class="btn btn-success">Success <input type="checkbox" id="success" class="badgebox"><span class="badge">&check;</span></label>
        <label for="warning" class="btn btn-warning">Warning <input type="checkbox" id="warning" class="badgebox"><span class="badge">&check;</span></label>
        <label for="danger" class="btn btn-danger">Danger <input type="checkbox" id="danger" class="badgebox"><span class="badge">&check;</span></label>
                  </div>
                </div>
             
      
              </div>
              <!-- /.box-body -->
             <div class="box-footer text-center">
               <button type="submit" class=" btn btn-success">
                
               Simpan</button>
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
    
</section> <!--/#cart_items-->   


<section>
<div class="container">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
          <div class="box box-success">
                <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th >No</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th>Foto</th>
                  <th>Action</th>
                <!-- style="width:130px" -->
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
       
        </div>
        <!-- /.box-footer-->
      </div>
      </div>
</section>
   
</div>
@endsection

@section('js')
<script>
    // setTimeout(function() {
    //  $('#msg').remove();
    // }, 3000); 


    // $(document).ready(function(){
    //       $("#msg").slideDown(300).delay(5000).slideUp(300);
    // });

  $(document).ready(function(){
          $("#msg").delay(3000).slideUp(1000);
    });
</script>



<script type="text/javascript">
var actionUrl = '{{ url('barang') }}';
var apiUrl = '{{ url('api/barang') }}';

// DT_RowIndex
var columns = [
       {data: 'DT_RowIndex', class:'text-center', orderable: true},
       {data: 'nama_produk', class:'text-center', orderable: false},
       {data: 'format_total', class:'text-center', orderable: true},
       {data: 'stok', class:'text-center', orderable: true},
       {data: 'gambar', name:'gambar', class:'text-center',
                render: function(data, type, full, meta) {
                    return "<center><img class='img-responsive img-circle ' style='height:50px; width:50px' src=\"/data_file/" + data + "\"/></center>";
                }
        },
       {data: 'action', name:'action'}
      
    ];

    var controller = new Vue({
      el:'#controller',
      data:{
          datas:[],
          data:{},
          actionUrl,
          apiUrl,
          editStatus : false
      },
      mounted: function(){
        this.datatable();
        
      },
      methods: {
        datatable() {
            const _this = this;
            _this.table = $('#datatables').DataTable({
              responsive: true,
              autoWidth: false,
              processing : true,
              serverSide: true,
              // scrollX: true,
                 ajax:{
                       url: _this.apiUrl,
                       type:'GET',
                      },
                      columns
                }).on('xhr', function () {
                   _this.datas = _this.table.ajax.json().data;
                      });
          },
       
         
         
      }
    });

</script>    
@endsection