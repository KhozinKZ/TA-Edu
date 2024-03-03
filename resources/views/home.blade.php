@extends('layouts.admin')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">{{ auth()->user()->name}}</a></li>
                  <!-- <li class="active">Shopping Cart</li> -->
                </ol>
            </div>
           
        </div>
    </section> <!--/#cart_items-->

@role('Admin')
    <section class="container">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                <div class="inner">
                <h3>{{ $total_pakaian}}</h3>

                <p>Jenis Pakaian</p>
                </div>
                <div class="icon">
                <i class="ion ion-android-clipboard"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-maroon">
                <div class="inner">
                <h3>{{ $total_barang}}</h3>

                <p>Barang</p>
                </div>
                <div class="icon">
                <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                <div class="inner">
                <h3>{{$total_keranjang}}</h3>

                <p>Pesanan Keranjang</p>
                </div>
                <div class="icon">
                <i class="ion ion-android-cart"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-light-blue">
                <div class="inner">
                <h3>{{$total_transaksi_count}}</h3>

                <p>Proses Pembayaran</p>
                </div>
                <div class="icon">
                <i class="ion ion-cash"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
           <div class="col-lg-5 col-xs-6">
               
        <div class="box">
        <div class="box-header with-border bg-orange" >
          <h3 class="box-title">Transaksi Penjualan</h3>

          <div class="box-tools pull-right" >
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" style="color:white"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" style="color:white" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">

                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
   
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer bg-orange">
       
        </div>
        <!-- /.box-footer-->
      </div> 
           
         
           
        </div>      
    </section>    
@endrole
@endsection
@section('js')
<script>
     var label_donut = '{!! json_encode($label_donat) !!}'; 
     var data_donut =  '{!! json_encode($data_combined) !!}';


     $(function () {

        //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: JSON.parse(label_donut),
      datasets: [
        {
          data: JSON.parse(data_donut),
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc','red','#D5d'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    })
</script>

@endsection