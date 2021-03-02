@extends('admin.auth.index')

@section('content')

	<form class="login100-form validate-form" action="{{ url('admin/login') }}" method="POST">
		{{ csrf_field() }}
		<div class="login100-form-avatar">
			<img src="{{ url('/') }}/admin_design/images/Medium-Blonde-Hairstyles-For-Men.jpg" alt="AVATAR">
		</div>

		<div class="wrap-input100 validate-input m-b-10" data-validate = "Email is required">
			<input class="input100" type="email" name="email" placeholder="{{ trans('admin.email') }}">
	
		</div>

		<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
			<input class="input100" type="password" name="password" placeholder="{{ trans('admin.password') }}">
		
		</div>

		<div class="container-login100-form-btn p-t-10">
			<button type="submit" class="login100-form-btn">
				{{ trans('admin.login') }}
			</button>
		</div>

		<div class="text-center w-full p-t-25 p-b-230">
			<a href="{{ url('admin/reset/password') }}" class="txt1">
				{{ trans('admin.forgot_password') }}?
			</a>
		</div>

	</form>

@endsection