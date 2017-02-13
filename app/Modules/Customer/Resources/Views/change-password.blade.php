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
					<div class="panel-heading"><i class="fa fa-user"></i> Change Password</div>
					<div class="panel-body">
						{!! Form::open(['url' => '/customer/change-password/do-update','id'=>'passwordForm','method' => 'post']) !!}
							<div class="form-group">
								<label for="name" style="margin-bottom:10px">Password Baru</label>
								<div class="row">
									<div class="col-md-6">
										{!! Form::password('password',['class'=>'form-control input-md','id'=>'password']) !!}
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="name" style="margin-bottom:10px">Konfirmasi Password Baru</label>
								<div class="row">
									<div class="col-md-6">
										{!! Form::password('confirm_password',['class'=>'form-control input-md','id'=>'confirm_password']) !!}
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="pull-right" style="margin-top:20px">
										<button type="submit" class="btn btn-primary">Ganti Password</button>
									</div>
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
	$('#passwordForm').on('submit', function(event) {
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