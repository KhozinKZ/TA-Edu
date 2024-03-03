<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | E-Shopper</title>

	<link rel="stylesheet" href=" {{ asset('assets/css/AdminLTE.css')}} ">
	<link rel="stylesheet" href=" {{ asset('assets/Ionicons/css/ionicons.min.css')}} ">
	<link rel="stylesheet" href=" {{ asset('assets/boot/bootstrap.css')}} ">
    <link rel="stylesheet" href=" {{ asset('assets/css/font-awesome.min.css')}} ">
    <link rel="stylesheet" href=" {{ asset('assets/css/prettyPhoto.css')}} ">
    <link rel="stylesheet" href=" {{ asset('assets/css/price-range.css')}} ">
    <link rel="stylesheet" href=" {{ asset('assets/css/animate.css')}} ">
    <link rel="stylesheet" href=" {{ asset('assets/css/main.css')}} ">
    <link rel="stylesheet" href=" {{ asset('assets/css/responsive.css')}} ">
    <link rel="stylesheet" href=" {{ asset('assets/css/tooltip.css')}} ">
    <link rel="stylesheet" href=" {{ asset('assets/multiple-select/multiple-select.css')}} ">
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>

    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href=" {{ asset('assets/images/home/logoe.png')}} ">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"  href=" {{ asset('assets/images/ico/apple-touch-icon-144-precomposed.png')}} ">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"  href=" {{ asset('assets/images/ico/apple-touch-icon-114-precomposed.png')}} ">
    <link rel="apple-touch-icon-precomposed"  sizes="72x72" href=" {{ asset('assets/images/ico/apple-touch-icon-72-precomposed.png')}} ">
    <link rel="apple-touch-icon-precomposed"  sizes="72x72" href=" {{ asset('assets/images/ico/apple-touch-icon-57-precomposed.png')}} ">

    @yield('css')
    <style>
/*    	pesan eror pada form*/
		.invalid-feedback{
			    width: 100%;
			    margin-top: 0.25rem;
			    font-size: 90%;
			    color: #dc3545;
		}

		

    </style>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row"> 
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href=" {{url('home')}} "><img src="/assets/images/home/logo.png" alt="" /></a>
							
						</div>
						
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li>
									
									<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									<i class="fa fa-lock"></i>
									{{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
									</form>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse" data-widget="tree">
								@role('Admin')
								<li>
									<a href=" {{ url('home')}} " class="{{ request()->is('home') ? 'active' : '' }} ">
									<i class="fa fa-dashboard"></i>
									 Dashboard 
									</a>
								</li>
								
								<li class="dropdown">
					                <a href="#" class="dropdown-toggle 
					                <?php
					                if(request()->is('pakaian') || request()->is('pakaian/*/edit')   || request()->is('ukuran')){
					                	echo 'active';
					                }
					                
					                ?>
					                "
				                	data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-leaf"></i> Data Master <span class="caret"></span></a>
					                <ul class="dropdown-menu">
					                  <li class="dropdown-header"></li>
					                  <li>

					                  	<a href="{{ url('pakaian')}}" class=" 
					                 <?php 
					                 	if(request()->is('pakaian') || request()->is('pakaian/*/edit')){
					                 		echo 'active';
					                 	}


					                 ?>


					                  	"><i class="fa fa-leaf"></i> Jenis Pakaian</a>
					                  </li>
					                  <li><a href="{{ url('ukuran')}}" class="{{ request()->is('ukuran') ? 'active' : '' }}"><i class="fa fa-leaf"></i> Ukuran</a></li>  
					                  <!-- <li><a href="#"><i class="fa fa-leaf"></i> Ukuran</a></li> -->
					                </ul>
				              	</li>
								
								<li>
									<a href=" {{ url('barang')}} " class="
									<?php
					                if(request()->is('barang') || request()->is('barang/detail/*')){
					                	echo 'active';
					                }
					                
					                ?>

									 ">
									<i class="fa fa-shopping-cart"></i>
									 Penjualan
									</a>
								</li>
						    @endrole
								<!-- <li class=" treeview">
				          <a href="#">
				            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
				            <span class="pull-right-container">
				              <i class="fa fa-angle-left pull-right"></i>
				            </span>
				          </a>
				          <ul class="treeview-menu">
				            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
				            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
				          </ul>
				        </li> -->
								<!-- <li>
									<a href=" {{ url('barang')}} " class="{{ request()->is('barang') ? 'active' : '' }}">
									<i class="fa fa-tags"></i>
									B
									</a>
								</li> -->
							@role('Admin')
								<li><a href="{{ url('beranda')}}" class="
									<?php
					                if(request()->is('beranda') || request()->is('beranda/*')){
					                	echo 'active';
					                }
					                
					                ?>
									"><i class="fa fa-home"></i> Tampilan</a>
								</li>
							@endrole	

							@role('Pembeli')
								<li><a href="{{ url('beranda')}}" class="
									<?php
					                if(request()->is('beranda') || request()->is('beranda/*')){
					                	echo 'active';
					                }
					                
					                ?>
									"><i class="fa fa-home"></i> Beranda</a>
								</li>
							@endrole
								<li><a href="{{ url('keranjang')}}" class="{{ request()->is('keranjang') ? 'active' : '' }}"><i class="fa fa-shopping-cart"></i> Keranjang</a>
								</li>
								<li><a href="{{ url('bayar') }}" class="{{ request()->is('bayar') ? 'active' : '' }}">
									    <i class="fa fa-money"></i> Transaksi
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- <div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div> -->
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	@yield('content')

	<footer id="footer"><!--Footer-->
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="text-center">Copyright © 2023 E-SHOPPER Inc. All rights reserved.</p>
				
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	

	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>

	<script src="{{asset('assets/js/adminlte.min.js')}} "></script>

	<script src="{{asset('assets/jquery/bootstrap.min.js')}} "></script>
	<script src="{{asset('assets/jquery/demo.js')}} "></script>
	<script src="{{asset('assets/js/jquery.scrollUp.min.js')}} "></script>
	<script src="{{asset('assets/js/price-range.js')}} "></script>
	<script src="{{asset('assets/js/jquery.prettyPhoto.js')}} "></script>
	<script src="{{asset('assets/js/main.js')}} "></script>

	<script src="{{asset('assets/sweetalert2/dist/sweetalert2.all.min.js')}} "></script>

	<!-- datatables -->
	  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
	  <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
	  <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
	  <!-- ChartJS -->
	  <script src=" {{ asset('assets/chart.js/Chart.min.js')}} "></script>


	  <script src="{{asset('assets/multiple-select/multiple-select.js')}} "></script>

	  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
	<!-- <script>
		$(function() {
			$('#multiukuran').multipleSelect({
				placeholder: 'Here is the placeholder via javascript'
			})
		})
	</script> -->

	<script>	
  $(function () {
    $('#datatables').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>

</script>


	@yield('js')
</body>
</html>