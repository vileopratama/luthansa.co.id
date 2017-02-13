@extends('luthansa::main')
@section('content')
<div class="detail-wrapper" style="padding-top:105px;">
	<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">{!! Lang::get('global.login form') !!}</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="{!! url('/session/forgot-password') !!}">{!! Lang::get('global.forgot password') !!} </a></div>
                </div>     

                <div style="padding-top:30px" class="panel-body" >
                    {!! Form::open(['url' => '/session/do-login','id'=>'loginForm','method' => 'post']) !!}             
                        <div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input id="email" type="text" class="form-control" name="email" value="" placeholder="{!! Lang::get('global.email') !!}" />                                        
                        </div>
                                
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="{!! Lang::get('global.password') !!}" />
						</div>
                              
                        <div style="margin-top:10px;margin-bottom:10px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
								<button type="submit" class="btn btn-success btn-md">{!! Lang::get('global.login') !!}</button>          
                            </div>
                        </div>

                        <div class="form-group" >
                            <div class="col-md-12 control" style="margin-top:10px;margin-bottom:10px">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                    {!! Lang::get('message.do not have an account') !!}
									<a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">{!! Lang::get('message.register here') !!}</a>
                                </div>
                            </div>
                        </div>    
					{!! Form::close() !!}   
                </div>                     
            </div>  
        </div>
		<!-- Sign up form -->
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">{!! Lang::get('global.register user') !!}</div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">{!! Lang::get('global.login') !!}</a></div>
                </div>  
                <div class="panel-body">
					{!! Form::open(['url' => '/session/do-register','id'=>'registerForm','class'=>'form-horizontal','method' => 'post']) !!}        
						<div class="form-group">
                            <label for="email" class="col-md-4 control-label">{!! Lang::get('global.email') !!}</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="email" id="email" placeholder="{!! Lang::get('global.email') !!}" />
                            </div>
                        </div>
                                    
                        <div class="form-group">
                            <label for="firstname" class="col-md-4 control-label">{!! Lang::get('global.name') !!}</label>
							<div class="col-md-8">
                                <input type="text" class="form-control" name="name" id="name" placeholder="{!! Lang::get('global.name') !!}" />
                            </div>
                        </div>
                                
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">{!! Lang::get('global.password') !!}</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password" id="password" placeholder="{!! Lang::get('global.password') !!}">
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="password" class="col-md-4 control-label">{!! Lang::get('global.confirm password') !!}</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="{!! Lang::get('global.confirm password') !!}">
                            </div>
                        </div>
                                
                        <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">                                   
                            <div class="col-md-offset-3 col-md-9">
                               <button id="btn-fbsignup" type="submit" class="btn btn-primary"><i class="fa fa-arrow-right"></i> {!! Lang::get('global.register') !!}</button>
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
		$('#loginForm').on('submit', function(event) {
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
							$('#loginForm #'+index).after(element);
								$(element).fadeIn();
						});
						$("div#divLoading").removeClass('show');
					}
					else {
						if(response.is_login == false) {
							$.alert(response.message);
						} else {
							window.location = response.redirect;
						}
						$(".help-block-primary").remove();
						$("div#divLoading").removeClass('show');
						
					}
				},
				error : function() {		
					$("div#divLoading").removeClass('show');
					$(".help-block-primary").remove();
				}
			});		
		});		
		
		$('#registerForm').on('submit', function(event) {
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
							$('#registerForm #'+index).after(element);
								$(element).fadeIn();
						});
						$("div#divLoading").removeClass('show');
					}
					else {
						$.alert(response.message);
						$(".help-block-primary").remove();
						$("div#divLoading").removeClass('show');
						window.location = response.redirect;
					}
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