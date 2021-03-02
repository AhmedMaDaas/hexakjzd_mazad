<div class="replace_reply_here"></div>

<div class="media reply {{$replyId}}" id="{{$replyId}}">
    @if($fake)
        <img src="{{url('/storage/'.$userPhoto)}}"  alt="user" class="user-image">
    @else
        <img src="{{url('/storage/'.$userPhoto)}}"  alt="user" class="user-image">
    @endif
    <!-- <img src="{{$userPhoto}}"  alt="user" class="user-image"> -->
    <div class="media-body reply-body">
        @if($approval)
            <span class="mt-0 name" style="color: #257BCE">{{$userName}}</span>
        @else
            <span class="mt-0 name">{{$userName}}</span>
         @endif
        <p class="content">{{$reply}}</p>
        <input type="hidden" value="1" class="reply-id">
        <div class="control-icons">
            <input type="hidden" class="user-input" value="{{$userId}}">

            <img src="{{url('/')}}/icons/edit-24px.svg" class="filter-medgray edit-icon">
            <a href="#" class="delete-icon" data-toggle="modal" data-target="#deleteModal"><img src="{{url('/')}}/icons/delete-24px.svg" class="filter-medgray"></a>
            <img src="{{url('/')}}/icons/person_remove_alt_1-24px.svg" class="filter-medgray block-icon" data-toggle="modal" data-target="#blockModal">
            @if($userId == session('login'))
            
            @elseif(auth()->guard('admin')->check())
            
            
            <!-- <a href="#" class="delete-icon" data-toggle="modal" data-target="#deleteModal"><img src="{{url('/')}}/icons/delete-24px.svg" class="filter-medgray"></a> -->
            @endif

            @if($userSharedLive)
            <img src="{{url('/')}}/icons/share-24px.svg" class="filter-base">  
            @endif
        </div>
        <div class="date-time">
            <span>{{$created_at}}</span>
        </div>
    </div>
    <form class="edit-reply-form">
        <input type="text" class="reply-content">
        <input type="hidden" class="reply-id">
        <button type="button" class="form-btn"><img src="{{url('/')}}/icons/send-24px.svg" class="filter-darkgray"></button>
    </form>
</div>

