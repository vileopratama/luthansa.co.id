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
                        <td colspan="4"><a class="brand" href="{!! url('/') !!}"><img style="width:100%;height:100px" src="{!! asset('vendor/luthansa/img/logo.png') !!}" /></a></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FFFFFF" align="center">
                <table width="650px" cellspacing="0" cellpadding="3" class="container">
                    <tr>
                        <td>
							{!! Lang::get('global.to') !!} : {!! $customer['name'] !!}
							<br/>
							{!! Lang::get('global.click this link') !!}
							<br/>
							{!! url('/session/reset-password/'.$customer['remember_token']) !!}
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