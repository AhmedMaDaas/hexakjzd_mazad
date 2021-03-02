@extends('admin.index')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/newlive.css">
@endpush

@push('js')
<script src="{{ url('/') }}/admin_design/js/newlive.js"></script>
@endpush

	<div class="info">
         <div class="basic">
			<p class="newlive">{{ trans('admin.add_new_live') }}</p>
			<form action="{{ url('/admin') }}/lives/create" method="POST" class="newformlive">
				{{ csrf_field() }}
				<table>
					<tr>
				 		<td><label>{{ trans('admin.date_and_time') }}</label></td>
						<td><input type="datetime-local" name="live_start" value="{{ old('live_start') }}">
					</tr>

					<tr>
					 	<td><label>{{ trans('admin.houres') }}</label></td>
						<td class="minutes"><input name="houres" value="{{ old('houres') }}" type="text">
					</tr>

					<tr>
					 	<td><label>{{ trans('admin.minutes') }}</label></td>
						<td class="minutes"><input name="minutes" value="{{ old('minutes') }}" type="text">
					</tr>

					<tr>
					 	<td><label>{{ trans('admin.description') }}</label></td>
						<td class="minutes"><textarea name="description">{{ old('description') }}</textarea>
					</tr>

				    <tr>
						<td><label>{{ trans('admin.initial_views') }}</label></td>
						<td><input name="cheat_views" value="{{ old('cheat_views') }}" type="text">
					</tr>

				 	<tr>
						<td><label>{{ trans('admin.opening_value') }}</label></td>
						<td><input name="min_value" value="{{ old('min_value') }}" type="text">
					</tr>

					<tr>
						<td><label>{{ trans('admin.bargaining_value') }}</label></td>
						<td><input name="bargaining_value" value="{{ old('bargaining_value') }}" type="text">
					</tr>
			
					<tr>
						<td><label>{{ trans('admin.likes_on_live') }}</label></td>
						<td class="url"><input name="cheat_likes" value="{{ old('cheat_likes') }}" type="text" class="urlinput">
					</tr>
			 	</table>
				<button class="submit">{{ trans('admin.submit') }}</button>
			</form>
		</div>
	</div>
@endsection