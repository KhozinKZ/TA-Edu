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
        
    <div class="row">
      <div class="col-md-6">
           <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Jenis Pakaian</h3>

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
            <form class="form-horizontal" action="{{url('pakaian/'.$pakaian->id_pakaian)}}" method="POST" autocomplete="on">
                @csrf
                {{ method_field('PUT') }}

              <div class="box-body p-2">
                 @if (count($errors) > 0)
                  <div class="alert alert-danger" >
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
                  <div ></div>
                <div class="form-group">
                  <label for="jenis" class="col-sm-2 control-label">Jenis Pakaian</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="jenis" name="nama_jenis" placeholder="Nama Jenis Pakaian"  value="{{$pakaian->nama_jenis}}">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
             <div class="box-footer text-center">
               <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Update</button>
               <a href="{{ url('pakaian')}}" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
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
      <div class="col-md-6">
          <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Jenis Pakaian</h3>

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
                  <th>Jenis Pakaian</th>
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
      </div>
    </div>


   
    
</section> <!--/#cart_items-->   


<section>
<div class="container">
  
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
var actionUrl = '{{ url('pakaian') }}';
var apiUrl = '{{ url('api/pakaian') }}';

// DT_RowIndex
var columns = [
       {data: 'DT_RowIndex', class:'text-center', orderable: true},
       {data: 'nama_jenis', class:'text-center', orderable: true},
       {data: 'action', name:'action'}
      
    ];

    var controller = new Vue({
      el:'#controller',
      data:{
          datas:[],
          data:{},
          actionUrl,
          apiUrl,
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