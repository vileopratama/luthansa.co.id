<div class="modal fade" id="login-form" role="dialog">
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			{!! Form::open(['url' => 'session/do-login','id'=>'loginForm','class'=>'form-horizontal']) !!}
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title"><i class="fa fa-key"></i> {!! Lang::get('global.login form') !!}</h4>
			</div>
			<div class="modal-body">
				<div id="modalLoading"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label text-left">{!! Lang::get('global.email') !!}</label>
							<div class="col-sm-9">
								{!! Form::text('email',session('url.email'),['class' => 'form-control input-md col-md-12','id'=>'email']) !!}
							</div>
						</div>
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label text-left">{!! Lang::get('global.password') !!}</label>
							<div class="col-sm-9">
								{!! Form::password('password',['class' => 'form-control input-md col-md-12','id'=>'password']) !!}
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<a class="text-danger" href="{!! url('/session/forgot-password') !!}">{!! Lang::get('global.forgot password') !!}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-md" id="xbtn-submit"><i class="fa fa-save"></i> {!! Lang::get('global.login') !!}</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">{!! Lang::get('global.close') !!}</button>
			</div>
			{!! Form::close() !!}
		</div>
    </div>
</div>
@push('scripts-extras')
<script type="text/javascript">
	$(document).ready(function() {
		$('#loginForm').on('submit', function(event) {
			event.preventDefault();
			$('#modalLoading').addClass("show");
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
						$("#modalLoading").removeClass('show');
					}
					else {
						if(response.is_login == false) {
							$.alert(response.message);
						} else {
							$.alert(response.message);	
							window.location = response.redirect;
						}
						$(".help-block-primary").remove();
						$("#modalLoading").removeClass('show');
						
					}
				},
				error : function() {		
					$("#modalLoading").removeClass('show');
					$(".help-block-primary").remove();
				}
			});		
		});		
	});	
</script>
@endpush