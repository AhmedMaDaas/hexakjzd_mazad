<div class="user-side">
      <div class="user-dropdown">
        <img src="{{url('/storage/'.$user->photo)}}">
        <span class="name">{{$user->name}}</span>
        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{url('/')}}/icons/keyboard_arrow_down-24px.svg" class="filter-lightgray"></a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
          </div>
      </div>
</div>