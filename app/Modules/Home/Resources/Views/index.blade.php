ret@extends('luthansa::main')
@section('content')
<!-- TOP BANNER -->
<div class="top-baner bg-blue">
	<div class="row no-margin">
		<div class="swiper-container main-slider-4 col-md-6 banner-home" style="background-color:#000">
			<div class="row">
				<div class="col-md-12">
					<img src="{!! asset('themes/luthansa/assets/img/home/header.jpg') !!}" class="img-responsive" />
				</div>
				<div class="col-xs-12 col-md-12" style="height:300px">
					 <!--<iframe style="width:100%;height:300px;background-color:#000"
						src="https://www.youtube.com/embed/V2AS-zXV2Hg?autoplay=1&loop=1">
					</iframe>--> 
				</div>
			</div>
		</div>
		
		<div class="find-form no-padding col-xs-12 col-md-6">		
			<div>
				<h4 class="ff_subtitle">{!! Lang::get('global.online booking form') !!}</h4>
				{!! Form::open(['url' => '/booking','id'=>'bookingForm','method' => 'post']) !!}
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-block clearfix">
								<div class="form-label color-white">{!! Lang::get('global.name') !!}</div>
								<div class="input-style-1">
									{!!Form::text('name', '', ['id'=>'name','placeholder'=> Lang::get('global.name')]) !!}
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-block clearfix">
								<div class="form-label color-white">{!! Lang::get('global.total passenger') !!}</div>
								<div class="input-style-1">
									{!!Form::text('total_passenger', '', ['class'=>'text-right','id'=>'total_passenger','placeholder'=> "0"]) !!}
								</div>
							</div>
						</div>	
					</div>
					
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-block clearfix">
								<div class="form-label color-white">{!! Lang::get('global.email') !!}</div>
								<div class="input-style-1">
									{!!Form::text('email', '', ['id'=>'email','placeholder'=> Lang::get('global.email')]) !!}
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-block clearfix">
								<div class="form-label color-white">{!! Lang::get('global.total days') !!}</div>
								<div class="input-style-1">
									{!!Form::text('total_days', '', ['id'=>'total_days','class' => 'text-right','placeholder'=> "0"]) !!}
								</div>
							</div>
						</div>	
					</div>
					
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-block clearfix">
								<div class="form-label color-white">{!! Lang::get('global.handphone') !!}</div>
								<div class="input-style-1">
									{!!Form::text('mobile_number', '', ['id'=>'mobile_number','placeholder'=> Lang::get('global.handphone')]) !!}
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-block clearfix">
								<div class="form-label color-white">{!! Lang::get('global.pick-up point') !!}</div>
								<div class="input-style-1">
									{!!Form::text('pick_up_point', '', ['id'=>'pick_up_point']) !!}
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-block clearfix">
								<div class="form-label color-white">{!! Lang::get('global.company name') !!}</div>
								<div class="input-style-1">
									{!!Form::text('company_name', '', ['id'=>'company_name','placeholder' => Lang::get('message.company name fill if company')]) !!}
								</div>
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-6">
							<div class="form-block clearfix">
								<div class="form-label color-white">{!! Lang::get('global.pick-up date') !!}</div>
								<div class="input-style-1">
									{!!Form::text('booking_from_date', '', ['class'=>'datepicker','id'=>'booking_from_date','data-date-format'=> 'dd/mm/yyyy','placeholder'=>'DD/MM/YYYY']) !!}
								</div>
							</div>
						</div>	
					</div>
					
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<div class="form-block clearfix">
								<div class="form-label color-white">{!! Lang::get('global.destination') !!}</div>
								<div class="input-style-1">
									{!!Form::text('destination', '', ['id'=>'destination','placeholder'=>'Isi dengan alamat tujuan']) !!}
								</div>
							</div>
						</div>
					</div>
					<input type="submit" id="button" class="c-button bg-white pull-right" value="{!! Lang::get('global.book now') !!}" >
				{!! Form::close() !!}	
			</div>
		</div>	      	 		
	</div>
</div>
		
	<div class="main-wraper color-2 padd-90">
		<img class="center-image" src="{!! asset('themes/luthansa/assets/img/home_4/tour-bg.jpg') !!}" alt="">
		<div class="wide-container">
			<div class="row">
				<div class="col-xs-12">
					<div class="second-title style-2">
    					<h2>Armada Luthansa</h2>
    				</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-3">
					<img class="img-responsive" src="{!! asset('themes/luthansa/assets/img/home/1.jpg') !!}" />
				</div>
				<div class="col-md-3">
					<img class="img-responsive" src="{!! asset('themes/luthansa/assets/img/home/2.jpg') !!}" />
				</div>
				<div class="col-md-3">
					<img class="img-responsive" src="{!! asset('themes/luthansa/assets/img/home/3.jpg') !!}" />
				</div>
				<div class="col-md-3">
					<img class="img-responsive" src="{!! asset('themes/luthansa/assets/img/home/4.jpg') !!}" />
				</div>
			</div>
			
		</div>
	</div>
		
	<div class="main-wraper padd-90">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2">
					<div class="second-title">
    					<h2>LUTHANSA Luxury Coach</h2>
    					<p class="color-grey">
							Kami adalah perusahaan yang bergerak dalam bidang jasa penyewaan Bus Pariwisata.
							Kami menyewakan Bus Pariwisata 19/21seats (Isuzu Elf Long Chassis) dan Kapasitas
							31seats (Medium Bus) yang dilengkapi dengan fasilitas-fasilitas
							menarik seperti: LCD TV, Kenwood DVD Player, MP3 Player, AUX Cable, Reading lamp,
							Individual AC Louver, Reclining seats, arm rest,GPS System, Wireless Microphone,
							Bantal, subwoofer,WiFi, Charger Plug. Bus kami juga didukung dengan pelayanan
							crew yang menyenangkan dan memiliki pengetahuan  pariwisata yang luas.
							Hubungi kami segera dan dapatkan penawaran harga terbaik dari kami !!
						</p>
						
    				</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script src="{!! asset('vendor/jquery-number/jquery.number.min.js') !!}"></script>		

<script type="text/javascript">
$(document ).ready(function() {
	$('input[name="total_passenger"]').number(true,0);
	$('input[name="total_days"]').number(true,0);
	$('#bookingForm').on('submit', function(event) {
		event.preventDefault();
		$('div#divLoading').addClass("show");	
		$.ajax({
			type  : $(this).attr('method'),
			url   : $(this).attr('action'),
			data  : $(this).serialize(),
			cache : false,
			dataType : "json",
			beforeSend : function() { console.log($(this).serialize());},
			//beforeSend: function(xhr) {xhr.setRequestHeader('X-CSRF-Token', $('meta[name="_token"]').attr('content'))},
			success : function(response) {
				$(".help-block").remove();
				if(response.success == false) {
					$.each(response.message, function( index,message) {
						var element = $('<p>' + message + '</p>').attr({'class' : 'help-block text-danger'}).css({display: 'none'});
						$('#'+index).after(element);
							$(element).fadeIn();
					});
					$("div#divLoading").removeClass('show');
				}
				else {
					//$.alert(response.message);
					$(".help-block").remove();
					$("div#divLoading").removeClass('show');
					window.location = response.redirect;
				}
			},
			error : function() {		
				$("div#divLoading").removeClass('show');
			}
		});																
	});
});	
</script>
@endpush