@extends('luthansa::main')
@section('content')
@include('customer::modals.confirm-payment')
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
					<div class="panel-heading"><i class="fa fa-file-o"></i> {!! Lang::get('global.invoice') !!} : #{!! $sales_order->number !!}</div>
					<div class="panel-body">
						<div class="alert alert-info">
							<strong>{!! Lang::get('global.info') !!} </strong> {!! Lang::get('message.luthansa confirm payment info') !!}
						</div>
						
						<div class="row" style="margin-top:10px">
							<div class="col-md-5">
								<table class="table">
									<tbody>
										<tr>
											<td class="col-md-6">{!! Lang::get('global.order date') !!}</td>
											<td class="col-md-6">{!! $sales_order->order_date !!}</td>
										</tr>
										<tr>
											<td>{!! Lang::get('global.due date') !!}</td>
											<td>{!! $sales_order->due_date !!}</td>
										</tr>
										<tr>
											<td>{!! Lang::get('global.from date') !!}</td>
											<td>{!! $sales_order->booking_from_date !!}</td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<div class="col-md-7">
								<table class="table">
									
									<tr>
										<td class="col-md-5">{!! Lang::get('global.email') !!}</td>
										<td class="col-md-7">{!! $sales_order->customer_email !!}</td>
									</tr>
									<tr>
										<td class="col-md-5">{!! Lang::get('global.handphone') !!}</td>
										<td class="col-md-7">{!! $sales_order->customer_phone_number !!}</td>
									</tr>
									<tr>
											<td>{!! Lang::get('global.to date') !!}</td>
											<td>{!! $sales_order->booking_to_date !!}</td>
										</tr>
									
								</table>
							</div>
						</div>
						
						<div class="row" style="margin-top:10px">
							<div class="col-md-12">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#home">{!! Lang::get('global.transportation type') !!}</a></li>
									<li><a data-toggle="tab" href="#confirm-payment-table">{!! Lang::get('global.confirm payment') !!}</a></li>
								</ul>
								
								<div class="tab-content">
									<div id="home" class="tab-pane fade in active">
										<table class="table style-1 type-2">
											<thead>
												<tr>
													<th class="col-md-3 text-center">{!! Lang::get('global.transportation type') !!}</th>
													<th class="col-md-2 text-center">{!! Lang::get('global.unit') !!}</th>
													<th class="col-md-2 text-center">{!! Lang::get('global.days') !!}</th>
													<th class="col-md-2 text-center">{!! Lang::get('global.subtotal') !!}</th>
												</tr>
											</thead>
											<tbody>
												@php
													$subtotal = 0;
												@endphp
												@foreach($sales_order_details as $key => $order)
												@php
													$subtotal+=($order->price * $order->qty)  * $order->days;
												@endphp
												<tr>
													<td>{!! $order->armada_category_name !!}</th>
													<td class="text-right">{!! $order->qty !!}</th>
													<td class="text-right">{!! $order->days !!}</th>
													<td class="text-right">{!! number_format($order->price * $order->qty * $order->days,2) !!}</th>
												</tr>
												@endforeach
												@foreach($sales_order_costs as $key => $order)
												@php
													$subtotal+=$order->cost;
												@endphp
												<tr>
													<td>{!! $order->description !!}</td>
													<td class="text-right"></td>
													<td class="text-right"></td>
													<td class="text-right">{!! number_format($order->cost,2) !!}</td>
												</tr>
												@endforeach
												<tr>
													<td class="text-right" colspan="3"><strong>Subtotal</strong></td>
													<td class="text-right"><strong>{!! number_format($subtotal,2) !!}</strong></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div id="confirm-payment-table" class="tab-pane">
										<table class="table style-1 type-2">
											<thead>
												<tr>
													<th class="col-md-2 text-center">{!! Lang::get('global.date') !!}</th>
													<th class="col-md-4 text-center">{!! Lang::get('global.from') !!}</th>
													<th class="col-md-4 text-center">{!! Lang::get('global.to') !!}</th>
													<th class="col-md-2 text-center">{!! Lang::get('global.total payment') !!}</th>
												</tr>
											</thead>
											<tbody>
												@foreach($sales_order_confirm_payments as $key => $row)
												<tr>
													<td>{!! $row->payment_date !!}</th>
													<td>{!! $row->from_bank_name !!} {!! $row->from_account_no !!} {!! $row->from_account_name !!}</th>
													<td>{!! $row->bank_account !!}</th>
													<td class="text-right">{!! number_format($row->total_payment,2) !!}</th>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>

								
							</div>	
							<div class="col-md-12">
								<div class="pull-right">
									<a href="#" class="btn btn-primary" id="confirm-payment">{!! Lang::get('global.confirm payment') !!}</a>
									<a href="{!! url('/customer/sales-order/download/invoice/'.Crypt::encrypt($sales_order->id)) !!}" class="btn btn-primary">{!! Lang::get('global.invoice download') !!}</a>
									<a href="{!! url('/customer/sales-order') !!}" class="btn btn-primary">{!! Lang::get('global.back') !!}</a>
								</div>
							</div>
						</div>
						
						
						<div class="row" style="margin-top:10px">
							<div class="col-md-12">
								<table class="table">
									<tbody>
										<tr>
											<td class="col-md-3">{!! Lang::get('global.pick-up point') !!}</td>
											<td class="col-md-9">{!! $sales_order->pick_up_point !!}</td>
										</tr>
										<tr>
											<td class="col-md-3">{!! Lang::get('global.destination') !!}</td>
											<td class="col-md-9">{!! $sales_order->destination !!}</td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
						
						
						
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
	$('#confirm-payment').on('click', function(event) {
		event.preventDefault();
		$('#confirm-payment-form').modal('show');
	});
});	
</script>	
@endpush	