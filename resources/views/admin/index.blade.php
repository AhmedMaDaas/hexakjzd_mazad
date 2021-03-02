@include('admin.layouts.header')
@include('admin.layouts.menu')

<div class="content">
	<input type="hidden" name="url" value="{{ url('/') }}">
	@include('admin.layouts.navbar')
	@include('admin.layouts.messages')
	@yield('content')
</div>

@include('admin.layouts.footer')