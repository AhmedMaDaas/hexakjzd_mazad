@extends('admin.index')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/main.css">
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/allsignin.css">

<style type="text/css">
	.basic table tr.block td{
		color: red
	}
	.numinput input[type='text'], .locinput input[type='text'] {
	    width: 75%;
	}
</style>
@endpush

@push('js')
<script src="{{ url('/') }}/admin_design/js/allsignin.js"></script>

<script type="text/javascript">
	function updateLocation(id, location, load, input){
		$.ajax({
			url: "{{ url('/') }}/admin/update-location",
			type: 'post',
			data: {
				_token: "{{ csrf_token() }}",
				id: id,
				location: location,
			},
			success: function(data){
				load.addClass('hidden');
				input.addClass('hidden');
				input.before(data.location);
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}

	function updatePhone(id, phone, load, input){
		$.ajax({
			url: "{{ url('/') }}/admin/update-phone",
			type: 'post',
			data: {
				_token: "{{ csrf_token() }}",
				id: id,
				phone: phone,
			},
			success: function(data){
				load.addClass('hidden');
				input.addClass('hidden');
				input.before(data.phone);
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}

	function approveOrDisapproveUser(id, approval, load, img, src, imgClass){
		$.ajax({
			url: "{{ url('/') }}/admin/approval",
			type: 'post',
			data: {
				_token: "{{ csrf_token() }}",
				id: id,
				approval: approval,
			},
			success: function(data){
				load.addClass('hidden');
				img.attr('src', "{{ url('/') }}/admin_design/images/" + src);
				img.attr('class', imgClass);
				img.show();
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}

	function blockUnblockUser(id, blocked, load, img, src, imgClass){
		$.ajax({
			url: "{{ url('/') }}/admin/block-user",
			type: 'post',
			data: {
				_token: "{{ csrf_token() }}",
				id: id,
				blocked: blocked,
			},
			success: function(data){
				load.addClass('hidden');
				img.attr('src', "{{ url('/') }}/admin_design/images/" + src);
				img.attr('class', imgClass);
				img.show();
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}
	
	$(document).ready(function(){

		$(document).on('click', '.locinput .checki', function(){
			var id = $(this).parent('td').parent('tr').attr('id');
			var input = $(this).parent('td').find('input');
			var load = $(this).parent('td').find('i');
			load.removeClass('hidden');
			updateLocation(id, input.val(), load, input);
		});

		$(document).on('click', '.numinput .checki', function(){
			var id = $(this).parent('td').parent('tr').attr('id');
			var input = $(this).parent('td').find('input');
			var load = $(this).parent('td').find('i');
			load.removeClass('hidden');
			updatePhone(id, input.val(), load, input);
		});

		$(document).on('click', '.nappimg', function(){
			$(this).hide();
			var id = $(this).parent('td').parent('tr').attr('id');
			var load = $(this).parent('td').find('i');
			load.removeClass('hidden');
			approveOrDisapproveUser(id, 1, load, $(this), 'user.png', 'appimg');
		});

		$(document).on('click', '.appimg', function(){
			$(this).hide();
			var id = $(this).parent('td').parent('tr').attr('id');
			var load = $(this).parent('td').find('i');
			load.removeClass('hidden');
			approveOrDisapproveUser(id, 0, load, $(this), 'question.png', 'nappimg');
		});

		$(document).on('click', '.unbimg', function(){
			$(this).hide();
			var id = $(this).parent('td').parent('tr').attr('id');
			var load = $(this).parent('td').find('i');
			load.removeClass('hidden');
			blockUnblockUser(id, 1, load, $(this), 'blockr.png', 'bimg');
		});

		$(document).on('click', '.bimg', function(){
			$(this).hide();
			var id = $(this).parent('td').parent('tr').attr('id');
			var load = $(this).parent('td').find('i');
			load.removeClass('hidden');
			blockUnblockUser(id, 0, load, $(this), 'blockg.png', 'unbimg');
		});

		$(document).on('click', '.search li', function(){
			var column = $(this).attr('id').replace(/^\s+|\s+$/gm,'').toLowerCase();
			$('.search input[name="s"]').val(column);
			if(column == 'approval' || column == 'blocked'){
				$('.search input[name="q"]').val($(this).attr('data-value'));
				$('#search-form').submit();
			}
		});

	});

</script>
@endpush

<div class="info">
	<div class="search">
		<p class="searchby">{{ trans('admin.search_by') }}</p>
		<ul>
			<li id="Name">{{ trans('admin.name') }}</li>
			<li id="Number">{{ trans('admin.number') }}</li>
			<li id="Location">{{ trans('admin.location') }}</li>
			<li id="Date">{{ trans('admin.date') }}</li>
			<li id="Approval" data-value="1">{{ trans('admin.approved') }}</li>
			<li id="Approval" data-value="0">{{ trans('admin.unapproved') }}</li>
			<li id="Blocked" data-value="1">{{ trans('admin.blocked') }}</li>
			<li id="Blocked" data-value="0">{{ trans('admin.unblocked') }}</li>
		</ul>
		<div class="inputsearch">
			<form id="search-form">
				<input name="s" type="hidden">
				<input name="q" type="text">
				<button><img src="{{ url('/') }}/admin_design/images/search.png"></button>
			</form>
		</div>
	</div>
    <div class="basic">

		<div class="basicform">
			<p class="allsignin">{{ trans('admin.all_signed') }}</p>
			<p class="editl">{{ trans('admin.edit') }}</p>
		</div>

		<table>
		 	<tr>
				<th>{{ trans('admin.name_customer') }}</th> 
				<th>{{ trans('admin.number_customer') }}</th>
				<th>{{ trans('admin.location') }}</th> 
				<th>{{ trans('admin.date') }}</th> 
				<th>{{ trans('admin.approval') }}</th> 
				<th>{{ trans('admin.block') }}</th> 
			</tr>
			@foreach($users as $user)
				<tr id="{{ $user->id }}" class="{{ $user->attention == 'attention2' ? 'block' : '' }}">
					<td>{{ $user->name }}</td>
					<td class="numinput">
						<i class='fa fa-spin fa-spinner load hidden'></i>{{ $user->phone }}
						<input type="text" class="{{ isset($user->phone) ? 'hidden' : '' }}">
					</td>
					<td class="locinput">
						<i class='fa fa-spin fa-spinner load hidden'></i>{{ $user->location }}
						<input type="text" class="{{ isset($user->location) ? 'hidden' : '' }}">
					</td>
					<td>{{ getOnlyDate($user->created_at) }}</td>
					<td class="Approval">
						<i class='fa fa-spin fa-spinner load hidden'></i>
						<img src="{{ url('/') }}/admin_design/images/{{ $user->approval ? 'user.png' : 'question.png' }}" style='cursor:pointer' class="{{ $user->approval ? 'appimg' : 'nappimg' }}">
					</td>
					<td class="block">
						<i class='fa fa-spin fa-spinner load hidden'></i>
						<img src="{{ url('/') }}/admin_design/images/{{ $user->blocked ? 'blockr.png' : 'blockg.png' }}" style='cursor:pointer' class="{{ $user->blocked ? 'bimg' : 'unbimg' }}">
					</td>
				</tr>
			@endforeach
		</table>

		@if($pagesNumber > 1)
			<nav aria-label="..." class="paginate">
			  <ul class="pagination">
			    <li class="page-item {{ $page > 1 ? '' : 'disabled' }}">
			      <a class="page-link" href="{{ $page > 1 ? url('admin/signed') . '?page=' . ($page - 1) : '#' }}">Previous</a>
			    </li>
			    @for($i = 1; $i <= $pagesNumber; $i++)
			    <li class="page-item {{ $page == $i ? 'active' : '' }}">
			      <a class="page-link" href="{{ url('admin/signed') }}?page={{ $i }}">{{ $i }} <span class="sr-only">{{ $page == $i ? '(current)' : '' }}</span></a>
			    </li>
			    @endfor
			    <li class="page-item {{ $page == $pagesNumber ? 'disabled' : '' }}">
			      <a class="page-link" href="{{ $page == $pagesNumber ? '#' : url('admin/signed') . '?page=' . ($page + 1) }}">Next</a>
			    </li>
			  </ul>
			</nav>
		@endif
 	</div>
</div>

@endsection