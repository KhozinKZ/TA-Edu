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
                  <th>Item</th>
                  <th>Nama Produk</th>
                  <th>Ukuran</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <!-- <th>Total</th> -->
                  @role('Pembeli')
                  <th>Action</th>
                  @endrole
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
             
              <form :action="actionUrl" method="POST" @submit="submitForm($event, data.id_keranjang)">
              <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Input Data Barang Penjualan</h4>
                    </div>
                
              <div class="modal-body">
                @csrf
                <!-- {{ method_field('PUT') }} -->
                <div id="msg" ></div>

                  <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                  
                    <input type="hidden" name="stok" class="" id="stok" :value="data.stok">
                    <!-- <input type="text" name="id_barang" class="" id="id" :value="data.id_barang"> -->
                    <div class="form-group">
                      <label for="tgl">Tanggal Pembelian</label>
                      <input id="tgl" type="text" name="tgl_pesanan" class="form-control" :value="data.tgl_pesanan" readonly>
                    </div>
                    <div class="form-group">
                      <label for="jumlah">Jumlah</label>
                      <input id="jumlah_edit" type="text" name="jumlah" class="form-control"  placeholder="Masukkan Jumlah Unit" oninput="validateInput(this)" autocomplete="off" autofocus  :value="data.jumlah">
                      <span class="text-danger" id="kerjumlah_err"> </span>
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

  <section id="do_action">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          
        </div>

        <div id="refresh"> 
        <div class="col-sm-6">
          <div class="total_area">
            <ul>
              <?php $total = 0; ?>
              @foreach($keranjang as $krj)
                <?php $total += ($krj->jumlah * $krj->harga) ?>
              @endforeach
              
              <li>
                Total <span>Rp.{{ number_format($total, 0, ',', '.') }}</span>
              </li>
              
            </ul>
    
           <form action="{{url('keranjang')}}" method="post">
            @csrf

            <input type="hidden" value="{{$kodeid}}" name="pembayaran">
          
            <input type="hidden" value="{{$total}}" name="total_bayar" id="total_bayar">    
           
          @role('Pembeli')
            <button type="submit" class="btn btn-default check_out">Check Out</button>
          @endrole  
            </form>

          </div>
        </div>
        </div>
      </div>
    </div>
  </section><!--/#do_action-->




</div>

@endsection

@section('js')






<script type="text/javascript">
var actionUrl = '{{ url('keranjang') }}';
var apiUrl = '{{ url('api/keranjang') }}';

var columns = [
       {data: 'DT_RowIndex', class:'text-center', orderable: true},
       {data: 'format_tgl', class:'text-center', orderable: false},
       {data: 'gambar', name:'gambar', class:'text-center',
                render: function(data, type, full, meta) {
                    return "<center><img class='img-responsive' style='height:50px; width:50px' src=\"/data_file/" + data + "\"/></center>";
                }
        },
       {data: 'nama_produk', class:'text-center', orderable: true},
       {data: 'nama_ukuran', class:'text-center', orderable: true,
         render: function(data, type, full, meta) {
          
        var id_barang = full.id_barang;
        var id_ukuran = full.id_ukuran;
        var options = '';
        
        // Loop through the ukuran options and only include options that match the id_barang
        @foreach($j_ukuran as $ukuran)
            if ("{{ $ukuran->id_barang }}" === id_barang) {
                options += '<option value="{{ $ukuran->id_ukuran }}"' + (id_ukuran === "{{ $ukuran->id_ukuran }}" ? ' selected' : '') + '>{{ $ukuran->nama_ukuran }}</option>';
            }
        @endforeach
@role('Pembeli')
          return '<select class="form-control" name="id_ukuran">' + options + '</select>';
@endrole          
          return '<select class="form-control" name="id_ukuran" disabled>' + options + '</select>';
            

            }
        },

       {data: 'format_harga_barang', class:'text-center', orderable: true},
       {data: 'jumlah', class:'text-center', orderable: true},
       // {data: 'hitung_total', class:'text-center', orderable: true},
      @role('Pembeli')
       {render:function (index, row, data, meta){
           return `
            <input type="hidden" value="${data.id_keranjang}" class="id_keranjang" data-row="${meta.row}">
            <input type="hidden" value="${data.id_ukuran}" class="id_ukuran" data-row="${meta.row}">
    
            <a href="javascript:void(0)" class="btn btn-warning btn-sm tool" onclick="controller.editData(event, ${meta.row})">
                <span class="toolText-top">Edit</span>
                <i class="fa fa-pencil-square-o"></i>
            </a>
            
              <a href="javascript:void(0)" class="btn btn-danger btn-sm tool" onclick="controller.deleteData(event, '${data.id_keranjang}', '${data.nama_produk}')">
              <span class="toolText-top">Delete</span>
                <i class="fa fa-trash-o"></i>
              </a>
         
              `;
          }, orderable: false, width: '200px', class: 'text-center'},
        @endrole    
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
          
          editData(event, row){
              event.preventDefault();
              this.data = this.datas[row];
              this.editStatus = true;


              $('#modal-default').modal();
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

                      $('#pesan').append(pesan)
                      pesan.show('slow')

                      setTimeout(() => {
                          pesan.hide('slow')
                          pesan.remove('slow')
                      }, 2000)

                         _this.table.ajax.reload();

                         var i = 0;
                          var interval=setInterval(function(){
                          $('#refresh').load(location.href + " #refresh");
                          if(i<2)clearInterval(interval);
                          i++;
                          }, 1000);


                    });
                }
            })

        },

        submitForm(event, id){

              event.preventDefault();
              const _this = this;

                   // Mode edit data
                if (!checkkerjumlah_edit()   ) {
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

                 var actionUrl = this.actionUrl+'/'+id;
                  axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {

                  $('#modal-default').modal('hide');
                  _this.table.ajax.reload();


               if(actionUrl == this.actionUrl+'/'+id){
                     
                      var pesan = $('<div>')
                        pesan.hide()
                        pesan.addClass('alert alert-success')
                        pesan.text("Data Keranjang Telah DiUpdate");

                        $('#pesan').append(pesan) 
                        pesan.show('slow')

                        setTimeout(() => {
                            pesan.hide('slow')
                            pesan.remove('slow')
                        }, 2000)
                  
                    var i = 0;
                    var interval = setInterval(function () {
                        $('#refresh').load(location.href + " #refresh");
                        if (i < 2) clearInterval(interval);
                        i++;
                    }, 1000);

                   
            

                    }
                  });


              }

              

            
            
           },


        // submitharga(event, id){

        //       event.preventDefault();
        //       const _this = this;

        //       var total = document.getElementById("total_bayar").value;

        //       if(total == 0){
        //         var pesan = $('<div>')
        //         pesan.hide()
        //         pesan.addClass('alert alert-danger')
        //         pesan.text("Tidak Ada Data DI Keranjang");

        //         $('#pesan').append(pesan)
        //         pesan.show('slow')

        //         setTimeout(() => {
        //             pesan.hide('slow')
        //             pesan.remove('slow')
        //         }, 2000)
        //       }else{

        //           // Mode tambah data
        //           var actionUrl = this.actionUrl ;
        //           axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {

        //           // _this.table.ajax.reload();
    

        //           if(actionUrl == this.actionUrl){            
                       
        //                 window.location.href = "{{ url('bayar')}}";
                   
                       
        //           }
        //           });
                

              

        //     }
            
        //    },   


        
          
      }
    });


</script>  
<script>
// Event listener untuk perubahan pada dropdown
$(document).on('change', 'select[name="id_ukuran"]', function() {
    // Simpan nilai sebelum perubahan
    var nilaiSebelum = $(this).closest('tr').find('.id_ukuran').val();
    // Simpan nilai saat ini dari dropdown
    var nilaiSaatIni = $(this).val();

    // Periksa apakah nilai telah berubah
    if (nilaiSaatIni !== nilaiSebelum) {
        // Tampilkan dialog konfirmasi
        var konfirmasi = confirm('Apakah Anda yakin ingin memperbarui data?');
        
        // Jika pengguna menekan "OK"
        if (konfirmasi) {
            var id_keranjang = $(this).closest('tr').find('.id_keranjang').val();
            var id_ukuran = nilaiSaatIni;

            // Kirim permintaan AJAX hanya jika pengguna menyetujui
            $.ajax({
                url: '{{ route('keranjang.simpan') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_keranjang: id_keranjang,
                    id_ukuran: id_ukuran
                },
                success: function(response) {
                    alert('Data berhasil diperbarui');
                    console.log('Data berhasil diperbarui');

                       // Perbarui nilai di tabel setelah mendapatkan respons sukses
                    var table = $('#datatables').DataTable();
                    table.ajax.reload();

                    
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan. Mohon coba lagi.');
                    console.error('Terjadi kesalahan:', error);
                }
            });
        } else {
            // Kembalikan nilai dropdown ke nilai sebelumnya
            $(this).val(nilaiSebelum);
            console.log('Pembaruan data dibatalkan.');
        }
    }
});
</script>





<script src="{{asset('validation/validation.js')}}"></script>

@endsection