@extends('layouts.admin')

@section('css')

<style>
	[v-cloak] {
    display: none;
}


.productinfo .nama{

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
} 
</style>


@endsection


@section('content')

<div id="controller" v-cloak>

<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="/assets/images/home/girl1.jpg" class="girl img-responsive" alt="" />
									<img src="/assets/images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="/assets/images/home/girl2.jpg" class="girl img-responsive" alt="" />
									<img src="/assets/images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="/assets/images/home/girl3.jpg" class="girl img-responsive" alt="" />
									<img src="/assets/images/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->


<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<div class="shipping text-center"><!--shipping-->
							<img src="/assets/images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>

					
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>

						<div class="input-group" >
			                <input type="text" class="form-control" autocomplete="off" placeholder="Cari Data" v-model="search" >
			                <span class="input-group-addon search"><i class="fa fa-search "></i></span>
             		    </div>
             		    <br>
			
						<div class="col-sm-4" v-for="brg in filteredList">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="single-products">
									    <div class="productinfo text-center">
									        <img :src="'/data_file/' + brg.gambar" alt="" />
									        <h2>Rp. @{{ numberWithSpaces(brg.harga)}}</h2>
									         <p class="nama">@{{ truncateText(brg.nama_produk, 2) }}</p>
									        <p><b>(@{{brg.nama_jenis}})</b></p>
									        <!-- Memeriksa apakah stok barang sudah habis atau tidak -->
									        <template v-if="brg.stok > 0">
									            <button class="btn btn-default add-to-cart jumlah" v-on:click="viewData(brg)">
									                <i class="fa fa-eye"></i>Lihat Barang
									            </button>
									        </template>
									        <template v-else>
									            <p>Barang sudah habis</p>
									        </template>
									    </div>
									    <div class="product-overlay">
									        <div class="overlay-content">
									            <h2>Rp. @{{ numberWithSpaces(brg.harga)}}</h2>
									            <p >@{{brg.nama_produk}}</p>
									            <p>(@{{brg.nama_jenis}})</p>
									            <!-- Memeriksa apakah stok barang sudah habis atau tidak -->
									            <template v-if="brg.stok > 0">
									                <button class="btn btn-default add-to-cart jumlah" v-on:click="viewData(brg)">
									                    <i class="fa fa-eye"></i>Lihat Barang
									                </button>
									            </template>
									            <template v-else>
									                <p>Barang sudah habis</p>
									            </template>
									        </div>
									    </div>
									</div>
										<div class="product-overlay">
											<div class="overlay-content">
											<h2>Rp. @{{ numberWithSpaces(brg.harga)}}</h2>
											<p>@{{brg.nama_produk}}</p>
											<p>(@{{brg.nama_jenis}})</p>

											<template v-if="brg.stok > 0">
											<button class="btn btn-default add-to-cart jumlah" v-on:click="viewData(brg)"><i class="fa fa-eye"></i>Lihat Barang</button>
											</template>
											<template v-else>
					                <p>Barang sudah habis</p>
					            </template>
																<!-- <a :href="'/beranda/' + brg.id">View Detail</a> -->
								
											</div>
										</div>
								</div>

								<div class="choose">
									<!-- <ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul> -->
								</div>
							</div>
						</div>
			

						
						
					</div><!--features_items-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/assets/images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/assets/images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/assets/images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/assets/images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/assets/images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="/assets/images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>

</div>
@endsection

@section('js')
<script>
	var actionUrl = '{{ url('beranda') }}';
	var apiUrl = '{{ url('api/beranda') }}';
	var app = new Vue({
  el:'#controller',
    data:{
          barang: [],
          // book:{},
          search: '',
          // actionUrl,
          // apiUrl,
          // editStatus : false
      }, 
      mounted: function(){
       this.get_barang();
      },
        methods: {
        	 
    get_barang() {
            const _this = this;
        $.ajax({
          url:apiUrl,
          method:'GET',
          success: function(data){
            _this.barang = JSON.parse(data);
          },
          error: function(error){
            console.log(error);
          }

        });           
               
          },
         	


          viewData(brg){
              // Tetapkan data barang yang dipilih ke variabel "brg"
			    this.brg = brg;

			    // Bangun URL untuk data detail barang
			    this.actionUrl = '{{ url('beranda') }}' + '/' + brg.id;

			    // Mengarahkan pengguna langsung ke halaman detail barang
			    window.location.href = this.actionUrl; 
             
          },
          // deleteData(id){
          //     this.actionUrl = ' {{ url('books') }}'+'/'+id; 
          //   if (confirm("Yakin Ingin Menghapus Data ini !")){
          //       axios.post(this.actionUrl, {_method: 'DELETE'}).then(response =>{
          //          alert('Data Telah Dihapus');
          //       });
          //       setTimeout(() => {
          //      location.reload();       
          //   }, 2000)
              
          //     }
          // },
          numberWithSpaces(x) {
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          },
           truncateText(text, maxLines, maxCharactersPerLine) {
            let words = text.split(' ');
            let truncatedText = '';
            let lineCount = 0;

            for (let word of words) {
                if (lineCount < maxLines) {
                    if ((truncatedText + ' ' + word).length <= 50) {
                        truncatedText += ' ' + word;
                    } else {
                        truncatedText = truncatedText.trim() + '\n' + word;
                        lineCount++;
                    }
                } else {
                    break;
                }
            }

            truncatedText = truncatedText.trim();
            if (words.length > maxLines) {
                truncatedText += '...';
            }

            return truncatedText;
        },
      submitForm(event, id){
              event.preventDefault();
              const _this = this;
              var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;
              axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
              $('#modal-default').modal('hide');
             
              location.reload();
              });
           }, 
        },

        computed: {
          filteredList(){
			  return this.barang.filter(brg => {
			  return brg.nama_produk.toLowerCase().includes(this.search.toLowerCase()) ||
			         brg.harga.toString().toLowerCase().includes(this.search.toLowerCase()) ||
			         brg.nama_jenis.toString().toLowerCase().includes(this.search.toLowerCase());
			  })
			}
        }
})


</script>

@endsection