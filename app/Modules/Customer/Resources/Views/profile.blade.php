@extends('luthansa::main')
@section('content')
<div class="detail-wrapper" style="padding-top:105px;">
	<div class="container">
		<div class="row">
			<div class="col-md-2 sidebar1">
				<div class="left-navigation">
                    @include('customer::sidebar')
                </div>
			</div>
		
			<div class="col-md-10">
				<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-user"></i> My Profile</div>
					<div class="panel-body">
						{!! Form::open(['url' => '/customer/profile/do-update','id'=>'profileForm','method' => 'post']) !!}
							<div class="form-group">
								<label for="name" style="margin-bottom:10px">Nama Pribadi/ Perusahaan</label>
								{!! Form::text('name',$profile->name, ['class'=>'form-control input-md','id'=>'name']) !!}
							</div>
							<div class="form-group">
								<label for="name" style="margin-bottom:10px">No Telp.</label>
								{!! Form::text('phone_number',$profile->phone_number, ['class'=>'form-control input-md','id'=>'phone_number']) !!}
							</div>
							<div class="form-group">
								<label for="name" style="margin-bottom:10px">Handphone.</label>
								{!! Form::text('mobile_number',$profile->mobile_number, ['class'=>'form-control input-md','id'=>'mobile_number']) !!}
							</div>
							<div class="form-group">
								<label for="name" style="margin-bottom:10px">No Fax.</label>
								{!! Form::text('fax_number',$profile->fax_number, ['class'=>'form-control input-md','id'=>'fax_number']) !!}
							</div>
							<div class="form-group">
								<label for="name" style="margin-bottom:10px">Alamat.</label>
								{!! Form::textarea('address',$profile->address, ['rows'=>3,'class'=>'form-control input-md','id'=>'address']) !!}
							</div>
							<div class="form-group">
								<label for="name" style="margin-bottom:10px">Kota.</label>
								<div class="row">
									<div class="col-md-6">
										{!! Form::text('city',$profile->city, ['class'=>'form-control input-md ','id'=>'city']) !!}
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="name" style="margin-bottom:10px">Kode pos.</label>
								<div class="row">
									<div class="col-md-3">
										{!! Form::text('zip_code',$profile->zip_code, ['class'=>'form-control input-md','id'=>'zip_code']) !!}
									</div>
								</div>
							</div>
							
							<div class="form-group" >
								<div class="pull-right" style="margin-top:20px">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</div>
						{!! Form::close() !!}	
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection	

@push('scripts')
<script type="text/javascript">
$(document ).ready(function() {
	$('#profileForm').on('submit', function(event) {
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
						
				} else {
					$(".help-block-primary").remove();	
					$("div#divLoading").removeClass('show');
					$.alert({
						title: response.title,
						content: response.message,
					});
						
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