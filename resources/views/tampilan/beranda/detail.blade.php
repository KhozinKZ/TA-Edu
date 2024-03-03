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
<div id="controller">
   <section>
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">{{ auth()->user()->name}}</a></li>
                
                      <a href="{{ url('beranda')}}" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
               
                  <!-- <li class="active">Shopping Cart</li> -->
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
                <li class="list-group-item">
                  <div id="refresh">
                  <h4>Stok Barang : {{$barang->stok}}</h4>
                  </div>
                </li>
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
        
          <div class="text-center">
        @role('Pembeli')
          <a href="javascript:void(0)" @click="addData()" class="btn btn-orange"><i class="fa fa-shopping-cart"></i> Tambah Keranjang</a>
        @endrole
          <a href="{{ url('beranda')}}" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
          </div>
        
          <!-- Modal -->
         <div class="modal fade" id="modal-default">
          <div class="modal-dialog  modal-lg">
            <div class="modal-content">
             
              <form :action="actionUrl" method="POST" @submit="submitForm($event, data.id)">
              <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Input Data Barang Penjualan</h4>
                    </div>
                
              <div class="modal-body">
                @csrf
                <div id="msg" ></div>
                  <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                    <input type="hidden" name="id_barang" class="id_barang"  id="id_barang" value="{{$barang->id}}">
                    <div class="form-group">
                      <label for="tgl">Tanggal Pembelian</label>
                      <input id="tgl" type="text" name="tgl_pesanan" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                    </div>
                    <div class="form-group">
                      <label for="jumlah">Jumlah</label>
                      <input id="jumlah" type="text" name="jumlah" class="form-control"  placeholder="Masukkan Jumlah Unit" oninput="validateInput(this)" autocomplete="off" >
                      <span class="text-danger" id="kerjumlah_err"> </span>
                    </div>

                    <div class="form-group">
                        <label for="kerukuran">Pilih Ukuran</label>
                        <select class="form-control" name="id_ukuran" id="kerukuran">
                          <option value="">---Pilih Ukuran----</option>
                          @foreach($detail as $data)
                            <option value="{{ $data->id_ukuran }}">
                                    {{ $data->nama_ukuran }}
                                </option>
                          @endforeach
                        </select>
                        <span class="text-danger" id="kerukuran_err"> </span>
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
</div>
@endsection

@section('js')
<script>
 // $('#jumlah').on('input', function() {
 //        // Mendapatkan nilai jumlah dari input
 //        var jumlah = parseInt($(this).val());
 //        // Mendapatkan nilai stok dari PHP
 //        var stok = parseInt("{{ $barang->stok }}");

 //        console.log('Nilai jumlah:', jumlah);
 //        console.log('Nilai stok:', stok);

 //        // Memeriksa apakah jumlah yang dimasukkan melebihi stok
 //        if (jumlah > stok) {
 //            alert('Jumlah melebihi stok yang tersedia');
 //        }
 //    });



// var stok = "{{ $barang->stok }}"; // Mendapatkan nilai stok dari PHP
//     console.log('Stok barang:', stok);


// document.getElementById('jumlah').addEventListener('input', function() {
//     var jumlah = parseInt(this.value); // Mendapatkan nilai jumlah dari input
//     var stok = "{{ $barang->stok }}"; // Mendapatkan nilai stok dari PHP

//     console.log('Nilai jumlah:', jumlah);
//     console.log('Nilai stok:', stok);

// if (jumlah > stok) {
//         alert('Jumlah melebihi stok yang tersedia');
//     }

    // Memeriksa apakah jumlah yang dimasukkan melebihi stok
    // if (jumlah > stok) {
    //     document.getElementById('kerjumlah_err').textContent = 'Jumlah melebihi stok yang tersedia';
    // } else {
    //     document.getElementById('kerjumlah_err').textContent = ''; // Menghapus pesan error jika jumlah valid
    // }
// });
</script>



<script>
  var actionUrl = '{{ url('beranda') }}';
  var apiUrl = '{{ url('api/beranda') }}';
 
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
        // this.datatable();
      },
      methods: {
        
          addData(){
              this.data = {};
              this.editStatus = false;
              // this.editeror = true;
              $('#modal-default').modal();

          },
           
         submitForm(event, id){

              event.preventDefault();
              const _this = this;

                  // Mode tambah data
                if (!checkkerjumlah() && !checkkerukuran()) {
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

                }else if(!checkkerjumlah() || !checkkerukuran()){

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
                  // _this.table.ajax.reload();

                  if(actionUrl == this.actionUrl){
                        Swal.fire({
                          title:'Berhasil',
                          text:'Pesanan Telah Masuk Di Keranjang',
                          icon:'success',
                          showConfirmButton: false
                         })

                        // Menutup pesan setelah 2 detik
                          setTimeout(() => {
                              Swal.close();
                          }, 2000);

                          var i = 0;
                          var interval=setInterval(function(){
                          $('#refresh').load(location.href + " #refresh");
                          if(i<2)clearInterval(interval);
                          i++;
                          }, 1000);
                      // setTimeout(() => {
                      //   window.location.href = "{{ url('beranda') }}";
                      //   }, 4000)


                      document.getElementById("jumlah").value = "";
                      document.getElementById("kerukuran").value = "";
                       
                  }
                  });
                }

              




            





            
           },
          



      }
    });

</script>

<!-- validasi -->
<script>
    var stokBarang = {{ $barang->stok }};
</script>
<script src="{{asset('validation/validation.js')}}"></script>

@endsection