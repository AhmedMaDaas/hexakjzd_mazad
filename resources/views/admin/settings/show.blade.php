@extends('admin.index')

@section('content')

@push('css')
	<link href="{{ url('/') }}/admin_design/css/dropzone.min.css" rel="stylesheet" />

	<style type="text/css">
		.dropzone {
		    width: 100%;
		}

		.dropzone .dz-preview .dz-image img{
			width: 100%;
			height: 100%;
		}

		.dropzone .dz-preview .dz-remove {
		    color: #004485;
		}

		.auction_name{
			display: flex;
    		flex-direction: row;
		}

		.auction_name p{
			font-size: 20px;
		}

		.auction_name img{
			cursor: pointer;
			width: 18px;
		    height: 18px;
		    cursor: pointer;
		    margin-left: 5px;
		    margin-top: 5px;
		}
	</style>
@endpush

<div class="info">
    <div class="basic">
		<div class="Basicinfo">
			<a href="#" class="binfo">{{ trans('admin.basic_information') }}</a>
			<a href="#" class="linfo">{{ trans('admin.live_information') }}</a>
		</div>
		<form action="{{ url('/admin/settings/update-base-info/' . $settings->id) }}" method="POST" class="formbasic" enctype="multipart/form-data">
			{{ csrf_field() }}
			<label>{{ trans('admin.auction_name') }}</label>
			<div class="auction_name">
				<input class="hidden" type="text" name="auction_name" value="{{ $settings->auction_name }}">
				<p class="wmessage">{{ $settings->auction_name }}</p>
				<img src="{{ url('/') }}/admin_design/images/edit%20(1).png">
			</div>

			<label>{{ trans('admin.site_logo') }}</label>
			<div class="site_logo_section">
				<input type="file" name="site_logo" class="site_logo" hidden>
				<div class="advphoto">
					<img src="{{ Storage::has($settings->site_logo) ? url('/storage/' . $settings->site_logo) : url('/admin_design/images/ring.png') }}">
				</div>
				<img id="site_logo" src="{{ url('/') }}/admin_design/images/camera%20(1).png" class="camera">
			</div>

			<label>{{ trans('admin.welcome_message') }}</label>
			<div class="wmsg"> <!-- اذا في داتا قبل -->
				<input type="text" name="welcome_text_message" class="welcome" value="{{ $settings->welcome_text_message }}">
				<p class="wmessage">{{ $settings->welcome_text_message }}</p>
				<img src="{{ url('/') }}/admin_design/images/edit%20(1).png" id="edit">
			</div>
				
			<div class="waud">
				<audio src="{{ isset($settings->welcome_voic_message) && Storage::has($settings->welcome_voic_message) ? url('/storage/' . $settings->welcome_voic_message) : '' }}" controls  loop preload="auto" class="audio"></audio>
				<img src="{{ url('/') }}/admin_design/icon/upload.svg" class="speaker" style="margin-top:10px;margin-left:5px">
				<input id="welcome" type="file" onchange="uploadFile('welcome')" name="welcome_voic_message" class="fileaudio" multiple hidden>
			</div>

			<progress class="hidden welcome" id="progressBarwelcome" value="0" max="100" style="width:300px;padding-top: 27px;"></progress>
				

			<label>{{ trans('admin.advertising_photo') }}</label>
			<div class="advphoto">
				<div class="dropzone" id="dropzoneFileUpload"></div>
			</div>
			<button class="submit">{{ trans('admin.submit') }}</button>
	
		</form>
		<form action="{{ url('/admin/settings/update-live-info/' . $settings->id) }}" method="POST" class="formlive" enctype="multipart/form-data" novalidate>
			{{ csrf_field() }}
			<label class="welcome">{{ trans('admin.whatsApp_numebr') }}</label>
			<input type="text" name="whatsapp_number" class="welcomeinput" value="{{ $settings->whatsapp_number }}">
			
			<label>{{ trans('admin.voic_before_live') }}</label>
			<div class="waud">
				<audio src="{{ isset($settings->voic_before_live) && Storage::has($settings->voic_before_live) ? url('/storage/' . $settings->voic_before_live) : '' }}" controls  loop preload="auto" class="audio"></audio>
				<img src="{{ url('/') }}/admin_design/icon/upload.svg" class="speaker" style="margin-left:5px">
				<input id="live" type="file" onchange="uploadFile('live')" name="voic_before_live" class="fileaudio" multiple hidden>
			</div>

			<progress class="hidden live" id="progressBarlive" value="0" max="100" style="width:300px;padding-top: 27px;"></progress>

			<label>{{ trans('admin.product_control') }}</label>
			<table>
				<tr>
					<th>{{ trans('admin.product') }}</th>
					<th>{{ trans('admin.image') }}</th>
				    <th class="new">{{ trans('admin.new') }}</th>
					<th class="edit">{{ trans('admin.edit') }}</th>
					<th class="delete">{{ trans('admin.delete') }}</th>
				</tr>

				@foreach($storeLinks as $storeLink)
					@include('admin.plugins.store_link', ['storeLink' => $storeLink, 'hidden' => 'hidden'])
				@endforeach

			</table>
			<button class="submit">{{ trans('admin.submit') }}</button>
		</form>
    </div>
</div>

@push('js')
<script src="{{ url('/') }}/admin_design/js/dropzone.min.js"></script>
<script src="{{ url('/') }}/admin_design/js/upload_file.js"></script>

<script type="text/javascript">
	function updateStoreLink(id, name, image, row, load){
		var formData = new FormData();
	    formData.append('id', id);
	    formData.append('name', name);
	    formData.append('image', image);
	    formData.append('_token', '{{ csrf_token() }}');

		$.ajax({
			url: "{{ url('/admin') }}/settings/update-store-link",
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

	function addStoreLink(name, image, row, load){
		var formData = new FormData();
	    formData.append('name', name);
	    formData.append('image', image);
	    formData.append('_token', '{{ csrf_token() }}');

		$.ajax({
			url: "{{ url('/admin') }}/settings/add-store-link",
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

	function deleteStoreLink(id, row, load){
		$.ajax({
			url: "{{ url('/admin') }}/settings/delete-store-link",
			type: 'post',
			data: {
				id: id,
				_token: '{{ csrf_token() }}',
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
			var image = $(this).parent('td').parent('tr').find('input[name="image"]')[0].files[0];
			var row = $(this).parent('td').parent('tr');
			var load = $(this).next('i');load.removeClass('hidden');
			updateStoreLink(id, name, image == null ? '' : image, row, load);
		});

		$(document).on('click', '.newimg', function(){
			var name = $(this).parent('td').parent('tr').find('input[name="name"]').val();
			var image = $(this).parent('td').parent('tr').find('input[name="image"]')[0].files[0];
			var row = $(this).parent('td').parent('tr');
			var load = $(this).next('i');load.removeClass('hidden');
			addStoreLink(name, image, row, load);
		});

		$(document).on('click', '.deletimg', function(){
			var id = $(this).parent('td').parent('tr').attr('id');
			var row = $(this).parent('td').parent('tr');
			var load = $(this).next('i');load.removeClass('hidden');
			deleteStoreLink(id, row, load);
		});

		$(document).on('click', '.auction_name img', function(){
			$(this).hide();
			var value=$(".info .basic .formbasic .auction_name p").text();
			$(".info .basic .formbasic .auction_name p").remove();
			$(this).siblings("input[type=text]").show();
			$(".info .basic .formbasic .auction_name input[type=text]").val(value);
		});

	});

</script>

<script type="text/javascript">
	Dropzone.autoDiscover = false;
	$(document).ready(function(){

		$('#dropzoneFileUpload').dropzone({
			url:'{{ url("admin/settings/add-advertisement") }}',
			paramName:'addPhoto',
			uploadMultiple:false,
			maxFiles:15,
			maxFilessize:5,
			acceptedFiles:'image/*',
			dictDefaultMessage:'{{ trans("admin.drop_files_here") }}',
			dictRemoveFile:'{{ trans("admin.remove_file") }}',
			params: {
				_token: '{{ csrf_token() }}',
				sId: '{{ $settings->id }}'
			},
			addRemoveLinks: true,
			removedfile:function(addPhoto){
				$.ajax({
					url: '{{ url("admin/settings/delete-advertisement") }}',
					type: 'POST',
					data: {
						_token: '{{ csrf_token() }}',
						id: addPhoto.id,
					},
				});

				var fmock;
				return (fmock = addPhoto.previewElement) != null ? fmock.parentNode.removeChild(addPhoto.previewElement) : void 0;
			},
			init:function(){
				@foreach($settings->addPhotos as $addPhoto)
					var mock = {name: '{{ $addPhoto->name }}', id: '{{ $addPhoto->id }}', size: '{{ $addPhoto->size }}', type: '{{ $addPhoto->mimeType }}'};
					this.emit('addedfile', mock);
					this.options.thumbnail.call(this, mock, '{{ url("storage/" . $addPhoto->photo) }}');
				@endforeach

				this.on('sending', function(addPhoto, xhr, formData){
					formData.append('id', '');
					addPhoto.id = '';
				});

				this.on('success', function(addPhoto, data){
					addPhoto.id = data;
				});
			}
		});

	});
</script>
@endpush

@endsection