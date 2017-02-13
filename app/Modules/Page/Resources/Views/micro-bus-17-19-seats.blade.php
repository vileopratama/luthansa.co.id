@extends('luthansa::main')
@section('content')
<!-- INNER-BANNER -->
<div class="inner-banner style-6">
	<img class="center-image" src="{!! asset('themes/luthansa/assets/img/detail/bg_2.jpg') !!}" alt="">
</div>

<!-- DETAIL WRAPPER -->
<div class="detail-wrapper">
	<div class="container">
		<div class="detail-header">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<h2 class="detail-title color-dark-2">MICRO BUS 17-19 Seats</h2>
					<div class="detail-rate rate-wrap clearfix">
				        <div class="rate">
							<span class="fa fa-star color-yellow"></span>
							<span class="fa fa-star color-yellow"></span>
							<span class="fa fa-star color-yellow"></span>
							<span class="fa fa-star color-yellow"></span>
							<span class="fa fa-star color-yellow"></span>
						</div>
			       	</div>
			    </div>
			    <div class="col-xs-12 col-sm-4">
			    	<div class="detail-price color-dark-2">Harga Mulai  <span class="color-dr-blue"> IDR 500.000</span> /Hari</div>
			    </div>
	       	</div>
       	</div>
			
       	<div class="row padd-90">
       		<div class="col-xs-12 col-md-8">
       			<div class="detail-content color-1">
       				<div class="detail-top slider-wth-thumbs style-2">
						<div class="swiper-container thumbnails-preview" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
			                <div class="swiper-wrapper">
		                    	<div class="swiper-slide active" data-val="0">
		                    		 <img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_1.jpg') !!}" alt="">
		                    	</div>
		                    	<div class="swiper-slide" data-val="1">
		                    		 <img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_2.jpg') !!}" alt="">
		                    	</div>
		                    	<div class="swiper-slide" data-val="2">
		                    		 <img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_3.jpg') !!}" alt="">
		                    	</div>
		                    	<div class="swiper-slide" data-val="3">
		                    		 <img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_4.jpg') !!}" alt="">	 
		                    	</div>
		                    	<div class="swiper-slide" data-val="4">
		                    		 <img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_5.jpg') !!}" alt="">         		 
		                    	</div>
								<div class="swiper-slide" data-val="5">
		                    		 <img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_6.jpg') !!}" alt="">         		 
		                    	</div>	
		                    </div>
			                <div class="pagination pagination-hidden"></div>
			            </div>
			            <div class="swiper-container thumbnails" data-autoplay="0" 
			            data-loop="0" data-speed="500" data-center="0" 
			            data-slides-per-view="responsive" data-xs-slides="3" 
			            data-sm-slides="5" data-md-slides="5" data-lg-slides="5" 
			            data-add-slides="5">
			                <div class="swiper-wrapper">
								<div class="swiper-slide current active" data-val="0">
									<img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_1s.jpg') !!}" alt="">
								</div>
								<div class="swiper-slide" data-val="1">
									<img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_2s.jpg') !!}" alt="">
								</div>
								<div class="swiper-slide" data-val="2">
									<img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_3s.jpg') !!}" alt="">
								</div>
								<div class="swiper-slide" data-val="3">
									<img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_4s.jpg') !!}" alt="">
								</div>
								<div class="swiper-slide" data-val="4">
									<img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_5s.jpg') !!}" alt="">
								</div>
								<div class="swiper-slide" data-val="5">
									<img class="img-responsive img-full" src="{!! asset('themes/luthansa/assets/img/detail/mi17_slide_6s.jpg') !!}" alt="">
								</div>	
							</div>
							<div class="pagination"></div>
						</div>
					</div>		
				</div>       			
       		</div>
       		<div class="col-xs-12 col-md-4">
       			<div class="right-sidebar">
       				<div class="detail-block bg-dr-blue">
       					<h4 class="color-white">Fasilitas</h4>
       					<div class="details-desc">
							<p class="color-grey-9">Armada:  <span class="color-white">Isuzu Elf NKR 55</span></p>
							<p class="color-grey-9">Audio: <span class="color-white"> Ya</span></p>
							<p class="color-grey-9">LED Tv: <span class="color-white">Ya , 1 Buah</span></p>
							<p class="color-grey-9">Karaoke: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">DVD/MP3: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">WiFi: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">Bagasi<span class="color-white">Ya</span></p></p>
							<p class="color-grey-9">Louver AC Individual: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">Lampu Baca: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">Sandaran Bangku: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">Jok: <span class="color-white">Kulit</span></p>
							<p class="color-grey-9">Pengharum Kabin Otomatis: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">Bantal: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">Palu Pemecah Kaca: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">Alat Pemadam Api Ringan: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">Pintu Keluar Darurat: <span class="color-white">Ya</span></p>
							<p class="color-grey-9">Pengemudi: <span class="color-white">ramah & berpengalaman</span></p>	
						</div>
						<div class="details-btn">
							<a href="{!! url('/') !!}" class="c-button b-40 bg-white hv-transparent"><span>Inquiry</span></a>
						</div>
       				</div>								      				
       			</div>       			
       		</div>
       	</div>
	</div>
</div>	
@endsection	