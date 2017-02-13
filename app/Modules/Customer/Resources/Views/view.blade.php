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
					<div class="panel-heading"><i class="fa fa-file-o"></i> {!! Lang::get('global.invoice') !!} : #{!! $sales_order->id !!}</div>
					<div class="panel-body">
						<div class="alert alert-info">
							<strong>{!! Lang::get('global.info') !!} </strong> {!! Lang::get('message.luthansa order notice') !!}
						</div>
				
						<div class="row" style="margin-top:10px">
							<div class="col-md-5">
								<table class="table table-condensed ">
									<tbody>
										<tr>
											<td class="col-md-6">{!! Lang::get('global.order date') !!}</td>
											<td class="col-md-6">{!! $sales_order->order_date !!}</td>
										</tr>
										<tr>
											<td>{!! Lang::get('global.from date') !!}</td>
											<td>{!! $sales_order->booking_from_date !!}</td>
										</tr>
										<tr>
											<td>{!! Lang::get('global.to date') !!}</td>
											<td>{!! $sales_order->booking_to_date !!}</td>
										</tr>
										<tr>
											<td>{!! Lang::get('global.total days') !!}</td>
											<td>{!! $sales_order->booking_total_days !!}</td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<div class="col-md-7">
								<table class="table">
									<tbody>
										<tr>
											<td class="col-md-2">{!! Lang::get('global.status') !!}</th>
											<td class="col-md-3">{!! Lang::get('global.waiting calculation price') !!}</td>
										</tr>
										<tr>
											<td class="col-md-2">{!! Lang::get('global.pick-up point') !!}</th>
											<td class="col-md-3">{!! $sales_order->pick_up_point !!}</td>
										</tr>
										<tr>
											<td class="col-md-2">{!! Lang::get('global.destination') !!}</td>
											<td class="col-md-3">{!! $sales_order->destination !!}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						
						<div class="row" style="margin-top:10px">
							<div class="col-md-12">
								<table class="table style-1 type-2">
									<thead>
										<tr>
											<th class="col-md-3 text-center">{!! Lang::get('global.transportation type') !!}</th>
											<th class="col-md-2 text-center">{!! Lang::get('global.capacity per people') !!}</th>
											<th class="col-md-2 text-center">{!! Lang::get('global.quantity total') !!}</th>
										</tr>
									</thead>
									<tbody>
										@foreach($sales_order_details as $key => $order)
										<tr>
											<td>{!! $order->armada_category_name !!}</th>
											<td>{!! $order->armada_category_name !!}</th>
											<td class="text-right">{!! $order->qty !!}</th>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>	
							<div class="col-md-12">
								<div class="pull-right">
									<a href="{!! url('/customer') !!}" class="btn btn-primary">{!! Lang::get('global.back') !!}</a>
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