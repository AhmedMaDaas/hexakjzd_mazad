<div class="comments-container">
    <div class="comments">
        <!-- Comment -->
        @foreach($commints as $commint)
        <?php $userSharedLive = $live->shares->contains('user_id',$commint->user->id); ?>
        <div class="media comment {{$commint->id}}" id="{{$commint->id}}">
            @if($commint->user->fake)
                <img src="{{url('/storage/'.$commint->user->photo)}}"  alt="user" class="user-image">
            @else
                <img src="{{url('/storage/'.$commint->user->photo)}}"  alt="user" class="user-image">
            @endif
            
            <div class="media-body comment-body">
                @if($commint->user->approval)
                    <span class="mt-0 name" style="color: #257BCE">{{$commint->user->name}}</span>
                @else
                    <span class="mt-0 name">{{$commint->user->name}}</span>
                @endif
                <p class="content">{{$commint->commint}}</p>
                <input type="hidden" value="1" class="comment-id">
                <div class="control-icons">
                    @if($commint->user_id == session('login'))
                        <img src="{{url('/')}}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                        <a href="#" class="delete-icon" data-toggle="modal" data-target="#deleteModal"><img src="{{url('/')}}/icons/delete-24px.svg" class="filter-medgray"></a>
                        
                    @endif

                    @if($userSharedLive)
                        <img src="{{url('/')}}/icons/share-24px.svg" class="filter-base"> 
                    @endif
                </div>
                <div class="date-time">
                    <span>{{$commint->created_at}}</span>
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
                        <span>{{count($commint->child)}} reply</span>
                    </div>
                    <?php

                        $userLikedCommint = $commint->interactions->contains('user_id',session('login'));
                        $interactionByUser = false;
                        if($userLikedCommint){
                            foreach ($commint->interactions as $key => $userInteraction) {
                                if($userInteraction->user_id == session('login')){
                                    $interactionByUser = $userInteraction->interaction_id;
                                    break;
                                }
                            }
                        }
                    ?>
                    <div class="reactions">
                        
                        
                        @foreach($interactions as $interaction)
                            <?php
                                if($commint->interactions->groupBy('interaction_id')->has($interaction->id))
                                    $sum = $commint->interactions->groupBy('interaction_id')->get($interaction->id)->count();
                                else
                                    $sum = 0;
                             ?>
                             @if($interaction->id == $interactionByUser)
                                 <a href="#">
                                    <img src="{{url('/storage/'.$interaction->icon)}}" class="{{$interaction->id}} react" data-container="body" data-toggle="popover" data-placement="top" data-content="{{$sum}} reactions" data-trigger="hover">
                                </a>
                             @else
                                <a href="#">
                                    <img src="{{url('/storage/'.$interaction->icon)}}" class="{{$interaction->id}}" data-container="body" data-toggle="popover" data-placement="top" data-content="{{$sum}} reactions" data-trigger="hover">
                                </a>
                             @endif
                            <!-- <a href="#"><img src="{{url('/storage/'.$interaction->icon)}}" class="{{$interaction->id}}" data-container="body" data-toggle="popover" data-placement="top" data-content="{{$sum}} reactions" data-trigger="hover"></a> -->
                        @endforeach
                        <!-- <a href="#"><img src="{{url('/')}}/icons/angry.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                        <a href="#"><img src="{{url('/')}}/icons/wow.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                        <a href="#"><img src="{{url('/')}}/icons/sad.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                        <a href="#"><img src="{{url('/')}}/icons/haha.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                        <a href="#"><img src="{{url('/')}}/icons/love.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                        <a href="#"><img src="{{url('/')}}/icons/like.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="3 reactions" data-trigger="hover"></a> -->
                        <span class="all-react">{{$commint->likes}}</span>
                    </div>
                    <audio src="{{url('/')}}/sounds/Tiny%20Button%20Push-SoundBible.com-513260752.mp3" id="react-sound"></audio>
                    
            </div>
            
            <div class="replies">
                @if(count($commint->child))
                    <div class="replace_reply_here"></div>
                    @foreach($commint->child as $child)
                    <?php $userSharedLive = $live->shares->contains('user_id',$child->user->id); ?>
                        <div class="media reply {{$child->id}}" id="{{$child->id}}">
                            @if($child->user->fake)
                                <img src="{{url('/storage/'.$child->user->photo)}}"  alt="user" class="user-image">
                            @else
                                <img src="{{url('/storage/'.$child->user->photo)}}"  alt="user" class="user-image">
                            @endif
                            
                            <div class="media-body reply-body">
                                @if($child->user->approval)
                                    <span class="mt-0 name" style="color: #257BCE">{{$child->user->name}}</span>
                                @else
                                    <span class="mt-0 name">{{$child->user->name}}</span>
                                 @endif
                                <p class="content">{{$child->commint}}</p>
                                <input type="hidden" value="1" class="reply-id">
                                <div class="control-icons">
                                    @if($child->user_id == session('login'))
                                        <img src="{{url('/')}}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                                        <a href="#" class="delete-icon" data-toggle="modal" data-target="#deleteModal"><img src="{{url('/')}}/icons/delete-24px.svg" class="filter-medgray"></a>
                                    @endif

                                    @if($userSharedLive)
                                        <img src="{{url('/')}}/icons/share-24px.svg" class="filter-base">  
                                    @endif
                                </div>
                                <div class="date-time">
                                    <span>{{$child->created_at}}</span>
                                </div>
                            </div>
                            <form class="edit-reply-form">
                                <input type="text" class="reply-content">
                                <input type="hidden" class="reply-id">
                                <button type="button" class="form-btn"><img src="{{url('/')}}/icons/send-24px.svg" class="filter-darkgray"></button>
                            </form>
                        </div>

                    @endforeach

                    
                    <a href="#" class="show-more">Show more replies <img src="{{url('/')}}/icons/keyboard_arrow_down-24px.svg" class="filter-blue"></a>
                @else
                    <div class="replace_reply_here"></div>
                    <a href="#" class="show-more">Show more replies <img src="{{url('/')}}/icons/keyboard_arrow_down-24px.svg" class="filter-blue"></a>
                @endif
                
                
                <form class="reply-form">
                    <input type="hidden" class="commint-id" value="{{$commint->id}}">
                    <input type="text" class="reply-input" placeholder="Write a reply..." required>
                    <button type="button" class="form-btn"><img src="{{url('/')}}/icons/send-24px.svg" class="filter-darkgray"></button>
                </form>
            </div>
            
            
          </div>
        @endforeach
        <div id="replace_commint_here" class="replace_commint_here"></div>
        
        <!-- Comment -->
    </div>
    <form class="add-comment" action="{{ url('/') }}/add-commint" method="post">
        {{csrf_field()}}
        <input type="text" name="commint" id="commint" placeholder="Write a comment..." class="content" required>
        <button type="button" name="add-comment" id="submit-btn" class="form-btn add-commint"><img src="{{url('/')}}/icons/send-24px.svg" class="filter-darkgray"></button>
        <button type="button" class="form-btn toggle-input"><img src="{{url('/')}}/icons/attach_money-24px.svg" class="filter-darkgray"></button>
        @if(isset($bigValue))
        <input type="button" value="{{$live->bargaining_value + $bigValue->price}}$" id="direct-value" class="direct-value" name="direct-value" data-container="body" data-toggle="popover" data-placement="top" data-content="fast offer" data-trigger="hover">
        @else
        <input type="button" value="{{$live->min_value}}$" id="direct-value" class="direct-value" name="direct-value" data-container="body" data-toggle="popover" data-placement="top" data-content="fast offer" data-trigger="hover">
        @endif
    </form>
</div>