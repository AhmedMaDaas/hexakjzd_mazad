<tr id="{{ $robotComment->id }}">  
	<td id="p"><img class="{{ $hidden }}" src="{{ url('/') }}/admin_design/images/edit%20(1).png" id="edit">
		{{ $robotComment->comment }}
		<input class="hidden" type="text" name="comment" value="{{ $robotComment->comment }}">
	</td>
    <td class="uselect">
	<select id="{{ $robotComment->id }}" class="js-example-basic-single new-select" name="users[]">

	</select>
	</td>
	<td id="p" class="timer">
		<img class="{{ $hidden }}" src="{{ url('/') }}/admin_design/images/edit%20(1).png" id="edit">
		{{ isset($robotComment->timer) ? $robotComment->timer : trans('admin.unset') }}
		<input class="hidden" type="text" name="timer" value="{{ $robotComment->timer }}" placeholder="02:40:00">
	</td>
	<td class="checknew"><img class="newimg" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
	<td class="checkedit"><img  class="editimg" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
	<td class="checkdelete"><img class="deletimg" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
</tr>

@if($hidden == 'hidden')
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
@endif