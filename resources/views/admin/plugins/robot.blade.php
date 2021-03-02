<tr id="{{ $robot->id }}">  
    <td id="p"><img class="{{ $hidden }}" src="{{ url('/') }}/admin_design/images/edit%20(1).png" id="edit">
    	{{ $robot->name }}<input class="hidden" name="name" type="text">
    </td>
    <td class="pimage">
    	<img class="contentt  {{ $hidden }}" src="{{ url('/') }}/admin_design/images/edit%20(1).png" id="edit">
    	<img src="{{ url('/storage/' . $robot->photo) }}">
		<input class="hidden" type="file" name="photo" hidden>
	</td>
	<td class="checkedit">
		<img class="editimg  hidden" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i>
	</td>
	<td class="checkdelete">
		<img class="deletimg  hidden" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i>
	</td>
</tr>