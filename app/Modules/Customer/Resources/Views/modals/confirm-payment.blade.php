<div class="modal fade" id="confirm-payment-form" role="dialog">
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			{!! Form::open(['url' => 'customer/sales-order/do-confirm-payment','id'=>'confimPaymentForm','class'=>'form-horizontal']) !!}
			{!! Form::hidden('sales_order_id',Crypt::encrypt($sales_order->id)) !!}
			
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title"><i class="fa fa-money"></i> {!! Lang::get('global.confirm payment') !!}</h4>
			</div>
			<div class="modal-body">
				<div id="modalLoading"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label text-left">{!! Lang::get('global.total bill') !!}</label>
							<div class="col-sm-9">
								{!! Form::text('total_bill',$sales_order->total,['class' => 'text-right form-control input-md col-md-12','id'=>'total_bill']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label text-left">{!! Lang::get('global.account bank') !!}</label>
							<div class="col-sm-9">
								{!! Form::select('account_id',\App\Modules\AccountBank\AccountBank::list_dropdown(),null,['class' => 'form-control input-lg','id'=>'account_id']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label text-left">{!! Lang::get('global.total transfer') !!}</label>
							<div class="col-sm-9">
								{!! Form::text('total_payment',"0",['class' => 'text-right form-control input-md col-md-12','id'=>'total_payment']) !!}
								<p>{!! Lang::get('message.payment minimum 50% from total bill') !!}</p>
							</div>
						</div>
						
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label text-left">{!! Lang::get('global.payment date') !!}</label>
							<div class="col-sm-3">	
								<input type="text" name="payment date" class="datepicker form-control" value="" id="payment_date"/>
							</div>
						</div>
						
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label text-left">{!! Lang::get('global.bank') !!}</label>
							<div class="col-sm-9">
								{!! Form::text('from_bank',null,['class' => 'form-control input-md col-md-12','id'=>'from_bank']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label text-left">{!! Lang::get('global.account no') !!}</label>
							<div class="col-sm-9">
								{!! Form::text('from_account_no',null,['class' => 'form-control input-md col-md-12','id'=>'from_account_no']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="first_name" class="col-sm-3 control-label text-left">{!! Lang::get('global.account name') !!}</label>
							<div class="col-sm-9">
								{!! Form::text('from_account_name',null,['class' => 'form-control input-md col-md-12','id'=>'from_account_name']) !!}
							</div>
						</div>
						
						
						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-md" id="xbtn-submit"><i class="fa fa-save"></i> {!! Lang::get('global.confirm payment') !!}</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">{!! Lang::get('global.close') !!}</button>
			</div>
			{!! Form::close() !!}
		</div>
    </div>
</div>
@push('css-extras')
	<link href="{!! asset('vendor/bootstrap-select2/css/select2.min.css') !!}" rel="stylesheet" type="text/css"/>
	<style>
		.select2 {font-size:8pt}
	</style>	
@endpush
@push('scripts-extras')
<script type="text/javascript" src="{!! asset('vendor/bootstrap-select2/js/select2.min.js') !!}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('input[name="total_bill"]').number(true,2);
		$('input[name="total_payment"]').number(true,2);
		$('select[name="account_id"]').select2({width:"100%"});
		
		$('#confimPaymentForm').on('submit', function(event) {
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
							$('#confimPaymentForm #'+index).after(element);
								$(element).fadeIn();
						});
						
					}
					else {
						$.alert(response.message);
						window.location = response.redirect;
					}
					$("#modalLoading").removeClass('show');
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