@extends('layouts.admin')

@section('css')
<style type="text/css">
  table.table-bordered.dataTable thead tr:first-child th,table.table-bordered.dataTable thead tr:first-child td {
    text-align:center;
  }
  table.dataTable.dtr-inline.collapsed>tbody>tr>td.child, table.dataTable.dtr-inline.collapsed>tbody>tr>th.child, table.dataTable.dtr-inline.collapsed>tbody>tr>td.dataTables_empty {
 
    text-align: center;
  }


  [v-cloak] {
    display: none;
}
</style>

@endsection


@section('content')
<div id="controller" v-cloak>
<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">{{ auth()->user()->name}}</a></li>
                  <!-- <li class="active">Shopping Cart</li> -->
                </ol>
            </div>


        <div class="box-body">
          <div id="pesan" ></div>
          <div class="box " style="border-top-color: #ff8a00">
                <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th >No</th>
                  <th>Tanggal</th> 
                  <th>No.ID</th>
                  <th>Nama</th>
                  <th>Total Bayar</th>
                  <th>Status</th>
                  <th>Action</th>
                <!-- style="width:130px" -->
                </tr>
                </thead>
              </table>
        </div>  
        </div>
        </div>
  </section>

<!-- Modal -->
         <div class="modal fade" id="modal-default">
          <div class="modal-dialog  modal-lg">
            <div class="modal-content">
             
              <form :action="actionUrl" method="POST" @submit="submitForm($event, data.id_transaksi)" enctype="multipart/form-data">
              <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Pembayaran</h4>
                    </div>
                
              <div class="modal-body">
                @csrf
                <!-- {{ method_field('PUT') }} -->
                <div id="msg" ></div>

                  <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                 

                  <div class="data_transaksi">

                 
                <div class="row">
                  <div class="col-lg-12">
                  <p class="lead"></p>
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Produk</th>
                        <td>
                          <span class="produk"></span>
                          <span class="ukuran"></span>
                        </td>
                      </tr>
                      <tr>
                        <th>Jumlah</th>
                        <td>
                          <span class="jumlah"></span>
                        </td>
                      </tr>
                      <tr>
                        <th>Harga</th>
                        <td><span class="harga"></span></td>
                      </tr>
                      <tr>
                        <th>Total Bayar</th>
                        <td><span class="total"></span></td>
                      </tr>
                      <tr>
                        <th>No.Rekening</th>
                        <td><span>123-456-789</span></td>
                      </tr>
                      <tr>
                        <th>Pembayaran</th>
                        <td><span class="gambar"></span></td>
                      </tr>
                      
                    </table>
                  </div>
                  </div>
                </div>  

                 </div> 
                 @role('Pembeli')
                    <div class="form-group">
                      <label for="bayar">Pembayaran</label>
                      <input id="bayar" type="text" name="pembayaran" class="form-control" :value="data.pembayaran" readonly>
                    </div>
                    <div class="form-group">
                      <label for="file">Kirim Hasil Pembayaran </label>
                      <input id="file" type="file" name="file_bayar" class="form-control" required>
                    </div>
                @endrole          

              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                @role('Pembeli')
                <button type="submit" class="btn btn-success">Save changes</button>
                @endrole
              </div>
          </form>
            </div>
            <!-- /.modal-content -->
          </div>
                <!-- /.modal-dialog -->
         </div>


</div>

@endsection

@section('js')






<script type="text/javascript">
var actionUrl = '{{ url('bayar') }}';
var apiUrl = '{{ url('api/bayar') }}';

var columns = [
       {data: 'DT_RowIndex', class:'text-center', orderable: true},
       {data: 'tgl_pesanan', class:'text-center', orderable: true},
       {data: 'id_user', class:'text-center', orderable: false},
       {data: 'name', class:'text-center', orderable: false},
       {data: 'format_total', class:'text-center', orderable: true},
       {data: 'status', class:'text-center', orderable: true},
       {render:function (index, row, data, meta){
           return `
           
            <input type="hidden" value="${data.pembayaran}" class="barang_id" data-row="${meta.row}">
            <a href="javascript:void(0)" class="btn btn-warning btn-sm tool" onclick="controller.viewData(event, ${meta.row})">
                <span class="toolText-top">Pembayaran</span>
                <i class="fa fa-shopping-cart"></i> Pembayaran
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
          // editeror :false,
          // detailUrl: '/barang/detail/',
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
          
          viewData(event, row){
              event.preventDefault();
              var rowIndex = row; // Gunakan parameter row untuk mendapatkan indeks baris yang diklik
              var barangId = document.querySelector(`.barang_id[data-row="${rowIndex}"]`).value;
              // console.log("barangId:", barangId);
              
              $.ajax({
              type: 'POST',
              url: '{{ route('bayar.index') }}',
              data: {
                  _token: '{{ csrf_token() }}',
                  barang_id: barangId
              },
              success: function(response) {
                // console.log("Response:", response);
                  var keranjang = response.keranjang;
                  var transaksi = response.transaksi;

                // Ambil array nama produk
                var namaProdukArray = keranjang.map(function(item) {
                    return item.nama_produk + ' (' + item.nama_ukuran + ')';
                });

                var jumlahArray = keranjang.map(function(item) {
                     return item.jumlah + " unit";
                });

                // Ambil array ukuran
                var hargaArray = keranjang.map(function(item) {
                     // return item.harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }); output 
                //  return item.harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).replace(/\.?0+,-$/, '').replace(/,00$/, '');
                // });

                  return "Rp " + Math.floor(item.harga).toLocaleString('id-ID');
                  });

                var totalHargaArray = transaksi.map(function(item) {
                
                     return "Rp " + Math.floor(item.total_bayar).toLocaleString('id-ID');
                });

                var gambarArray = transaksi.map(function(item) {
                     // return item.file_bayar;
                      return '/transaksi/' + item.file_bayar; 
                });

                // Ubah array nama produk dan ukuran menjadi string dengan pemisah koma
                var namaProdukString = namaProdukArray.join(', ');
                var jumlahString = jumlahArray.join(', ');
                var hargaString = hargaArray.join(', ');
                var totalHargaString = totalHargaArray.join(', ');
                // var gambarString = gambarArray.join(', ');

                // Ubah nilai dari elemen <span> 
                document.querySelector('.produk').textContent = namaProdukString;
                document.querySelector('.jumlah').textContent = jumlahString;
                document.querySelector('.harga').textContent = hargaString;
                document.querySelector('.total').textContent = totalHargaString;
                // document.querySelector('.gambar').textContent = gambarString;
                var container = document.querySelector('.gambar');
                container.innerHTML = '';
                  gambarArray.forEach(function(gambarUrl) {
                     var a = document.createElement('a');
                      a.href = gambarUrl;
                      var img = document.createElement('img');
                      img.src = gambarUrl;
                      img.width = 100;
                      img.height = 100;


                      
         // Tambahkan logika untuk menampilkan pesan alternatif jika file gambar tidak ada
        img.onerror = function() {
            var pesan = document.createElement('p');
            pesan.textContent = "Proses pembayaran";
            container.appendChild(pesan);
            a.style.display = 'none'; // Sembunyikan anchor jika gambar tidak ada
        };


                      a.appendChild(img);
                      container.appendChild(a);

                      // Tambahkan fungsi Fancybox saat gambar diklik
                     a.addEventListener('click', function(e) {
                        e.preventDefault();
                        Fancybox.show([
                            {
                                src: gambarUrl,
                                type: 'image'
                            }
                        ], {
                            Image: {
                                zoom: true
                            }
                        });
                    });


                  });
            
              
              },
              error: function(error) {
                  console.log(error);
              }
          });


              this.data = this.datas[row];
              this.editStatus = true;


              $('#modal-default').modal();

          },

        submitForm(event, id){

              event.preventDefault();
              const _this = this;

              if (!_this.editStatus) {
                  // Mode tambah data
                  var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;
                  axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {

                  _this.table.ajax.reload();

                  if(actionUrl == this.actionUrl){            
                        Swal.fire({
                          title:'Berhasil',
                          text:'Silahkan Lakukan Pembayaran Di Transaksi',
                          icon:'success',
                          showConfirmButton: false
                         })

                        // Menutup pesan setelah 2 detik
                          setTimeout(() => {
                              Swal.close();
                          }, 2000);
                       
                  }else if(actionUrl == this.actionUrl+'/'+id){
                     
                      var pesan = $('<div>')
                        pesan.hide()
                        pesan.addClass('alert alert-success')
                        pesan.text("Data Keranjang Telah DiUpdate");

                        $('#msg').append(pesan) 
                        pesan.show('slow')

                        setTimeout(() => {
                            pesan.hide('slow')
                            pesan.remove('slow')
                        }, 2000)
                      

                     
                    }
                  });
                

              }else{
                   // Mode edit data

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
                       
                  }else if(actionUrl == this.actionUrl+'/'+id){
                     
                      var pesan = $('<div>')
                        pesan.hide()
                        pesan.addClass('alert alert-success')
                        pesan.text("Data Transaksi Telah Berhasil");

                        $('#pesan').append(pesan) 
                        pesan.show('slow')

                        setTimeout(() => {
                            pesan.hide('slow')
                            pesan.remove('slow')
                        }, 2000)
                  
                       // $('.data_transaksi').load("/data-transaksi");
              

                    }
                  });


              

              }
            
           },


        
          
      }
    });


</script>  



<script>
//   $(document).ready(function(){
//   $('.data_transaksi').load("/data-transaksi");
// });
</script>


<script src="{{asset('validation/validation.js')}}"></script>

@endsection