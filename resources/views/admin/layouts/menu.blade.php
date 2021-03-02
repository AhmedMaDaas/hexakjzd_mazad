<div class="sidebar">
    <div class="logo">
		<img src="{{ Storage::has(settings()->site_logo) ? url('/storage/' . settings()->site_logo) : url('/admin_design/images/ring.png') }}">
	  <p class="house">{{ settings()->auction_name }}</p>
	 </div>
	 <hr class="line">
	 <div class="multiple">
	 	<ul class="multi">
			<li class="settings"><img src="{{ url('/') }}/admin_design/images/mechanical-gears-.png"><a href="{{ url('/admin/settings') }}" class="{{ activeLink('settings') }}">{{ trans('admin.settings') }}</a>
			
			</li>
			<li class="alive"><img src="{{ url('/') }}/admin_design/icon/ondemand_video-24px.svg" class="filter-blue"><a class="{{ activeLink('lives') }}" href="#">{{ trans('admin.live') }}</a><span></span>
			<ul class="aliveul">
			    <li class="currentlive"><a href="{{ url('/admin/rt-live') }}">{{ trans('admin.current_live') }}</a></li>
			    <li class="newlive"><a href="{{ url('/admin') }}/lives/new">{{ trans('admin.new_live') }}</a></li>
			    <li class="alllive"><a href="{{ url('/admin/lives') }}">{{ trans('admin.all_lives') }}</a></li> 
			</ul>
			</li>
			<li class="robot"><img src="{{ url('/') }}/admin_design/images/settings.png"><a class="{{ activeLink('robots') }}" href="#">{{ trans('admin.robots') }}</a>
			 	<ul class="robotul">
				   <li class="user"><a href="{{ url('/admin') }}/robots">{{ trans('admin.users') }}</a></li>
				   <li class="comment"><a href="{{ url('/admin') }}/robots/comments">{{ trans('admin.comment') }}</a></li>
				</ul>
			</li>
			<li class="signin"><img src="{{ url('/') }}/admin_design/images/group.png"><a class="{{ activeLink('signed') }}" href="{{ url('/admin/signed') }}">{{ trans('admin.all_signin') }}</a></li>
			<li class="certified"><img src="{{ url('/') }}/admin_design/icon/how_to_reg-black-48dp.svg" class="filter-blue"><a class="{{ activeLink('certified') }}" href="{{ url('/admin/certified') }}">{{ trans('admin.all_certified') }}</a></li>
			<li class="notcertified"><img src="{{ url('/') }}/admin_design/icon/person_off-24px.svg" class="filter-blue"><a class="{{ activeLink('uncertified') }}" href="{{ url('/admin/uncertified') }}">{{ trans('admin.not_certified') }}</a></li>
			<li class="notcertified"><img src="{{ url('/') }}/admin_design/images/share.png"><a class="{{ activeLink('shared') }}" href="{{ url('/admin/shared') }}">{{ trans('admin.who_shared') }}</a></li>
			<li class="notcertified"><img src="{{ url('/') }}/admin_design/icon/store-24px.svg" class="filter-blue"><a class="{{ activeLink('store') }}" href="#">{{ trans('admin.store') }}</a></li>
		</ul>
	</div>
</div>