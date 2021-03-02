<tr id="{{ $storeLink->id }}">
    <td id="p"><img class="{{ $hidden }}" src="{{ url('/') }}/admin_design/images/edit%20(1).png" id="edit">
    	{{ $storeLink->name }}
    	<input class="hidden" type="text" name="name">
    </td>
    <td class="pimage"><img class="contentt {{ $hidden }}" src="{{ url('/') }}/admin_design/images/edit%20(1).png" id="edit">
    	<img src="{{ url('/storage/' . $storeLink->image) }}">
		<input class="hidden" type="file" name="image" hidden>
	</td>
	<td class="newedit"><img class="newimg  hidden" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
    <td class="checkedit"><img class="editimg  hidden" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
    <td class="checkdelete"><img class="deletimg  hidden" src="{{ url('/') }}/admin_design/images/check.png"><i class="fa fa-spin fa-spinner hidden"></i></td>
</tr>