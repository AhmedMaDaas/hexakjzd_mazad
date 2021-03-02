@extends('admin.index')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/main.css">
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/robotcomment.css">
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/select2.min.css">

<style type="text/css">

	.select2-container{
		width: 100% !important;
	}

</style>
@endpush

@push('js')
<script src="{{ url('/') }}/admin_design/js/robotcomment.js"></script>
<script src="{{ url('/') }}/admin_design/js/select2.min.js"></script>

<script type="text/javascript">

	function getUsers(){
		var users = [
	    @foreach($robots as $key => $robot)
	        {
	            "id": "{{ $robot->id }}",
	          	"text": "{{ $robot->name }}",
	          	"selected": false,
	          	"comments": [
	        	@foreach($robot->robotsCommints as $key => $robotCommint)
	        		{
	        			"{{ $robotCommint->comment_for_robot_id }}": "{{ $key }}",
	        		},
	        	@endforeach
		        ],
	        },
	    @endforeach
	    ];
	    return users;
	}

	function checkSelected(ids, commentId){
		for(var i = 0; i < ids.length; i++){
			for(var id in ids[i]){
				if(id == commentId) return true;
			}
		}
		return false;
	}

	function chooseSelected(commentId){
		var robots = getUsers();
		for(var i = 0; i < robots.length; i++) {
		    robots[i].selected = checkSelected(robots[i].comments, commentId);
		}
		return robots;
	}

	function chooseCustom(usersIds){
		var robots = getUsers();
		for(var i = 0; i < robots.length; i++) {
		    robots[i].selected = usersIds.includes(robots[i].id);
		}
		return robots;
	}
	
	function addUpdateComment(url, id, comment, users, timer, row, load){
		$.ajax({
			url: "{{ url('/') }}/admin/robots/" + url,
			type: 'post',
			data: {
				'_token': '{{ csrf_token() }}',
				'comment': comment,
				'users': users,
				'timer': timer,
				'id': id
			},
			success: function(data){
				load.addClass('hidden');
				row.replaceWith(data.view);
				$('.new-select').select2({data: chooseCustom(data.users), tags: "true", multiple:"true"});
          		$('.new-select').select2().trigger('change');
          		if(id !== null) {$('.editimg').hide(); console.log('tr#' + id + ' .editimg')}
          		$('.new-select').removeClass('new-select');
			},
			error: function(xhr){
				load.addClass('hidden');
			}
		});
	}

	function deleteComment(id, row, load){
		$.ajax({
			url: "{{ url('/') }}/admin/robots/delete-comment",
			type: 'post',
			data: {
				'_token': '{{ csrf_token() }}',
				'id': id
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
		$('.js-example-basic-single').each(function(){
			$(this).select2({
			    tags: "true",
			  	multiple:"true",
			  	data: chooseSelected($(this).attr('id'))
			});
		});

		$(document).on('click', '.newimg', function(){
			var comment = $(this).parent('td').parent('tr').find('input[name="comment"]').val();
			var users = $(this).parent('td').parent('tr').find('select').val();
			var timer = $(this).parent('td').parent('tr').find('input[name="timer"]').val();
			var row = $(this).parent('td').parent('tr');
			var load = $(this).next('i');load.removeClass('hidden');
			addUpdateComment('add-comment', null, comment, users, timer, row, load);
		});

		$(document).on('click', '.editimg', function(){
			var id = $(this).parent('td').parent('tr').attr('id');
			var comment = $(this).parent('td').parent('tr').find('input[name="comment"]').val();
			var users = $(this).parent('td').parent('tr').find('select').val();
			var timer = $(this).parent('td').parent('tr').find('input[name="timer"]').val();
			var row = $(this).parent('td').parent('tr');
			var load = $(this).next('i');load.removeClass('hidden');
			addUpdateComment('update-comment', id, comment, users, timer, row, load);
		});

		$(document).on('click', '.deletimg', function(){
			var id = $(this).parent('td').parent('tr').attr('id');
			var row = $(this).parent('td').parent('tr');
			var load = $(this).next('i');load.removeClass('hidden');
			deleteComment(id, row, load);
		});

		$(document).on('change', '.js-example-basic-single', function() {
		    var edit = $(this).parent('td').parent('tr').find('.editimg');
		    edit.show();
		    $('tr#new .editimg').hide();
		});

		$(document).on('click', '.search li', function(){
			var column = $(this).attr('id').replace(/^\s+|\s+$/gm,'').toLowerCase();
			$('.search input[name="s"]').val(column);
		});

	});

</script>
@endpush

<div class="info">
	<div class="search">
		<p class="searchby">{{ trans('admin.search_by') }}</p>
		<ul>
			<li id="comment">{{ trans('admin.comment') }}</li>
			<li id="timer">{{ trans('admin.timer') }}</li>
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
		<p class="allsignin">{{ trans('admin.comments') }}</p>
		<table>
			<tr>
				<th>{{ trans('admin.comment') }}</th> 
				<th>{{ trans('admin.users') }}</th>
				<th>{{ trans('admin.timer') }}</th> 
			    <th class="new"><a href="#new">{{ trans('admin.new') }}</a></th>
				<th class="edit">{{ trans('admin.edit') }}</th>
				<th class="delete">{{ trans('admin.delete') }}</th>
			</tr>

			@foreach($robotsComments as $robotComment)
				<tr id="{{ $robotComment->id }}">
					<td id="p"><img class="hidden" src="{{ url('/') }}/admin_design/images/edit%20(1).png" id="edit">
						{{ $robotComment->comment }}
						<input class="hidden" type="text" name="comment" value="{{ $robotComment->comment }}">
					</td>
				    <td class="uselect">
					<select id="{{ $robotComment->id }}" class="js-example-basic-single" name="users[]">

					</select>
					</td>
					<td id="p" class="timer"><img class="hidden" src="{{ url('/') }}/admin_design/images/edit%20(1).png" id="edit">
						{{ isset($robotComment->timer) ? $robotComment->timer : trans('admin.unset') }}
						<input class="hidden" type="text" name="timer" value="{{ $robotComment->timer }}" placeholder="02:40:00">
					</td>
					<td class="checknew"><img class="hidden newimg" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
					<td class="checkedit"><img  class="hidden editimg" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
					<td class="checkdelete"><img class="hidden deletimg" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
				</tr>
			@endforeach
			
			<tr class="newproduct hidden" id="new">  
			    <td id="p">
			    	<input type="text" name="comment">
			    </td>
			    <td class="uselect">
					<select class="js-example-basic-single" name="users[]">

					</select>
				</td>
				<td class="timer"><input type="text" name="timer" placeholder="02:40:00"></td>
				<td class="checknew"><img class="newimg" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
				<td class="checkedit"><img  class="editimg" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
				<td class="checkdelete"><img class="deletimg" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
			</tr>
		</table>
	</div>
</div>

@endsection