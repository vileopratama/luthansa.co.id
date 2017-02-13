@extends('luthansa::main')
@section('content')
@include('session::modals.login')
<div class="detail-wrapper" style="padding-top:105px;">
	<div class="container">
		{!! Form::open(['url' => '/booking/do-rent','id'=>'rentForm','method' => 'post','class' => 'form-horizontal']) !!}
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info">
				  <strong>{!! Lang::get('global.info') !!} </strong> {!! Lang::get('message.luthansa order notice') !!}
				</div>
				
				<table class="table style-1 type-2 striped">
					<thead>
					  <tr>
						<th class="col-md-6 text-center">{!! Lang::get('global.transportation type') !!}</th>
						<th class="col-md-3 text-center">{!! Lang::get('global.capacity per people') !!}</th>
						<th class="col-md-3 text-center">{!! Lang::get('global.quantity total') !!}</th>
					  </tr>
					</thead>
					<tbody>
						@if($armada_categories)	
							@foreach($armada_categories as $key => $armada)
							  <tr>
								<td>{!! $armada->name !!}</td>
								<td class="text-center">{!! $armada->capacity !!}</td>
								<td class="text-right">{!! Form::text('qty['.$armada->id.']', 0, ['class'=>'text-right quantity','id'=> $armada->id,'placeholder'=>0]) !!}</td>
							  </tr>
						  @endforeach
					  @endif
					  
					</tbody>
				</table>
			</div>
		</div> 
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">{!! Lang::get('global.customer form') !!}</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-sm-4 text-left">{!! Lang::get('global.full name') !!}</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" name="name" id="name" placeholder="{!! Lang::get('message.please fill a name') !!}" value="{!! Session::get('name') !!}" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-sm-4 text-left">{!! Lang::get('global.total passenger') !!}</label>
									<div class="col-sm-3">
									  <input type="text" class="text-right form-control" id="total_passenger" name="total_passenger" placeholder="0" value="{!! Session::get('total_passenger') !!}"  />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-sm-4 text-left">{!! Lang::get('global.email') !!}</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="email" name="email" placeholder="{!! Lang::get('message.please fill a valid email') !!}" value="{!! Session::get('email') !!}"  />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-sm-4 text-left">{!! Lang::get('global.total days') !!}</label>
									<div class="col-sm-3">
									  <input type="text" class="text-right form-control" id="total_days" name="total_days" placeholder="0" value="{!! Session::get('total_days') !!}"  />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-sm-4 text-left" for="email">{!! Lang::get('global.handphone') !!}</label>
									<div class="col-sm-8">
									  <input type="text" name="mobile_number" class="form-control" id="mobile_number" value="{!! Session::get('mobile_number') !!}" placeholder="{!! Lang::get('message.please fill a valid phone number') !!}" />
									</div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-sm-4 text-left">{!! Lang::get('global.pick-up date') !!}</label>
									<div class="col-sm-3">
									  <input type="text" class="form-control datepicker" name="booking_from_date" id="booking_from_date" value="{!! Session::get('booking_from_date') !!}"  />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-sm-4 text-left">{!! Lang::get('global.pick-up point') !!}</label>
									<div class="col-sm-8">
										<textarea rows="4" name="pick_up_point" class="form-control" placeholder="{!! Lang::get('message.please fill a pick up point') !!}">{!! Session::get('booking_pick_up_point') !!}</textarea>
									</div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-sm-4 text-left" for="email">{!! Lang::get('global.destination') !!}</label>
									<div class="col-sm-8">
										<textarea rows="4" name="destination" id="destination" class="form-control" placeholder="{!! Lang::get('message.please fill a destination') !!}">{!! Session::get('booking_destination') !!}</textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-sm-4 text-left" for="email">{!! Lang::get('global.company name') !!}</label>
									<div class="col-sm-8">
									  <input type="text" name="company_name" class="form-control" id="company_name" value="{!! Session::get('company name')!!}" placeholder="{!! Lang::get('message.company name fill if company') !!}" />
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="pull-right">
									<button type="submit" class="btn btn-primary btn-md">{!! Lang::get('global.book now') !!}</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div> 
		{!! Form::close() !!}
		
	</div>	
</div>
@endsection	
@push('scripts')
<script type="text/javascript">
$(document ).ready(function() {
	//format number
	$('.quantity').number(true,0);	
	$('input[name="total_passenger"]').number(true,0);	
	$('input[name="total_days"]').number(true,0);
	$('.login-click').on('click', function(event) {
		$('#login-form').modal('show');
	});
	
	$('#rentForm').on('submit', function(event) {
		event.preventDefault();
		$('div#divLoading').addClass("show");	
		$.ajax({
			type  : $(this).attr('method'),
			url   : $(this).attr('action'),
			data  : $(this).serialize(),
			cache : false,
			dataType : "json",
			beforeSend : function() { console.log($(this).serialize());},
			success : function(response) {
				$(".help-block-primary").remove();
				if(response.success == false) {
					$.each(response.message, function( index,message) {
						var element = $('<p>' + message + '</p>').attr({'class' : 'help-block-primary text-danger'}).css({display: 'none'});
						$('#'+index).after(element);
							$(element).fadeIn();
						});
					$("div#divLoading").removeClass('show');	
				}
				else {
					$(".help-block-primary").remove();
					$("div#divLoading").removeClass('show');
					if(response.is_customer_registered == true) {
						$.alert(response.message);
						$('#login-form #email').val(response.email);
						$('#login-form').modal('show');
					} else {
						$.alert(response.message);
						window.location = response.redirect;
					}		
				}
			},
			error : function() {	
				$(".help-block-primary").remove();	
				$("div#divLoading").removeClass('show');
			}
		});																
	});
});	
</script>
@endpush		