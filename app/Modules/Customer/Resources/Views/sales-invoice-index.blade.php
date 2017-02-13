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
					<div class="panel-heading"><i class="fa fa-history"></i> Latest Transaction</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-9">
								{!! Form::open(['url' => '/customer/sales-invoice','class'=>'form-inline','id'=>'searchForm','method' => 'get']) !!}
									<div class="form-group">
										<input type="text" name="invoice_date_from" class="datepicker form-control" value="{!! Request::get('invoice_date_from') !!}" />
									</div>
									<div class="form-group">
										<input type="text" name="invoice_date_to" class="datepicker form-control"   value="{!! Request::get('invoice_date_to') !!}" />
									</div>
									 <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari</button>
								{!! Form::close() !!}	
							</div>
							<div class="col-md-3">
								<div class="pull-right">
									<a href="{!! url('booking/rent') !!}" class="btn btn-primary">Pesan Baru</a>
								</div>
							</div>
						</div>
						
						<div class="row" style="margin-top:10px">
							<div class="col-md-12">
								<table class="table style-1 type-2 striped">
									<thead>
										<tr>
											<th class="col-md-2">Tgl </th>
											<th class="col-md-1">No.Invoice</th>
											<th class="col-md-2">Total</th>
											<th class="col-md-2">Bayar</th>
											<th class="col-md-2">Status</th>
											<th class="col-md-1">[View]</th>
										</tr>
									</thead>
									<tbody>
									@if($sales_invoices)
										@foreach($sales_invoices as $key => $row)
											<tr>
												<td>{!! $row->invoice_date !!}</td>
												<td>#{!! $row->id !!}</td>
												<td class="text-right">{!! number_format($row->total,2) !!}</td>
												<td class="text-right">{!! number_format($row->payment,2) !!}</td>
												<td class="text-center">{!! $row->status_string !!}</td>
												<td><a class="btn btn-sm btn-primary" href="{!! url('customer/sales-invoice/view/'.Crypt::encrypt($row->id)) !!}">View</a></td>
											</tr>
										@endforeach	
									@else
										<tr>
											<td colspan="4">Tidak ada data yang ditampilkan</td>	
										</tr>
									@endif
									</tbody>
								</table>
								
								{!! $sales_invoices->appends(Request::except('page'))->render() !!}
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