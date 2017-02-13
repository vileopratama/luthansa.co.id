@extends('luthansa::main')
@section('content')
<div class="detail-wrapper" style="padding-top:105px;">
	<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">{!! Lang::get('global.forgot password') !!}</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="{!! url('/session/login') !!}">{!! Lang::get('global.login') !!}</a></div>
                </div>     

                <div style="padding-top:30px" class="panel-body" >
                    {!! Form::open(['url' => '/session/do-forgot-password','id'=>'forgotPasswordForm','method' => 'post']) !!}             
                        <div style="margin-bottom: 25px" class="input-group" id="email">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" name="email" placeholder="{!! Lang::get('message.please fill a valid email') !!}">                                        
                        </div>
                        <div style="margin-top:10px;margin-bottom:10px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
								<button type="submit" class="btn btn-success btn-md">{!! Lang::get('global.sent activation') !!}</button>          
                            </div>
                        </div>
					{!! Form::close() !!}   
                </div>                     
            </div>  
        </div>
    </div>
</div>
@endsection	

@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('#forgotPasswordForm').on('submit', function(event) {
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
							$('#forgotPasswordForm #'+index).after(element);
								$(element).fadeIn();
						});
					}
					else {
						$('#forgotPasswordForm input[name="email"]').val("");
						$.alert(response.message);
					}
					$("div#divLoading").removeClass('show');
				},
				error : function() {		
					$("div#divLoading").removeClass('show');
					$(".help-block-primary").remove();
				}
			});		
		});		
	});
</script>
@endpush		