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
					<div class="panel-heading"><i class="fa fa-history"></i> {!! Lang::get('global.waiting invoice') !!}</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-9">
								{!! Form::open(['url' => '/customer','class'=>'form-inline','id'=>'searchForm','method' => 'get']) !!}
									<div class="form-group">
										<input type="text" name="order_date_from" class="datepicker form-control" value="{!! Request::get('order_date_from') !!}" />
									</div>
									<div class="form-group">
										<input type="text" name="order_date_to" class="datepicker form-control"   value="{!! Request::get('order_date_to') !!}" />
									</div>
									 <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> {!! Lang::get('global.search') !!}</button>
								{!! Form::close() !!}	
							</div>
							<div class="col-md-3">
								<div class="pull-right">
									<a href="{!! url('booking/rent') !!}" class="btn btn-primary">{!! Lang::get('global.new order') !!}</a>
								</div>
							</div>
						</div>
						
						<div class="row" style="margin-top:10px">
							<div class="col-md-12">
								<table class="table style-1 type-2 striped">
									<thead>
										<tr>
											<th class="col-md-2 text-center">{!! Lang::get('global.date') !!}</th>
											<th class="col-md-1 text-center">{!! Lang::get('global.number') !!}</th>
											<th class="col-md-8 text-center">{!! Lang::get('global.destination') !!}</th>
											<th class="col-md-1 text-center">[{!! Lang::get('global.view') !!}]</th>
										</tr>
									</thead>
									<tbody>
									@if($sales_orders)
										@foreach($sales_orders as $key => $row)
											<tr>
												<td>{!! $row->order_date !!}</td>
												<td>#{!! $row->id !!}</td>
												<td>{!! $row->pick_up_point !!} - {!! $row->destination !!}</td>
												<td><a class="btn btn-sm btn-primary" href="{!! url('/customer/view/'.Crypt::encrypt($row->id)) !!}">View</a></td>
											</tr>
										@endforeach	
									@else
										<tr>
											<td colspan="4">{!! Lang::get('global.not data show') !!}</td>	
										</tr>
									@endif
									</tbody>
								</table>
								
								{!! $sales_orders->appends(Request::except('page'))->render() !!}
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection	