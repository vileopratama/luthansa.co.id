<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no" />
	<meta name="_token" content="{{ csrf_token() }}" />
	<link rel="shortcut icon" href="{!! asset('themes/luthansa/assets/favicon.ico') !!}"/> 
	<link href="{!! asset('vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css"/>
	<link href="{!! asset('vendor/jquery-ui/css/jquery-ui.structure.min.css') !!}" rel="stylesheet" type="text/css"/>
	<link href="{!! asset('vendor/jquery-ui/css/jquery-ui.min.css') !!}" rel="stylesheet" type="text/css"/>
	<link href="{!! asset('vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet">        
	<link href="{!! asset('themes/luthansa/assets/css/style.css') !!}" rel="stylesheet" type="text/css"/>
	<link href="{!! asset('themes/luthansa/assets/css/_custom.css') !!}" rel="stylesheet" type="text/css"/> 
	<link href="{!! asset('vendor/jquery.confirm/jquery-confirm.min.css') !!}" rel="stylesheet" type="text/css"/> 
	@stack('css-extras')
	{!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    <!-- Ou -->
    {!! SEO::generate() !!}
    <!-- Lumen -->
    {!! app('seotools')->generate() !!}
	</head>
	<body class="no-overflow" data-color="theme-1">
		<div class="loading blue">
			<div class="loading-center">
				<div class="loading-center-absolute">
					<div class="object object_four"></div>
					<div class="object object_three"></div>
					<div class="object object_two"></div>
					<div class="object object_one"></div>
				</div>
			</div>
		</div>

		<header class="color-1 hovered menu-3">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="nav"> 
							 <a href="{!! url('/') !!}" class="logo">
								<img src="{!! asset('themes/luthansa/assets/img/theme-1/logo_dark.png') !!}" alt="lets travel">
							</a>

							<div class="nav-menu-icon">
								<a href="#"><i></i></a>
							</div>

							<nav class="menu">
								<ul>
									<li class="type-1 {!! Request::segment(1)==''?'active':'' !!}""><a href="{!! url('/') !!}">{!! Lang::get('menu.home') !!}<span class="fa fa-angle-down"></span></a></li>
									<li class="type-1 {!! (Request::segment(2)=='medium-bus-31-31-seats' || Request::segment(2)=='micro-bus-21-seats' || Request::segment(2)=='micro-bus-17-19-seats') ?'active':'' !!}"><a href="#">{!! Lang::get('menu.fleets') !!}<span class="fa fa-angle-down"></span></a>
										<ul class="dropmenu">
											<li><a href="{!! url('/page/commuter-hi-ace-15-seats') !!}">{!! Lang::get('menu.commuter hi-ace 15 seats') !!}</a></li>
											<li><a href="{!! url('/page/elf-long-19-seats') !!}">{!! Lang::get('menu.elf long 19 seats') !!}</a></li>
											<li><a href="{!! url('/page/elf-long-21-seats') !!}">{!! Lang::get('menu.elf long 21 seats') !!}</a></li>
											<li><a href="{!! url('/page/medium-bus-31-seats') !!}">{!! Lang::get('menu.medium bus 31 seats') !!}</a></li>
											<!--<li><a href="{!! url('/page/big-bus-59-seats') !!}">{!! Lang::get('menu.big bus 59 seats') !!}</a></li>-->
										</ul>
									</li>
									<li class="type-1 {!! Request::segment(2)=='facilities'   ?'active':'' !!}"><a href="{!! url('/page/facilities') !!}">{!! Lang::get('menu.facilities') !!}<span class="fa fa-angle-down"></span></a></li>
									<li class="type-1 {!! Request::segment(2)=='price-list'   ?'active':'' !!}"><a href="{!! url('/page/price-list') !!}">{!! Lang::get('menu.price list') !!}<span class="fa fa-angle-down"></span></a></li>
									<li class="type-1 {!! Request::segment(2)=='contact-us'   ?'active':'' !!}"><a href="{!! url('/page/contact-us') !!}">{!! Lang::get('menu.contact us') !!}<span class="fa fa-angle-down"></span></a></li>
									<li class="type-1 {!! Request::segment(2)=='portal'       ?'active':'' !!}"><a href="#">{!! Lang::get('menu.portal') !!}<span class="fa fa-angle-down"></span></a>
										<ul class="dropmenu">
											@if(!Auth::check())
												<li><a href="{!! url('/session/login') !!}">{!! Lang::get('menu.login') !!}</a></li>
												<li><a href="{!! url('/session/login') !!}">{!! Lang::get('menu.register') !!}</a></li>
											@else
												<li><a href="{!! url('/customer') !!}">{!! Lang::get('menu.my account') !!}</a></li>
											@endif
										</ul>
									</li>
								</ul>
							</nav>
							
							
						</div>
					</div>
				</div>
			</div>
		</header>
		
		@yield('content')
		<div id="divLoading"></div>
		<footer class="bg-dark type-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="footer-block">
							<img src="{!! asset('themes/luthansa/assets/img/theme-1/logo.png') !!}" alt="" class="logo-footer">
							<div class="f_text color-grey-7">
								Kami adalah perusahaan yang bergerak dalam bidang jasa penyewaan Bus Pariwisata. Kami menyewakan Bus Pariwisata 19/21 seats (Isuzu Elf Long Chassis)
								dan Kapasitas 31 seats (Medium Bus) yang dilengkapi dengan fasilitas-fasilitas menarik seperti: LCD TV, Kenwood DVD Player, MP3 Player, AUX Cable, Reading lamp, Individual AC Louver, Reclining seats, arm rest,GPS System, Wireless Microphone, Bantal, subwoofer,WiFi, Charger Plug. Bus kami juga didukung dengan pelayanan crew yang menyenangkan dan memiliki pengetahuan pariwisata yang luas.
								Hubungi kami segera dan dapatkan penawaran harga terbaik dari kami !!
							</div>
							<div class="footer-share">
								<a href="#"><span class="fa fa-facebook"></span></a>
								<a href="#"><span class="fa fa-twitter"></span></a>
								<a href="#"><span class="fa fa-google-plus"></span></a>
								<a href="#"><span class="fa fa-pinterest"></span></a>
							</div>
						</div>
					</div>
    		
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="footer-block">
							<h6>Office:</h6>
							<div class="contact-info">
								<div class="contact-line color-grey-3">
									<i class="fa fa-map-marker"></i>
									<span>Jl.Pondok Randu Raya No.8 RT 03 RW 02 Duri Kosambi,</span><br/>
									<span style="margin-left:22px"> Cengkareng, Jakarta Barat 11750</span>
								</div>
							</div>
							
							
								
							<h6>Hotline:</h6>
							<div class="contact-info">
								<div class="contact-line color-grey-3">
									<i class="fa fa-mobile"></i>
									<span>0852-1360-5352</span><br/>
								</div>
								<div class="contact-line color-grey-3">
									<i class="fa fa-phone"></i>
									<span>021-98902175</span><br/>
								</div>
								<div class="contact-line color-grey-3">
									<i class="fa fa-envelope"></i>
									<span>office[at]luthansa.co.id</span><br/>
								</div>	
							</div>		
						</div>
					</div>
				</div>
			</div>

			<div class="footer-link bg-black">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="copyright">
								<span>&copy; {!! date('Y') !!} All rights reserved. Luthansa Groups</span>
						</div>
						<ul>
							<li class="active"><a class="link-aqua" href="{!! url('page/about-us') !!}">{!! Lang::get('menu.about us') !!}</a></li>
							<li><a class="link-aqua" href="{!! url('page/service') !!}">{!! Lang::get('menu.service') !!}</a></li>
							<li><a class="link-aqua" href="{!! url('page/our-client') !!}">Our Client</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>  
		
		<script src="{!! asset('vendor/jquery/js/jquery-2.1.4.min.js') !!}"></script>
		<script src="{!! asset('vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
		<script src="{!! asset('vendor/jquery-number/jquery.number.min.js') !!}"></script>
		<script src="{!! asset('vendor/jquery-ui/js/jquery-ui.min.js') !!}"></script>
		<script src="{!! asset('vendor/jquery.confirm/jquery-confirm.min.js') !!}"></script>
		<!--<script src="{!! asset('vendor/idangerous/js/idangerous.swiper.min.js') !!}"></script>
		<script src="{!! asset('vendor/viewportchecker/js/jquery.viewportchecker.min.js') !!}"></script>
		<script src="{!! asset('vendor/isotope/js/isotope.pkgd.min.js') !!}"></script>
		<script src="{!! asset('vendor/mousewheel/js/jquery.mousewheel.min.js') !!}"></script>-->	
		<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=en"></script>
		<script src="{!! asset('vendor/main/js/map.js') !!}"></script>	-->
		<script src="{!! asset('vendor/main/js/all.js') !!}"></script>
		 @stack('scripts')	
		 @stack('scripts-extras')
		 <!--Start of Tawk.to Script-->
		<script type="text/javascript">
			var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
			(function(){
			var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			s1.async=true;
			s1.src='https://embed.tawk.to/583f7e704160416f6d9697a8/default';
			s1.charset='UTF-8';
			s1.setAttribute('crossorigin','*');
			s0.parentNode.insertBefore(s1,s0);
			})();
		</script>
		<!--End of Tawk.to Script-->
		 
	</body>

</html>				   