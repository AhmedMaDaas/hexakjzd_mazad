@extends('admin.index')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/main.css">
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/allsignin.css">
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/shared.css">

<style type="text/css">
	.basic table tr.block td{
		color: red
	}
</style>
@endpush

@push('js')
<script src="{{ url('/') }}/admin_design/js/allsignin.js"></script>

<script type="text/javascript">
	var winnerId = 0;

	function confirmWinner(id, load){
		$.ajax({
			url: "{{ url('/') }}/admin/confirm-winner",
			type: 'post',
			data: {
				id: id,
				_token: "{{ csrf_token() }}"
			},
			success: function(data){
				load.addClass('hidden');
				var number = data.number == null ? '{{ trans("admin.unset") }}' : data.number;
				$('.final-winner span').text(data.name + ' : ' + number);
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}

	function chooseWinner(load){
		$.ajax({
			url: "{{ url('/') }}/admin/choose-winner",
			type: 'post',
			data: {
				_token: "{{ csrf_token() }}"
			},
			success: function(data){
				load.addClass('hidden');
				var number = data.number == null ? '{{ trans("admin.unset") }}' : data.number;
				$('#n span').text(data.name + ' : ' + number);
				winnerId = data.id;
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}
	
	$(document).ready(function(){

		$(document).on('click', '.chose', function(){
			$('#n span').text('');
			var load = $('#n .load');
			load.removeClass('hidden');
			chooseWinner(load);
		});

		$(document).on('click', '.confirm-winner', function(){
			$('.final-winner span').text('');
			var id = winnerId;
			var load = $('.final-winner .load');
			load.removeClass('hidden');
			confirmWinner(id, load);
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
		<button class="chose btn btn-primary" data-toggle="modal" data-target="#exampleModal">{{ trans('admin.chose_winner') }}</button>
	</div>
    <div class="basic">

		<div class="basicform">
			<p class="allsignin">{{ trans('admin.who_shared') }}</p>
			<p class="final-winner"><i class="fa fa-spin fa-spinner load hidden"></i><span>{{ isset($winner) ? $winner->name  . ' : '  : '' }} {{ isset($winner) && isset($winner->phone) ? $winner->phone : trans('admin.unset') }}</span></p>
		</div>

		<table>
		 	<tr>
				<th>{{ trans('admin.name_customer') }}</th> 
				<th>{{ trans('admin.number_customer') }}</th>
				<th>{{ trans('admin.location') }}</th> 
			</tr>
			@foreach($users as $user)
				<tr id="{{ $user->id }}" class="{{ $user->attention == 'attention2' ? 'block' : '' }}">
					<td>{{ $user->name }}</td>
					<td>{{ $user->phone }}</td>
					<td>{{ $user->location }}</td>
				</tr>
			@endforeach
		</table>
 	</div>

 	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	       <img src="{{ url('/') }}/admin_design/images/c143ac465ef08b2f74cc0a84c1774e31.jpg">
			  <p class="winner">{{ trans('admin.the_winner') }}</p>
			  <p id="n"><i class='fa fa-spin fa-spinner load hidden'></i><span></span></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="confirm-winner btn btn-primary" data-dismiss="modal">{{ trans('admin.save') }}</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.close') }}</button>
	      </div>
	    </div>
	  </div>
	</div>

</div>

@endsection