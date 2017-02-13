<ul class="list">
    <h5><i class="fa fa-list"></i> Main Menu</h5>
    <li class="{!! Request::segment(2)=='' ? 'active' :'' !!}"><i class="fa fa-arrow-up"></i> <a href="{!! url('/customer') !!}">Waiting Invoice</a></li>
	<li class="{!! Request::segment(2)=='sales-order' ? 'active' :'' !!}"><i class="fa fa-arrow-up"></i> <a href="{!! url('/customer/sales-order') !!}">Waiting Payment</a></li>
	<li class="{!! Request::segment(2)=='sales-invoice' ? 'active' :'' !!}"><i class="fa fa-history"></i> <a href="{!! url('/customer/sales-invoice') !!}">Latest Transaction</a></li>
    <li class="{!! Request::segment(2)=='profile' ? 'active' :'' !!}"><i class="fa fa-user"></i> <a href="{!! url('/customer/profile') !!}">My Profile</a></li>
	<li class="{!! Request::segment(2)=='change-password' ? 'active' :'' !!}"><i class="fa fa-key"></i> <a href="{!! url('/customer/change-password') !!}">Change Password</a></li>
    <li><i class="fa fa-sign-out"></i> <a href="{!! url('/session/logout') !!}">Logout</a></li>
</ul>