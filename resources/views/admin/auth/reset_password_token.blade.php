@extends('admin.auth.index')

@section('content')

	<form class="login100-form validate-form" method="POST">
		{{ csrf_field() }}
		<div class="login100-form-avatar">
			<img src="{{ url('/') }}/admin_design/images/Medium-Blonde-Hairstyles-For-Men.jpg" alt="AVATAR">
		</div>

		<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
			<input class="input100" type="password" name="password" placeholder="{{ trans('admin.new_password') }}">
		
		</div>

		<div class="container-login100-form-btn p-t-10">
			<button type="submit" class="login100-form-btn">
				{{ trans('admin.reset_password') }}
			</button>
		</div>

		<div class="text-center w-full p-t-25 p-b-230">
			<a href="{{ url('admin/login') }}" class="txt1">
				{{ trans('admin.login') }}
			</a>
		</div>

	</form>

@endsection