<html>
<head>
</head>
<body>
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
		<tbody>
			<tr valign="top">
				<td width="100%">
					<table align="center" border="0" cellpadding="0" cellspacing="0" style="color:#333333!important;font-family:arial,helvetica,sans-serif;font-size:12px" width="600">
						<tbody>
							<tr valign="top">
								<td style="width:50%">
									<img src="{!! asset('vendor/luthansa/img/small-logo.png') !!}" border="0" alt="{!! Lang::get('global.luthansa') !!}" class="CToWUd">
								</td>
								<td valign="middle" style="width:50%" align="right">
									{!! Lang::get('global.order date') !!} : {!! date('d M Y H:i:s') !!}
									<br>
									{!! Lang::get('global.queue number') !!} <a href="#" target="_blank">#13</a>
					 			</td>
							</tr>
						</tbody>
					</table>
					<div style="margin-top:30px;color:#333!important;font-family:arial,helvetica,sans-serif;font-size:12px">
						<span style="color:#333333!important;font-weight:bold;font-family:arial,helvetica,sans-serif">{!! Lang::get('global.hello') !!} Username,</span><br><br>
						<p style="font-size:14px;color:#c88039;font-weight:bold;text-decoration:none">{!! Lang::get('message.luthansa order notice') !!}</p>
						<div style="margin-top:5px;clear:both">
							<hr size="1">
						</div>
						
						<table border="0" cellpadding="0" cellspacing="0" style="color:#666666!important;font-family:arial,helvetica,sans-serif;font-size:11px;margin-bottom:20px;clear:both" width="98%" align="left">
							<tbody>
								<tr>
									<td style="padding-top:15px" valign="top" width="50%" align="left">
										<span style="color:#333333;font-weight:bold">{!! Setting::get('company_name') !!}</span>
										<br>
										<span style="color:#333333;font-weight:bold">{!! Setting::get('company_address') !!}</span>
										<br>
										<a href="mailto:{!! Setting::get('company_email') !!}" target="_blank">{!! Setting::get('company_email') !!}</a>
										<br>
										{!! Setting::get('company_phone_number') !!}
									</td>
									<td style="padding-top:15px" valign="top">
									</td>
								</tr>
								<tr>
									<td style="padding-top:15px" valign="top" width="40%" align="left">
										{!! $data->customer_name !!}<br>
										{!! $data->customer_address !!}<br>
										{!! $data->customer_city !!},<br>
										{!! $data->customer_zip_code !!}<br>
									</td>
									<td style="padding-top:15px" valign="top">
										<span style="color:#333333;font-weight:bold">{!! Setting::get('pick-up point') !!}</span><br>
										{!! $data->pick_up_point !!} <br/><br/>
										<span style="color:#333333;font-weight:bold">{!! Setting::get('destination') !!}</span><br>
										{!! $data->destination !!} <br/>
									</td>
								</tr>
							</tbody>
						</table>
						
						<table align="center" border="0" cellpadding="0" cellspacing="0" style="clear:both;color:#666666!important;font-family:arial,helvetica,sans-serif;font-size:11px" width="100%">
							<tbody>
								<tr>
									<td style="border:1px solid #ccc;border-right:none;border-left:none;padding:5px 10px 5px 10px!important;color:#333333!important" width="350" align="left">{!! Lang::get('global.transportation type') !!}</td>
									
									<td style="border:1px solid #ccc;border-right:none;border-left:none;padding:5px 10px 5px 10px!important;color:#333333!important" width="50" align="right">{!! Lang::get('global.unit') !!}</td>
									<td style="border:1px solid #ccc;border-right:none;border-left:none;padding:5px 10px 5px 10px!important;color:#333333!important" width="80" align="right">{!! Lang::get('global.days') !!}</td>
								</tr>
								<tr>
									<td style="padding:10px" align="left" colspan="3">Booking dari {!! $data->booking_from_date !!} sampai {!! $data->booking_to_date !!} ({!! $data->booking_total_days!!} hari )</td>
								</tr>
								@foreach($items as $key => $item)	
								<tr>
									<td style="padding:10px" align="left" >{!! $item->armada_category_name !!}</td>
									<td style="padding:10px" align="right">{!! $item->qty !!}</td>
									<td style="padding:10px" align="right">{!! $item->days !!}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<br><br>
					<span>Copyright &copy; {!! date("Y") !!} Luthansa Group Tour &amp; Transport. All rights reserved.</span>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>