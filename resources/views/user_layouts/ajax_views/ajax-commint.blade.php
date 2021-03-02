
    <div class="media comment {{$commintId}}" id="{{$commintId}}">
        @if($fake)
            <img src="{{url('/storage/'.$userPhoto)}}"  alt="user" class="user-image">
        @else
            <img src="{{url('/storage/'.$userPhoto)}}"  alt="user" class="user-image">
        @endif
      <!-- <img src="{{$userPhoto}}"  alt="user" class="user-image"> -->
      <div class="media-body comment-body">
        @if($approval)
            <span class="mt-0 name" style="color: #257BCE">{{$userName}}</span>
        @else
            <span class="mt-0 name">{{$userName}}</span>
        @endif
        <p class="content">{{$commint}}</p>
        <input type="hidden" value="1" class="comment-id">
        <div class="control-icons">
            <input type="hidden" class="user-input" value="{{$userId}}">

            <img src="{{url('/')}}/icons/edit-24px.svg" class="filter-medgray edit-icon">
            <a href="#" class="delete-icon" data-toggle="modal" data-target="#deleteModal"><img src="{{url('/')}}/icons/delete-24px.svg" class="filter-medgray"></a>
            <img src="{{url('/')}}/icons/person_remove_alt_1-24px.svg" class="filter-medgray block-icon" data-toggle="modal" data-target="#blockModal">
            @if($userId == session('login'))
            
            @elseif(auth()->guard('admin')->check())
            
            
            <a href="#" class="delete-icon" data-toggle="modal" data-target="#deleteModal"><img src="{{url('/')}}/icons/delete-24px.svg" class="filter-medgray"></a>
            @endif

            @if($userSharedLive)
            <img src="{{url('/')}}/icons/share-24px.svg" class="filter-base">
            @endif
        </div>
        <div class="date-time">
            <span>{{$created_at}}</span>
        </div>
      </div>
        <form class="edit-comment-form">
            <input type="text" class="comment-content">
            <input type="hidden" class="comment-id">
            <button type="button" class="form-btn"><img src="{{url('/')}}/icons/send-24px.svg" class="filter-darkgray"></button>
        </form>
    </div>
    <!-- replay -->
    <div class="comment-footer">
        <div class="reply-reactions">
                <div class="reply">
                    <img src="{{url('/')}}/icons/reply-24px.svg" class="filter-darkgray">
                    <span>0 reply</span>
                </div>
                <div class="reactions">
                    
                    
                    @foreach($interactions as $interaction)
                        
                        <a href="#">
                            <img src="{{url('/storage/'.$interaction->icon)}}" class="{{$interaction->id}}" data-container="body" data-toggle="popover" data-placement="top" data-content="0 reactions" data-trigger="hover">
                        </a>
                    @endforeach
                    <!-- <a href="#"><img src="{{url('/')}}/icons/angry.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                    <a href="#"><img src="{{url('/')}}/icons/wow.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                    <a href="#"><img src="{{url('/')}}/icons/sad.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                    <a href="#"><img src="{{url('/')}}/icons/haha.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                    <a href="#"><img src="{{url('/')}}/icons/love.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                    <a href="#"><img src="{{url('/')}}/icons/like.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="3 reactions" data-trigger="hover"></a> -->
                    <span class="all-react">0</span>
                </div>
                <audio src="{{url('/')}}/sounds/Tiny%20Button%20Push-SoundBible.com-513260752.mp3" id="react-sound"></audio>
                
        </div>
        
        <div class="replies">
            <!-- here the child commints (replies) -->
            <div class="replace_reply_here"></div>
            
            <a href="#" class="show-more">Show more replies <img src="{{url('/')}}/icons/keyboard_arrow_down-24px.svg" class="filter-blue"></a>
            
            <form class="reply-form">
                <input type="hidden" class="commint-id" value="{{$commintId}}">
                <input type="text" class="reply-input" placeholder="Write a reply..." required>
                <button type="button" class="form-btn"><img src="{{url('/')}}/icons/send-24px.svg" class="filter-darkgray"></button>
            </form>
        </div>
        
        
    </div>
    <div id="replace_commint_here" class="replace_commint_here"  ></div>
