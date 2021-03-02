@extends('admin.index')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/main.css">
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/allcertified.css">

<style type="text/css">
	.basic table tr.block td{
		color: red
	}
</style>
@endpush

@push('js')
<script src="{{ url('/') }}/admin_design/js/allcertified.js"></script>

<script type="text/javascript">
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

	function attention(id, load, img){
		$.ajax({
			url: "{{ url('/') }}/admin/attention",
			type: 'post',
			data: {
				_token: "{{ csrf_token() }}",
				id: id,
				attention: img.attr('id'),
			},
			success: function(data){
				load.addClass('hidden');
				$('tr#' + id).replaceWith(data);
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}
	
	$(document).ready(function(){

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

		$(document).on('click', '.attention', function(){
			$(this).hide();
			var id = $(this).parent('td').parent('tr').attr('id');
			var load = $(this).parent('td').find('i');
			load.removeClass('hidden');
			attention(id, load, $(this));
		});

		$(document).on('click', '.search li', function(){
			var column = $(this).attr('id').replace(/^\s+|\s+$/gm,'').toLowerCase();
			if(column == 'unattentioned') window.location.href = "{{ url('/') }}/admin/certified";
			$('.search input[name="s"]').val(column);
			if(column == 'approval' || column == 'attention'){
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
			<li id="Unattentioned">{{ trans('admin.unattentioned') }}</li>
			<li id="Attention" data-value="attention1">{{ trans('admin.first_attention') }}</li>
			<li id="Attention" data-value="attention2">{{ trans('admin.second_attention') }}</li>
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
			<p class="allsignin">{{ trans('admin.all_certified') }}</p>
		</div>

		<table>
		 	<tr>
				<th>{{ trans('admin.name_customer') }}</th> 
				<th>{{ trans('admin.number_customer') }}</th>
				<th>{{ trans('admin.date') }}</th> 
				<th>{{ trans('admin.attention') }}</th> 
				<th>{{ trans('admin.explusion') }}</th> 
			</tr>
			@foreach($users as $user)
				<tr id="{{ $user->id }}" class="{{ $user->attention == 'attention2' ? 'block' : '' }}">
					<td>{{ $user->name }}</td>
					<td>{{ $user->phone }}</td>
					<td>{{ getOnlyDate($user->created_at) }}</td>
					<td class="Approval">
						<img id="attention1" src="{{ url('/') }}/admin_design/images/dry-clean.png" style='cursor:pointer' class="attention {{ isset($user->attention) ? 'filter-red' : '' }}">
						<i class='fa fa-spin fa-spinner load hidden'></i>
						<img id="attention2" src="{{ url('/') }}/admin_design/images/dry-clean.png" style='cursor:pointer' class="attention {{ $user->attention == 'attention2' ? 'filter-red' : '' }}">
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
			      <a class="page-link" href="{{ $page > 1 ? url('admin/certified') . '?page=' . ($page - 1) : '#' }}">Previous</a>
			    </li>
			    @for($i = 1; $i <= $pagesNumber; $i++)
			    <li class="page-item {{ $page == $i ? 'active' : '' }}">
			      <a class="page-link" href="{{ url('admin/certified') }}?page={{ $i }}">{{ $i }} <span class="sr-only">{{ $page == $i ? '(current)' : '' }}</span></a>
			    </li>
			    @endfor
			    <li class="page-item {{ $page == $pagesNumber ? 'disabled' : '' }}">
			      <a class="page-link" href="{{ $page == $pagesNumber ? '#' : url('admin/certified') . '?page=' . ($page + 1) }}">Next</a>
			    </li>
			  </ul>
			</nav>
		@endif
 	</div>
</div>

@endsection