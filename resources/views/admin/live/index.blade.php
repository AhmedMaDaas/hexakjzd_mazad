@extends('admin.index')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/alllive.css">
<style type="text/css">

	.liveform input{
		width: 100% !important;
	}

	.liveform table tr th:first-child{
		width: 25%;
	}

	.paginate{
	  	margin: auto;
		width: 35%;
	  	margin-top: 30px
	}

	.page-link{
	    border: 2px solid #257bce;
	}

	.page-item.active .page-link{
		background-color: var(--maincolor);
		border:2px solid var(--maincolor);
	}

</style>
@endpush

@push('js')
<script src="{{ url('/') }}/admin_design/js/alllive.js"></script>

<script type="text/javascript">
	
	function deleteLive(id, load, row){
		$.ajax({
			url: "{{ url('/admin') }}/lives/delete",
			type: 'post',
			data: {
				_token: '{{ csrf_token() }}',
				id: id
			},
			success: function(data){
				console.log(data);
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
			$(this).parent('td').find('input').attr('name', $(this).parent('td').attr('id') + '[' + id + '][]');
		});

		$(document).on('click', '.delimg', function(){
			$(this).addClass('hidden');
			var id = $(this).parent('td').parent('tr').attr('id');
			var load = $(this).next('.load');
			var row = $(this).parent(".d").parent("tr");
			load.removeClass('hidden');
			deleteLive(id, load, row);
		});

	});

</script>
@endpush

	<div class="info">
        <div class="basic">
        	<input type="hidden" name="url" value="{{ url('/') }}">
			<div class="basicform">
				<p class="alllivep">{{ trans('admin.all_lives') }}</p>
				<p class="newl"><a href="{{ url('/admin/lives/new') }}">{{ trans('admin.new') }}</a></p>
				<p class="editl">{{ trans('admin.edit') }}</p>
				<p class="deletel">{{ trans('admin.delete') }}</p>
			</div>
		
			<form action="{{ url('/admin/lives/update') }}" method="POST" class="liveform">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">
				<table>
					<tr>
						<th>{{ trans('admin.date_and_time') }}</th>
						<th>{{ trans('admin.timer') }}</th>
						<th>{{ trans('admin.description') }}</th>
						<th>{{ trans('admin.initial_views') }}</th> 
						<th>{{ trans('admin.opening_value') }}</th> 
						<th>{{ trans('admin.cheat_likes') }}</th>
						<th>{{ trans('admin.bargaining_value') }}</th>
					</tr>
					@foreach($lives as $live)
					<tr id="{{ $live->id }}">
						<td id="live_start" class="d">{{ getDateAndTime($live->live_start) }}</td>
						<td id="timer">{{ $live->timer }}</td>
						<td id="description">{{ $live->description }}</td>
						<td id="cheat_views">{{ $live->cheat_views }}</td>
						<td id="min_value">{{ $live->min_value }}</td>
						<td id="cheat_likes">{{ $live->cheat_likes }}</td>
						<td id="bargaining_value">{{ $live->bargaining_value }}</td>
					</tr>
					@endforeach
				</table>
				<button class="submit">{{ trans('admin.submit') }}</button>

				@if($pagesNumber > 1)
					<nav aria-label="..." class="paginate">
					  <ul class="pagination">
					    <li class="page-item {{ $page > 1 ? '' : 'disabled' }}">
					      <a class="page-link" href="{{ $page > 1 ? url('admin/lives') . '?page=' . ($page - 1) : '#' }}">Previous</a>
					    </li>
					    @for($i = 1; $i <= $pagesNumber; $i++)
					    <li class="page-item {{ $page == $i ? 'active' : '' }}">
					      <a class="page-link" href="{{ url('admin/lives') }}?page={{ $i }}">{{ $i }} <span class="sr-only">{{ $page == $i ? '(current)' : '' }}</span></a>
					    </li>
					    @endfor
					    <li class="page-item {{ $page == $pagesNumber ? 'disabled' : '' }}">
					      <a class="page-link" href="{{ $page == $pagesNumber ? '#' : url('admin/lives') . '?page=' . ($page + 1) }}">Next</a>
					    </li>
					  </ul>
					</nav>
				@endif

			</form>
		</div>
	</div>
@endsection