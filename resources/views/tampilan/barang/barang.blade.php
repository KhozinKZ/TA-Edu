@extends('layouts.admin')

@section('css')

<style type="text/css">
  table.table-bordered.dataTable thead tr:first-child th,table.table-bordered.dataTable thead tr:first-child td {
    text-align:center;
  }
  table.dataTable.dtr-inline.collapsed>tbody>tr>td.child, table.dataTable.dtr-inline.collapsed>tbody>tr>th.child, table.dataTable.dtr-inline.collapsed>tbody>tr>td.dataTables_empty {
 
    text-align: center;
  }
</style>
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
        

          <a href="#" @click="addData()" style="margin-top: -50px; border-radius: 10px;" class="btn btn-sm btn-success">Tambah Data Barang Penjualan</a>
</section>

      

<section>
<div class="container">
    <div class="box">
      <div id="msg" ></div>
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
<p id="displayId"></p>
        <div class="box-body">
          <div class="box box-success">
                <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th >No</th>
                  <th style="width:200px">Nama Produk</th>
                  <th>Harga</th>
                  <th>Jenis</th>
                  <th>Stok</th>
                  <th>Tersedia</th>
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
      <div class="modal fade" id="modal-default">
          <div class="modal-dialog  modal-lg">
            <div class="modal-content">
             
              <form :action="actionUrl" method="POST" @submit="submitForm($event, data.id)"  enctype="multipart/form-data">
              <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Input Data Barang Penjualan</h4>
                    </div>
                
              <div class="modal-body">
                @csrf
                  <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                    
                    <div id="refresh">
                    <input type="hidden" name="id" class="id_barang"  id="id_barang" value="{{$kodeid}}">
                    </div>
                    <div class="form-group">
                      <label for="produk">Produk</label>
                      <input id="produk" type="text" name="nama_produk" class="form-control"  placeholder="Masukkan Nama Produk" autofocus :value="data.nama_produk">
                      <span class="text-danger" id="produk_err"> </span>
                    </div>
                     <div class="form-group">
                        <label>Jenis Pakaian</label>
                        <select class="form-control " name="id_pakaian" id="pakaian">
                          <option value="">-- Pilih Jenis Pakaian --</option>
                          @foreach($j_pakaian as $pakaian)
                            <option :selected="data.id_pakaian == '{{ $pakaian->id_pakaian }}'" value="{{ $pakaian->id_pakaian }}">{{ $pakaian->nama_jenis }}
                            </option>
                          @endforeach
                        </select>
                        <span class="text-danger" id="pakaian_err"> </span>
                      </div>
                     <div class="form-group">
                      <label for="harga">Harga</label>
                      <input id="harga" type="text" name="harga" class="form-control"  placeholder="Masukkan Nilai Harga" autofocus :value="data.harga">
                      <span class="text-danger" id="harga_err"> </span>
                    </div>
                     <div class="form-group">
                      <label for="stok">Stok</label>
                      <input id="stok" type="text" name="stok" class="form-control"  placeholder="Masukkan Stok Jumlah Barang"  autofocus :value="data.stok">
                      <span class="text-danger" id="stok_err"> </span>
                    </div>
                    <div class="form-group">
                        <label>Ukuran Tersedia</label>
                        <select class="form-control multiin" name="id_ukuran[]" id="ukuran" multiple="multiple">
                            @foreach($j_ukuran as $ukuran)
                                <option value="{{ $ukuran->id_ukuran }}" {{ in_array($ukuran->id_ukuran, $selectedUkurans) ? 'selected' : '' }}>
                                    {{ $ukuran->nama_ukuran }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="ukuran_err"> </span>
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea class="form-control " name="keterangan" id="keterangan" rows="10" placeholder="Masukkan Keterangan Barang" autofocus :value="data.keterangan"></textarea>
                      <span class="text-danger" id="keterangan_err"></span>
                    </div>
                    <div class="form-group">
                      <label for="file">Foto Barang</label>
                      <input id="file" type="file" name="gambar" class="form-control">
                      <span class="text-danger" id="file_err" v-if="editeror"> </span>
                    </div>

              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save changes</button>
              </div>
               </form>
            </div>
            <!-- /.modal-content -->
          </div>
                <!-- /.modal-dialog -->
      </div>
</section>
   <!-- Saat Anda menekan tombol dengan href="#", itu dapat menyebabkan halaman untuk kembali ke atas karena hash # biasanya diinterpretasikan sebagai anchor ke elemen dengan id yang sama. Ini umumnya dianggap sebagai praktek yang buruk, terutama jika tidak ada elemen dengan id yang sesuai. -->
   <!-- Menggunakan href="javascript:void(0)": Ganti href="#" dengan href="javascript:void(0)". Ini akan menghindari pemrosesan hash oleh browser. -->
</div>
@endsection

@section('js')
<script>
  $(document).ready(function(){
    $('.multiin').multipleSelect({
      placeholder: "Pilih Jenis Ukuran",
      filter:true,
    });
  });

  // $('.multiinput').multipleSelect('setSelects', ['UK001', 'UK002']);
</script>


<script type="text/javascript">
var actionUrl = '{{ url('barang') }}';
var apiUrl = '{{ url('api/barang') }}';

function formatId(id) {
  // mengonversi angka menjadi string
  return `${id.toString().padStart(3, '0')}`;
}


var columns = [
       {data: 'DT_RowIndex', class:'text-center', orderable: true},
       {data: 'nama_produk', class:'text-center', orderable: false},
       {data: 'format_total', class:'text-center', orderable: true},
       {data: 'nama_jenis', class:'text-center', orderable: true},
       {data: 'stok', class:'text-center', orderable: true},
       {data: 'jumlah_ukuran', class:'text-center', orderable: true},
       {data: 'gambar', name:'gambar', class:'text-center',
                render: function(data, type, full, meta) {
                    return "<center><img class='img-responsive img-circle ' style='height:50px; width:50px' src=\"/data_file/" + data + "\"/></center>";
                }
        },
        {render:function (index, row, data, meta){
           return `
           
            <input type="hidden" value="${data.id_barang}" class="barang_id" data-row="${meta.row}">
            <a href="javascript:void(0)" class="btn btn-blue btn-sm tool" onclick="controller.viewData(event, ${meta.row})">
                <span class="toolText-top">Detail</span>
                <i class="fa fa-eye"></i>
            </a>

            <a href="#" class="btn btn-warning btn-sm tool" onclick="controller.editData(event, ${meta.row})">
                <span class="toolText-top">Edit</span>
                <i class="fa fa-pencil-square-o"></i>
            </a>
            
              <a href="javascript:void(0)" class="btn btn-danger btn-sm tool" onclick="controller.deleteData(event, '${formatId(data.id)}', '${data.nama_produk}')">
              <span class="toolText-top">Delete</span>
                <i class="fa fa-trash-o"></i>
              </a>
           
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
          editeror :false,
          detailUrl: '/barang/detail/',
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
                "targets": "_all",

              }],
              responsive: true,
              autoWidth: false,
              processing : true,
              serverSide: true,
                 ajax:{
                       url: _this.apiUrl,
                       type:'GET',
                      },
                      columns
                }).on('xhr', function () {
                   _this.datas = _this.table.ajax.json().data;
                      });
          },
          addData(){
              var barangIdmodal = document.querySelector(`.id_barang`).value;
              console.log("barangIdModal:", barangIdmodal);  

              $.ajax({
              type: 'POST',
              url: '{{ route('barang.index') }}',
              data: {
                  _token: '{{ csrf_token() }}',
                  id_barang: barangIdmodal
              },
              success: function(response) {
                // console.log("Response:", response);

             var newIdModal = response.idmodal;
             console.log("Nilai $id baru:", newIdModal);

                // Mengubah nilai input id_barang
                var inputElement = document.getElementById("id_barang");
                inputElement.value = newIdModal;

              },

            
          });
              $('#produk_err').html('');
              $('#pakaian_err').html('');
              $('#harga_err').html('');
              $('#stok_err').html('');
              $('#keterangan_err').html('');
              $('#ukuran').multipleSelect('setSelects', []);
              document.getElementById('ukuran_err').innerText = '';
              $('#file_err').html('');

              this.data = {};
              this.editStatus = false;
              this.editeror = true;
              $('#modal-default').modal();

          },
          editData(event, row){
              $('#produk_err').html('');
              $('#pakaian_err').html('');
              $('#harga_err').html('');
              $('#stok_err').html('');
              $('#keterangan_err').html('');
              $('#ukuran').multipleSelect('setSelects', []);
              document.getElementById('ukuran_err').innerText = '';
              $('#file_err').html('');

             event.preventDefault();
              var rowIndex = row; // Gunakan parameter row untuk mendapatkan indeks baris yang diklik
              var barangId = document.querySelector(`.barang_id[data-row="${rowIndex}"]`).value;
              console.log("barangId:", barangId);

              $.ajax({
              type: 'POST',
              url: '{{ route('barang.index') }}',
              data: {
                  _token: '{{ csrf_token() }}',
                  barang_id: barangId
              },
              success: function(response) {
                // console.log("Response:", response);

             var newId = response.id;
             console.log("Nilai $id baru:", newId);

             // Tambahkan logging untuk memeriksa nilai newId setelahnya
             console.log("Setelahnya, Nilai $id baru:", newId);

              var selectedUkurans = response.selectedUkurans;

              $('.multiin').val(selectedUkurans).multipleSelect('refresh');
              },
              error: function(error) {
                  console.log(error);
              }
          });

              this.data = this.datas[row];
              this.editStatus = true;
              this.editeror = false;
             
              $('#modal-default').modal();

          },
          viewData(event, row){
            const _this = this;
            const id_barang = _this.datas[row].id_barang; // Ambil ID barang dari data yang diklik

            // Navigasi ke halaman detail dengan membawa ID barang
            window.location.href = _this.detailUrl + id_barang;
          },
          deleteData(event, id, nama){
            var _this = this;

            Swal.fire({
                title: 'Are you sure?',
                text: "Anda Ingin Menghapus Data "+nama+"  ",
                icon: 'warning',

                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                     $(event.target).parents('tr').remove();
                     axios.post(this.actionUrl+'/'+id, {_method: 'DELETE'}).then(response =>{
                      
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

              if (!_this.editStatus) {
                  // Mode tambah data
                if (!checkproduk() && !checkpakaian() && !checkharga() && !checkstok()  
                && !checkukuran() && !checkfile() && !checkket()   ) {
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

                }else if(!checkproduk()  ||  !checkpakaian() || !checkharga() ||  !checkstok() || !checkukuran()  || !checkfile() || !checkket() ){
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

                }else{
                  var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;
                  axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {

                  $('#modal-default').modal('hide');
                  _this.table.ajax.reload();

                  if(actionUrl == this.actionUrl){            
                        var pesan = $('<div>')
                        pesan.hide()
                        pesan.addClass('alert alert-success')
                        pesan.text("Data Barang Telah Ditambahkan");

                        $('#msg').append(pesan)
                        pesan.show('slow')

                        setTimeout(() => {
                            pesan.hide('slow')
                            pesan.remove('slow')
                        }, 2000)


                      document.getElementById("pakaian").value = "";
                      $('#ukuran').multipleSelect('setSelects', []);
                       document.getElementById('ukuran_err').innerText = '';
                      document.getElementById("keterangan").value = "";
                      document.getElementById("file").value = "";
                       
                  }else if(actionUrl == this.actionUrl+'/'+id){
                     
                      var pesan = $('<div>')
                        pesan.hide()
                        pesan.addClass('alert alert-success')
                        pesan.text("Data Barang Telah DiUpdate");

                        $('#msg').append(pesan) 
                        pesan.show('slow')

                        setTimeout(() => {
                            pesan.hide('slow')
                            pesan.remove('slow')
                        }, 2000)
                       
                      // document.getElementById("pakaian").value = "";
                      document.getElementById("file").value = "";
                    }
                  });
                }

              }else{
                   // Mode edit data
                if (!checkproduk()&& !checkpakaian() && !checkharga() && !checkstok()  
                && !checkukuran() && !checkket()   ) {
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

                }else if(!checkproduk()  ||  !checkpakaian() || !checkharga() ||  !checkstok() || !checkukuran()  || !checkket() ){
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

              }else{
                 var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;
                  axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {

                  $('#modal-default').modal('hide');
                  _this.table.ajax.reload();

                  if(actionUrl == this.actionUrl){            
                        var pesan = $('<div>')
                        pesan.hide()
                        pesan.addClass('alert alert-success')
                        pesan.text("Data Barang Telah Ditambahkan");

                        $('#msg').append(pesan)
                        pesan.show('slow')

                        setTimeout(() => {
                            pesan.hide('slow')
                            pesan.remove('slow')
                        }, 2000)

                         

                      document.getElementById("pakaian").value = "";
                      $('#ukuran').multipleSelect('setSelects', []);
                       document.getElementById('ukuran_err').innerText = '';
                      document.getElementById("keterangan").value = "";
                      document.getElementById("file").value = "";
                       
                  }else if(actionUrl == this.actionUrl+'/'+id){
                     
                      var pesan = $('<div>')
                        pesan.hide()
                        pesan.addClass('alert alert-success')
                        pesan.text("Data Barang Telah DiUpdate");

                        $('#msg').append(pesan) 
                        pesan.show('slow')

                        setTimeout(() => {
                            pesan.hide('slow')
                            pesan.remove('slow')
                        }, 2000)
                       
                      // document.getElementById("pakaian").value = "";
                      document.getElementById("file").value = "";
                    }
                  });


              }

              }




            





            
           },
          



      }
    });

</script>

<script src="{{asset('validation/validation.js')}}"></script>
@endsection