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
          <h3 class="box-title">Input Ukuran</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></bu tton>
          </div>
        </div>

        <div class="box-body">
          <div class="box box-info">
         
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" :action="actionUrl"  method="POST" autocomplete="on" @submit="submitForm($event, data.id_ukuran)" >
                @csrf
              <div class="box-body p-2">
                 
                  <div ></div>
                  
                 <div id="msg"></div>
          
                 <input type="hidden" name="_method" value="PUT" v-if="editStatus">
               
               <div id="refresh"> 
                <div class="form-group">
                  <label for="ukuran" class="col-sm-2 control-label">Ukuran Pakaian</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="ukuran" name="nama_ukuran" placeholder="Nama Ukuran" :value="data.nama_ukuran">
                  </div>
                </div>
                </div>
                
              </div>
              <!-- /.box-body -->
             <div class="box-footer text-center">
               <button type="submit" class="btn btn-success" v-if="editSave"><i class="fa fa-plus"></i> Simpan</button>
               <div id="update" style="display:none">
               <button type="submit" class="btn btn-success" v-if="editStatus"><i class="fa fa-save"></i> Update</button>
               </div>
               <div id="back" style="display:none">
                <a href="#" class="btn btn-danger" @click="backData()"  v-if="editStatus"><i class="fa fa-reply"></i> Kembali</a>
               </div>
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
          <h3 class="box-title">Data Ukuran</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
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
              <tr >
                  <th>No</th>
                  <th>Ukuran</th>
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



<script type="text/javascript">
var actionUrl = '{{ url('ukuran') }}';
var apiUrl = '{{ url('api/ukuran') }}';

function formatId(id) {
  // mengonversi angka menjadi string
  return `${id.toString().padStart(3, '0')}`;
}



// DT_RowIndex
var columns = [
       {data: 'DT_RowIndex', class:'text-center', orderable: true},
       {data: 'nama_ukuran', class:'text-center', orderable: true},
      {render:function (index, row, data, meta){
           return `
           <div>
              <a href="#" class="btn btn-warning btn-sm tool" onclick="controller.editData(event, ${meta.row})">
              <span class="toolText-top">Edit</span>
                <i class="fa fa-pencil-square-o"></i>
              </a>
              <a href="#" class="btn btn-danger btn-sm tool" onclick="controller.deleteData(event, '${formatId(data.id_ukuran)}', '${data.nama_ukuran}')">
              <span class="toolText-top">Delete</span>
                <i class="fa fa-trash-o"></i>
              </a>
           </div>
              `;
          }, orderable: false, width: '200px', class: 'text-center'},
      
    ];

    var controller = new Vue({
      el:'#controller',
      data:{
          datas:[],
          data:{},
          actionUrl,
          apiUrl,
          editStatus : false,
          editSave : true,
      },
      mounted: function(){
        this.datatable();
        
      },
      methods: {
        datatable() {
            const _this = this;
            _this.table = $('#datatables').DataTable({
              columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
              }],
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
        editData(event, row){
              // console.log(this.datas);
              this.data = this.datas[row];
              this.editStatus = true;
              this.editSave = false;

              var x = document.getElementById("update");
              if (x.style.display === "none") {
                 x.style.display = "inline-block";
              }

              var y = document.getElementById("back");
              if (y.style.display === "none") {
                 y.style.display = "inline-block";
              }
              // $('#modal-default').modal();
        },
        backData(event, row){
              document.getElementById("ukuran").value = "";
              this.data = this.editStatus = false;
              this.data = this.editSave = true;
             

        },  
        deleteData(event, id, nama){
          // var ukuranid = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "Anda Ingin Menghapus Data "+nama+" ",
                icon: 'warning',

                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                     $(event.target).parents('tr').remove();
                     axios.post(this.actionUrl+'/'+id, {_method: 'DELETE'}).then(response =>{
                         
                      document.getElementById("ukuran").value = "";
                      this.data = this.editStatus = false;
                      this.data = this.editSave = true;

                      var pesan = $('<div>')
                      pesan.hide()
                      pesan.addClass('alert alert-success')
                      pesan.text("Data Berhasil Di Hapus");

                      $('#msg').append(pesan)
                      pesan.show('slow')

                      setTimeout(() => {
                          pesan.hide('slow')
                          pesan.remove('slow')
                      }, 2000)

                         _this.table.ajax.reload();

                    

                    });
                }
            })

        },
        submitForm(event, id){
              event.preventDefault();
              const _this = this;

              var nama = document.getElementById("ukuran").value;
              

              if (nama!="") {

              var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;  
              axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {

              _this.table.ajax.reload();
                
                if(actionUrl == this.actionUrl){            
                    var pesan = $('<div>')
                    pesan.hide()
                    pesan.addClass('alert alert-success')
                    pesan.text("Data Ukuran Telah Ditambahkan");

                    $('#msg').append(pesan)
                    pesan.show('slow')

                    setTimeout(() => {
                        pesan.hide('slow')
                        pesan.remove('slow')
                    }, 2000)

                     document.getElementById("ukuran").value = "";
                  }
                else if(actionUrl == this.actionUrl+'/'+id){
                 

                  var pesan = $('<div>')
                    pesan.hide()
                    pesan.addClass('alert alert-success')
                    pesan.text("Data Ukuran Telah DiUpdate");

                    $('#msg').append(pesan)
                    pesan.show('slow')

                    setTimeout(() => {
                        pesan.hide('slow')
                        pesan.remove('slow')
                    }, 2000)

                    
                    this.data = this.editStatus = false;
                    this.data = this.editSave = true;
                    document.getElementById("ukuran").value = "";
                   
                }  
              });
              

              }else{

                var pesan = $('<div>')
                pesan.hide()
                pesan.addClass('alert alert-danger')
                pesan.text("Harap Isi Form");

                $('#msg').append(pesan)
                pesan.show('slow')

                setTimeout(() => {
                    pesan.hide('slow')
                    pesan.remove('slow')
                }, 2000)

              }
           
           },  
      }
    });

</script>    
@endsection