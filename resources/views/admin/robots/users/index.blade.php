@extends('admin.index')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/robotuser.css">
@endpush

@push('js')
<!-- <script src="{{ url('/') }}/admin_design/js/robotuser.js"></script> -->

<script type="text/javascript">
	function updateRobot(id, name, image, row, load){
		var formData = new FormData();
	    formData.append('id', id);
	    formData.append('name', name);
	    formData.append('photo', image);
	    formData.append('_token', '{{ csrf_token() }}');

		$.ajax({
			url: "{{ url('/admin') }}/robots/update",
			type: 'post',
			enctype: 'multipart/form-data',
		    contentType: false,
		    processData: false,
			data: formData,
			success: function(data){
				load.addClass('hidden');
				row.replaceWith(data);
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}

	function deleteRobot(id, row, load){
		$.ajax({
			url: "{{ url('/admin') }}/robots/delete",
			type: 'post',
			data: {
				_token: "{{ csrf_token() }}",
				id: id
			},
			success: function(data){
				load.addClass('hidden');
				row.remove();
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}

	$(document).ready(function(){

		$(document).on('click', '.editimg', function(){
			var id = $(this).parent('td').parent('tr').attr('id');
			var name = $(this).parent('td').parent('tr').find('input[name="name"]').val();
			var image = $(this).parent('td').parent('tr').find('input[name="photo"]')[0].files[0];
			var row = $(this).parent('td').parent('tr');
			var load = $(this).next('i');load.removeClass('hidden');
			updateRobot(id, name, image == null ? '' : image, row, load);
		});

		$(document).on('click', '.deletimg', function(){
			var id = $(this).parent('td').parent('tr').attr('id');
			var row = $(this).parent('td').parent('tr');
			var load = $(this).next('i');load.removeClass('hidden');
			deleteRobot(id, row, load);
		});

	});

</script>
@endpush

<div class="info">
    <div class="basic">
		<div class="Basicinfo">
			<a href="#" class="binfo">{{ trans('admin.new_user') }}</a>
			<a href="#" class="linfo">{{ trans('admin.all_users') }}</a>
		</div>

		<form action="{{ url('/') }}/admin/robots/create" method="post" class="formbasic" enctype="multipart/form-data">
			{{ csrf_field() }}
			<label>{{ trans('admin.first_name') }}</label>
			<input name="fname" type="text" class="welcome">
			<label>{{ trans('admin.last_name') }}</label>
			<input name="lname" type="text" class="welcome">
			<label>{{ trans('admin.photo') }}</label>
			<input name="photo" type="file" class="welcome">
			<button class="submit">{{ trans('admin.submit') }}</button>
		</form>
		<form class="formlive" novalidate>
		
			<table>
				<tr class="first">
					<th>{{ trans('admin.full_name') }}</th>
					<th>{{ trans('admin.photo') }}</th>
					<th class="edit">{{ trans('admin.edit') }}</th>
					<th class="delete">{{ trans('admin.delete') }}</th>
				</tr>
				@foreach($robots as $robot)
					@include('admin.plugins.robot', ['robot' => $robot, 'hidden' => 'hidden'])
				@endforeach
			</table>      
		</form>
    </div>
</div>

@endsection