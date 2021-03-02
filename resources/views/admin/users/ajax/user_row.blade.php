<tr id="{{ $user->id }}" class="{{ $user->attention == 'attention2' ? 'block' : '' }}">
	<td>{{ $user->name }}</td>
	<td>{{ $user->phone }}</td>
	<td>{{ getOnlyDate($user->created_at) }}</td>
	<td class="Approval">
		<img id="attention1" src="{{ url('/') }}/admin_design/images/dry-clean.png" style='cursor:pointer' class="attention {{ $user->attention == 'attention1' || $user->attention == 'attention2' ? 'filter-red' : '' }}">
		<i class='fa fa-spin fa-spinner load hidden'></i>
		<img id="attention2" src="{{ url('/') }}/admin_design/images/dry-clean.png" style='cursor:pointer' class="attention {{ $user->attention == 'attention2' ? 'filter-red' : '' }}">
	</td>
	<td class="block">
		<i class='fa fa-spin fa-spinner load hidden'></i>
		<img src="{{ url('/') }}/admin_design/images/{{ $user->blocked ? 'blockr.png' : 'blockg.png' }}" style='cursor:pointer' class="{{ $user->blocked ? 'bimg' : 'unbimg' }}">
	</td>
</tr>