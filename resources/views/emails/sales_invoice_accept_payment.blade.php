<html>
<head>
	@include('emails.header')
</head>
<body>
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td class="navbar navbar-inverse" align="center">
                <!-- This setup makes the nav background stretch the whole width of the screen. -->
                <table width="650px" cellspacing="0" cellpadding="3" class="container">
                    <tr class="navbar navbar-inverse">
                        <td colspan="4"><a class="brand" href="{!! url('/') !!}"><img style="width:100%;height:150px" src="{!! asset('vendor/luthansa/img/logo.png') !!}" /></a></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FFFFFF" align="center">
                <table width="650px" cellspacing="0" cellpadding="3" class="container">
                    <tr>
                        <td>
							Kpd Yth {!! $data->customer_name !!}
							<br/>
							<br/>
							Pembayaran anda telah kami terima dengan details sbb:
						</td>
                    </tr>
					<tr>
						<td>
							<table style="width:100%" cellspacing="0" cellpadding="3" >
								<tr>
									<td style="width:30%">{!! Lang::get('global.payment date')!!}</td>
									<td style="width:10%;text-align:center">:</td>
									<td style="width:60%">{!! $data->payment_date !!}</td>
								</tr>
								<tr>
									<td style="width:30%">{!! Lang::get('global.to account')!!}</td>
									<td style="width:10%;text-align:center">:</td>
									<td style="width:60%">{!! $data->account_no !!} {!! $data->account_name !!}</td>
								</tr>
								
								<tr>
									<td style="width:30%">{!! Lang::get('global.total bill')!!}</td>
									<td style="width:10%;text-align:center">:</td>
									<td style="width:60%">{!! $data->total !!}</td>
								</tr>
								<tr>
									<td style="width:30%">{!! Lang::get('global.percentage')!!}</td>
									<td style="width:10%;text-align:center">:</td>
									<td style="width:60%">{!! number_format($data->percentage,2) !!} %</td>
								</tr>
								<tr>
									<td style="width:30%">{!! Lang::get('global.total payment')!!}</td>
									<td style="width:10%;text-align:center">:</td>
									<td style="width:60%">{!! number_format($data->value,2) !!}</td>
								</tr>
							</table>
						 </td>
					</tr>	 
					<tr>
                        <td>
							<br/>
							Terima kasih atas kepercayaan anda memilih kami sebagai partner transportasi anda.
						</td>
                    </tr>
					
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FFFFFF" align="center">
                <table width="650px" cellspacing="0" cellpadding="3" class="container">
                    <tr>
                        <td>
                            <hr>
                            <p>Copyright &copy; {!! date('Y') !!} Luthansa Groups Tour & Transport</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>