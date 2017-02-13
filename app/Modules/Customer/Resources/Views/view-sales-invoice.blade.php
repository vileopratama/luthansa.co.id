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
					<div class="panel-heading"><i class="fa fa-file-o"></i> Invoice : #{!! $sales_invoice->id !!}</div>
					<div class="panel-body">
						<div class="row" style="margin-top:10px">
							<div class="col-md-6">
								<table class="table">
									<tr>
										<th class="col-md-2">Tgl.Invoice</th>
										<td class="col-md-3">{!! $sales_invoice->invoice_date !!}</td>
									</tr>
									<tr>
										<th class="col-md-2">Jatuh tempo</th>
										<td class="col-md-3">{!! $sales_invoice->due_date !!}</td>
									</tr>
									
								</table>
							</div>
							
							
						</div>
						
						<div class="row" style="margin-top:10px">
							<div class="col-md-12">
								<table class="table style-1 type-2">
									<thead>
										<tr>
											<th class="col-md-3 text-center">Keterangan</th>
											<th class="col-md-2 text-center">Unit</th>
											<th class="col-md-2 text-center">Hari</th>
											<th class="col-md-2 text-center">Subtotal</th>
										</tr>
									</thead>
									<tbody>
										@php
											$subtotal = 0;
										@endphp
										@foreach($sales_invoice_details as $key => $order)
										@php
											$subtotal+=($order->price * $order->qty)  * $order->days;
										@endphp
										<tr>
											<td>{!! $order->description !!}</th>
											<td class="text-right">{!! $order->qty !!}</th>
											<td class="text-right">{!! $order->days !!}</th>
											<td class="text-right">{!! number_format($order->price * $order->qty * $order->days,2) !!}</th>
										</tr>
										@endforeach
										@foreach($sales_invoice_costs as $key => $order)
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
										@foreach($sales_invoice_payments as $key => $order)
										@php
											$subtotal-=$order->value;
										@endphp
										<tr>
											<td class="text-right" colspan="3">{!! $order->description !!}</td>
											<td class="text-right">{!! number_format($order->value,2) !!}</td>
										</tr>
										@endforeach
										<tr>
											<td class="text-right" colspan="3"><strong>Total Tagihan</strong></td>
											<td class="text-right"><strong>{!! number_format($subtotal,2) !!}</strong></td>
										</tr>
									</tbody>
									
										
									
								</table>
							</div>	
							<div class="col-md-12">
								<div class="pull-right">
									<a href="{!! url('/customer/sales-invoice/download/invoice/'.Crypt::encrypt($sales_invoice->id)) !!}" class="btn btn-primary">Download Invoice</a>
									<a href="{!! url('/customer/sales-invoice') !!}" class="btn btn-primary">Kembali</a>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection	