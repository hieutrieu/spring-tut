@layout('admin.layouts.login')
@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="../../index2.html"><b>InnoBilling</b></a>
	</div><!-- /.login-logo -->
	<div class="login-box-body" id="login-box">
		<p class="login-box-msg">Sign in to start your session</p>
		<form id="form_login" method="post" action="{{url('admin/auth/login')}}">
			<div class="form-group has-feedback">
				<input type="email" name="email" class="form-control" placeholder="Email">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="footer">
				<button type="submit" class="btn bg-green btn-block" data-text-loading="Login...">Login</button>
			</div>
		</form>
	</div>
</div>
@endsection
