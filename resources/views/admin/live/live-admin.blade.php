<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <title>Live</title>
    <link rel="stylesheet" href="{{url('/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/normalize.css">
    <link rel="stylesheet" href="{{url('/')}}/package/css/swiper.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/hover-min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/user.css?v=0.0.3">
</head>
<body>

    <input type="hidden" name="url" value="{{ url('/') }}">
    <input type="hidden" id="not_user_id" value="{{session('login')}}">
    <input type="hidden" id="user_id" value="{{session('login')}}">
    <meta name="_token" id="meta-token" content="{{ csrf_token() }}">

    <div class="navbar-container mobile-navbar-container">
        <div class="user-side">
              <div class="user-dropdown">
                <img src="{{ url('/storage/' . auth()->guard('admin')->user()->user->photo) }}">
                <span class="name">{{ auth()->guard('admin')->user()->name }}</span>
                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{url('/')}}/icons/keyboard_arrow_down-24px.svg" class="filter-lightgray"></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('/') }}/admin/logout">Logout</a>
                  </div>
              </div>
        </div>
        <a href="{{ url('/') }}/admin/settings" class="back"><img src="{{url('/')}}/icons/arrow_back-24px.svg" class="filter-base"> Back to dashboard</a>
    </div>
    <!-- Start Video And Details -->
        <div class="row mobile-container">
            <div class="video-container col-md-8">
                <p>Live</p>
                <!--<iframe src="WhatsApp%20Video%202020-09-30%20at%209.53.13%20PM.mp4" class="video"></iframe>-->
                <section class="select">
                  <label for="audioSource">Audio source: </label>
                  <select id="audioSource"></select>
                </section>

                <section class="select">
                  <label for="videoSource">Video source: </label>
                  <select id="videoSource"></select>
                </section>
                <video playsinline autoplay muted class="video">
                </video>
                <?php
                  $live->hide_live ? $style='none' : $style='display:none;';
                  $live->hide_live ? $buttonValue='UnHide video' : $buttonValue='Hide video';
                ?>
                <button id="hide-video-btn" class="hide-video-btn">{{$buttonValue}}</button>
                <div class="hide-video hide-video-admin" style='{{$style}}'></div>
                
                <div class="actions">
                    <div class="views">
                        <div class="real-views" data-container="body" data-toggle="popover" data-placement="bottom" data-content="real views" data-trigger="hover">
                            <img src="{{url('/')}}/icons/visibility-24px.svg" class="filter-blue">
                            <span class="real-views-span">{{$live->views}}</span>
                        </div>
                        <div class="robot-views" data-container="body" data-toggle="popover" data-placement="bottom" data-content="robot views" data-trigger="hover">
                            <img src="{{url('/')}}/icons/edit-24px.svg" class="edit-this filter-blue">
                            <img src="{{url('/')}}/icons/visibility-24px.svg" class="filter-darkgray view-icon">
                            <span class="cheat-views-span">{{$live->cheat_views}}</span>
                            <form class="edit-views">
                                <input type="number" class="input-robot-views">
                                <button type="button" class="form-btn"><img src="{{url('/')}}/icons/done-24px%20(1).svg" class="filter-darkgray"></button>
                            </form>
                        </div>
                        <div class="final-views" data-container="body" data-toggle="popover" data-placement="bottom" data-content="final views" data-trigger="hover">
                            <img src="{{url('/')}}/icons/visibility-24px.svg" class="filter-base">
                            <span class="views-span">{{$live->views + $live->cheat_views}}</span>
                        </div>
                    </div>
                    <?php 
                        if($live->live_status == 'not_yet'){
                            $styleStart = 'display:inline;';
                            $styleEnd = 'display:none;';
                        }else{
                            $styleStart = 'display:none;';
                            $styleEnd = 'display:inline;';
                        }

                    ?>
                    <div class="start-live" style="{{$styleStart}}">
                        <a href="#"><img src="{{url('/')}}/icons/play_arrow-24px.svg" class="filter-blue"></a>
                        <span>Start live</span>
                    </div>

                    <div class="end-live" style="{{$styleEnd}}">
                        <a href="#"><img src="{{url('/')}}/icons/stop-24px.svg" class="filter-blue"></a>
                        <span>End live</span>
                    </div>

                    <div class="make-action">
                        <div class="like-this">
                            <div class="real-likes" data-container="body" data-toggle="popover" data-placement="bottom" data-content="real likes" data-trigger="hover">
                                <img src="{{url('/')}}/icons/thumb_up-24px.svg" class="filter-blue">
                                <span class="real-likes-span">{{$live->likes}}</span>
                            </div>
                            <div class="robot-likes" data-container="body" data-toggle="popover" data-placement="bottom" data-content="robot likes" data-trigger="hover">
                                <img src="{{url('/')}}/icons/edit-24px.svg" class="edit-this filter-blue">
                                <img src="{{url('/')}}/icons/thumb_up-24px.svg" class="like-icon filter-darkgray">
                                <span class="robot-likes">{{$live->cheat_likes}}</span>
                                <form class="edit-likes">
                                    <input type="number" class="input-robot-likes">
                                    <button type="button" class="form-btn"><img src="{{url('/')}}/icons/done-24px%20(1).svg" class="filter-darkgray"></button>
                                </form>
                            </div>
                            <div class="final-likes" data-container="body" data-toggle="popover" data-placement="bottom" data-content="final likes" data-trigger="hover">
                                <img src="{{url('/')}}/icons/thumb_up-24px.svg" id="like-on-live" class="filter-base">
                                <span class="likes-span">{{$live->likes + $live->cheat_likes}}</span>
                            </div>
                        </div>
                        <!-- <div class="share-this">
                            <a href="#"><img src="{{url('/')}}/icons/share-24px.svg" class="filter-base"  data-container="body" data-toggle="popover" data-placement="top" data-content="share on facebook" data-trigger="hover"></a>
                        </div>
                        <div class="link-whatsapp">
                            <a href="#"><img src="{{url('/')}}/icons/icons8-whatsapp.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="send informations" data-trigger="hover"></a>
                        </div> -->
                    </div>
                </div>
                <div class="comments-robots">
                    <div class="header">
                        <h4>Robots Comments</h4>
                        <input type="text" placeholder="Type to search for comment...">
                    </div>
                    <div class="comments-robots-container">
                        @foreach($robots as $robot)
                            <div class="card comment-robot">
                              <div class="card-body">
                                <input type="hidden" class="robot-id-input" value="{{$robot->user->id}}">
                                <input type="hidden" class="commint-robot-id-input" value="{{$robot->commint->id}}">
                                <h5 class="card-title">{{$robot->user->name}}</h5>
                                <p class="card-text">{{$robot->commint->comment}}</p>
                                <a href="#" class="btn">Comment Now</a>
                              </div>
                            </div>
                        @endforeach
                        <!-- <div class="card comment-robot">
                          <div class="card-body">
                            <h5 class="card-title">Robot 1</h5>
                            <p class="card-text">mazad mobarak</p>
                            <a href="#" class="btn">Comment Now</a>
                          </div>
                        </div>
                        <div class="card comment-robot">
                          <div class="card-body">
                            <h5 class="card-title">Robot 1</h5>
                            <p class="card-text">Nice!!</p>
                            <a href="#" class="btn">Comment Now</a>
                          </div>
                        </div>
                        <div class="card comment-robot">
                          <div class="card-body">
                            <h5 class="card-title">Robot 1</h5>
                            <p class="card-text">Nice!!</p>
                            <a href="#" class="btn">Comment Now</a>
                          </div>
                        </div>
                        <div class="card comment-robot">
                          <div class="card-body">
                            <h5 class="card-title">Robot 1</h5>
                            <p class="card-text">Nice!!</p>
                            <a href="#" class="btn">Comment Now</a>
                          </div>
                        </div>
                        <div class="card comment-robot">
                          <div class="card-body">
                            <h5 class="card-title">Robot 1</h5>
                            <p class="card-text">Nice!!</p>
                            <a href="#" class="btn">Comment Now</a>
                          </div>
                        </div>
                        <div class="card comment-robot">
                          <div class="card-body">
                            <h5 class="card-title">Robot 1</h5>
                            <p class="card-text">Nice!!</p>
                            <a href="#" class="btn">Comment Now</a>
                          </div>
                        </div>
                        <div class="card comment-robot">
                          <div class="card-body">
                            <h5 class="card-title">Robot 1</h5>
                            <p class="card-text">Nice!!</p>
                            <a href="#" class="btn">Comment Now</a>
                          </div>
                        </div> -->
                    </div>
                    
                </div>
            </div>

            <!-- Modal -->
                <div class="modal fade classl" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="blockModal" aria-hidden="true">
                  <input type="hidden" id="deleted-commint-reply" value="">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        Are you sure you want to delete this comment?
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                    </div>
                  </div>
                </div>

            <!-- Modal -->
                <div class="modal fade class2" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="blockModal" aria-hidden="true">
                  <input type="hidden" id="blocked-person" value="">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        Are you sure you want to block this user?
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
                    if(!is_null($live->timer_pause)){
                        $timerValue = explode(':', $live->timer_pause);
                    }
                ?>
                @if(!is_null($live->timer_pause))
                    <input type="hidden" class="pause-status" value="1">
                @else
                    <input type="hidden" class="pause-status" value="0">
                @endif
                <input type="hidden" class="end_date" value="{{$endTimeOfLive}}">
            
                <input type="hidden" class="start_date" value="{{$live->live_start}}">
            
            <div class="informations-and-comments col-md-4">
                <div class="time-container time-control-container justify-content-center">
                    <img src="{{url('/')}}/icons/edit-24px.svg" class="edit-this filter-blue">
                    <!--  check if the timer is paused when user load the page after the live started  -->
                    @if(!is_null($live->timer_pause))
                        <span class="minutes ending_hours" id="ending_hours" style="display:none">{{$timerValue[0]}}</span>
                        <span class="separator" id="separate" style="display:none">:</span>
                        <span class="seconds" id="ending_minutes">{{$timerValue[1]}}</span>
                        <span class="separator">:</span>
                        <span class="seconds" id="ending_seconds">{{$timerValue[2]}}</span>
                    @else
                        <span class="minutes ending_hours" id="ending_hours" id="ending_hours" style="display:none">15</span>
                        <span class="separator" id="separate" style="display:none">:</span>
                        <span class="seconds" id="ending_minutes">44</span>
                        <span class="separator">:</span>
                        <span class="seconds" id="ending_seconds">44</span>
                    @endif
                    <form class="edit-timer">
                        <div class="jump">
                            <label>Jump</label>
                            <input type="number" value="1">
                        </div>
                        <div class="edit-hours">
                            <button class="plus-btn"><img src="{{url('/')}}/icons/add-24px.svg" class="filter-darkgray"></button>
                            <input type="number" class="hours">
                            <button class="minus-btn"><img src="{{url('/')}}/icons/remove-24px.svg" class="filter-darkgray"></button>
                        </div>
                        <span class="separator">:</span>
                        <div class="edit-minutes">
                            <button class="plus-btn"><img src="{{url('/')}}/icons/add-24px.svg" class="filter-darkgray"></button>
                            <input type="number" class="minutes">
                            <button class="minus-btn"><img src="{{url('/')}}/icons/remove-24px.svg" class="filter-darkgray"></button>
                        </div>
                        <span class="separator">:</span>
                        <div class="edit-seconds">
                            <button class="plus-btn"><img src="{{url('/')}}/icons/add-24px.svg" class="filter-darkgray"></button>
                            <input type="number" class="seconds">
                            <button class="minus-btn"><img src="{{url('/')}}/icons/remove-24px.svg" class="filter-darkgray"></button>
                        </div>
                        <button type="button" class="form-btn"><img src="{{url('/')}}/icons/done-24px%20(1).svg" class="filter-darkgray"></button>
                    </form>
                    <form class="timer-controls">
                        <input type="hidden" name="hours" class="hours-inp">
                        <input type="hidden" name="minutes" class="minutes-inp">
                        <input type="hidden" name="seconds" class="seconds-inp">
                        <button type="button" class="stop"><img src="{{url('/')}}/icons/stop-24px.svg" class="filter-blue"></button>
                        @if(is_null($live->timer_pause))
                            <button type="button" class="pause" name="pause"><img src="{{url('/')}}/icons/pause-24px.svg" class="filter-blue"></button>
                        @else
                            <button type="button" class="pause" name="start"><img src="{{url('/')}}/icons/play_arrow-24px.svg" class="filter-blue"></button>
                        @endif
                        <button type="button" class="restart"><img src="{{url('/')}}/icons/replay-24px.svg" class="filter-blue"></button>
                    </form>
                </div>
                <div class="informations">
                    <div class="prices">
                        <img src="{{url('/')}}/icons/edit-24px.svg" class="edit-this filter-blue">
                        <span class="min">{{$live->min_value}}$</span>
                        <form class="edit-min-price">
                            <input type="number" class="min-price">
                            <button type="button" class="form-btn"><img src="{{url('/')}}/icons/done-24px%20(1).svg" class="filter-darkgray"></button>
                        </form>
                        @if(!is_null($bigValue))
                            <span class="max">{{$bigValue->price}}$</span>
                        @else
                            <span class="max">0$</span>
                        @endif
                    </div>
                    <div class="winner">
                        <p class="pop" id="winner_word" style="visibility:hidden;">Winner!</p>
                        <div class="winner-name">
                            <img src="{{url('/')}}/icons/star-24px.svg" id="winner_star" style="visibility:hidden;" class="filter-gold">
                            @if(!is_null($bigValue))
                                <span class="winner-name-span">{{$bigValue->user->name}}</span>
                            @else
                                <span class="winner-name-span">empty</span>
                            @endif
                        </div>
                    </div>
                </div>

                <?php $userSharedLive = $live->shares->contains('user_id',session('login')); ?>
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
                                    <input type="hidden" class="user-input" value="{{$commint->user_id}}">

                                    @if($commint->user_id == session('login'))
                                        <img src="{{url('/')}}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                                    @else 
                                        <img src="{{url('/')}}/icons/person_remove_alt_1-24px.svg" class="filter-medgray block-icon" data-toggle="modal" data-target="#blockModal">
                                    @endif
                                    
                                    <a href="#" class="delete-icon" data-toggle="modal" data-target="#deleteModal"><img src="{{url('/')}}/icons/delete-24px.svg" class="filter-medgray"></a>
                                    
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
                                    <button type="submit" class="form-btn"><img src="{{url('/')}}/icons/send-24px.svg" class="filter-darkgray"></button>
                                </form>
                            </div>

                            <div class="comment-footer">
                            <div class="reply-reactions">
                                  <div class="reply">
                                    <img src="{{url('/')}}/icons/reply-24px.svg" class="filter-darkgray">
                                    <span>{{count($commint->child)}} reply</span>
                                  </div>
                                    <div class="reactions">
                                       @foreach($interactions as $interaction)
                                            <?php
                                                if($commint->interactions->groupBy('interaction_id')->has($interaction->id))
                                                    $sum = $commint->interactions->groupBy('interaction_id')->get($interaction->id)->count();
                                                else
                                                    $sum = 0;
                                             ?>
                                             
                                                <a href="#">
                                                    <img src="{{url('/storage/'.$interaction->icon)}}" class="{{$interaction->id}}" data-container="body" data-toggle="popover" data-placement="top" data-content="{{$sum}} reactions" data-trigger="hover">
                                                </a>
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
                                                    
                                                    <input type="hidden" class="user-input" value="{{$child->user_id}}">
                                                    
                                                    @if($commint->user_id == session('login'))
                                                        <img src="{{url('/')}}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                                                    @else
                                                        <img src="{{url('/')}}/icons/person_remove_alt_1-24px.svg" class="filter-medgray block-icon" data-toggle="modal" data-target="#blockModal">
                                                    @endif
                                                    <a href="#" class="delete-icon" data-toggle="modal" data-target="#deleteModal"><img src="{{url('/')}}/icons/delete-24px.svg" class="filter-medgray"></a>

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
                    <form class="add-comment">
                        <input type="text" name="commint" id="commint" placeholder="Write a comment..." class="content" required>
                        <button type="button" name="add-comment" id="submit-btn" class="form-btn add-commint"><img src="{{url('/')}}/icons/send-24px.svg" class="filter-darkgray"></button>
                        <button type="button" class="form-btn toggle-input"><img src="{{url('/')}}/icons/attach_money-24px.svg" class="filter-darkgray"></button>
                        @if(!is_null($bigValue))
                        <!-- <input type="button" value="{{$live->min_value + $bigValue->price}}$" id="direct-value" class="direct-value" name="direct-value" data-container="body" data-toggle="popover" data-placement="top" data-content="fast offer" data-trigger="hover"> -->
                        @else
                        <!-- <input type="button" value="{{$live->min_value}}$" id="direct-value" class="direct-value" name="direct-value" data-container="body" data-toggle="popover" data-placement="top" data-content="fast offer" data-trigger="hover"> -->
                        @endif
                    </form>

                    <div class="control-direct-value">
                            <img src="{{url('/')}}/icons/edit-24px.svg" class="edit-this filter-blue">
                            <span class="min-direct">{{$live->bargaining_value}}$</span>
                            <form class="bargaining-value-form">
                                <input type="text" class="bargaining-value-input">
                                <button type="button" class="form-btn"><img src="{{url('/')}}/icons/done-24px%20(1).svg" class="filter-darkgray"></button>
                            </form>
                            <!-- <span class="current-direct-value">150$</span> -->
                    </div>

                </div>
                <form class="audio-controls">
                        <p>Audio Control</p>
                        <button class="stop"><img src="{{url('/')}}/icons/stop-24px.svg" class="filter-blue"></button>
                        @if($welcomeInfo->voic_before_live_status)
                            <button class="pause" name="pause"><img src="{{url('/')}}/icons/pause-24px.svg" class="filter-blue"></button>
                        @else
                            <button class="pause" name="start"><img src="{{url('/')}}/icons/play_arrow-24px.svg" class="filter-blue"></button>
                        @endif
                        <button class="restart"><img src="{{url('/')}}/icons/replay-24px.svg" class="filter-blue"></button>
                </form>
            </div>
            <audio id="live-player">
                <source src="{{url('/storage/'.$welcomeInfo->voic_before_live)}}" type="audio/mp3">
            </audio>
            <!-- Modal -->
            <div class="modal fade live-audio-modal" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    This website contains media, please click allow
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn allow">Allow</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    <!-- End Video And Comments -->
    <script src="{{url('/')}}/js/jquery-3.3.1.min.js"></script>
    <script src="https://hexapi.live/socket.io/socket.io.js"></script>
    <script src="{{ url('/') }}/admin_design/broadcast/js/broadcast.js?v=0.0.31"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{url('/')}}/js/popper.js"></script>
    <script src="{{url('/')}}/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/package/js/swiper.min.js"></script>
    <script src="{{url('/')}}/js/jquery.nicescroll.min.js"></script>
    <script src="{{url('/')}}/js/user.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/user-live.js?v=0.0.3"></script>

    <!-- ajax script -->
    <script src="{{url('/')}}/js/ajax-files/commintByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/directedValueByAjax.js?v=0.0.3"></script>
    <!-- <script src="{{url('/')}}/js/ajax-files/likeOnLiveByAjax.js?v=0.0.3"></script> -->
    <script src="{{url('/')}}/js/ajax-files/likeOnCommintByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/replyByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/editCommintByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/editReplyByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/deleteCommintOrReplyByAjax.js?v=0.0.3"></script>
    <!-- end ajax script -->

    <!-- ajax files for admin -->
    <script src="{{url('/')}}/js/ajax-files/admin/changeLikesByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/admin/blockByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/admin/changeMinValueByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/admin/changeViewsByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/admin/addRobotCommintByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/admin/changeTimerByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/admin/changeBargainingValueByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/admin/startAndEndLiveByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/admin/audioControlByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/admin/hideLiveByAjax.js?v=0.0.3"></script>
    <!-- end admin file -->

    <!-- real time script -->
    <script src="{{url('/')}}/js/real-time-files/setPusher.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/addCommint.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/addReply.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/addValue.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/addLikeOnLive.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/addLikeOnCommint.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/deleteCommint.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/editCommint.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/addView.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/endLive.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/audioControl.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/hideLive.js?v=0.0.3"></script>
    <!-- end real time script -->

    <!-- real time admin files -->
    <script src="{{url('/')}}/js/real-time-files/admin/addRealLiveLikes.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/admin/blockUser.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/admin/addRealViews.js?v=0.0.3"></script>
    <!-- end admin files -->

    <script>
        function checkTimeElement(myElement){
            if(myElement < 10)
              return '0'+myElement;
            else
              return myElement;
          }

        function checkEndDate(){
            var endDate = $('.end_date').val();


            // let [currentJustDate, currentJustTime] = currentDate.split(' ');
            // let [currentDateYears, currentDateMonths , currentDatedays] = currentJustDate.split('-');
            // let [currentH,currentM,currentS] = currentJustTime.split(':');
            // var currentTime = new Date(currentDateYears,currentDateMonths-1,currentDatedays,currentH,currentM,currentS);

            let [endJustDate, endJustTime] = endDate.split(' ');
            let [endDateYears, endDateMonths , endDatedays] = endJustDate.split('-');
            let [endH,endM,endS] = endJustTime.split(':');
            var endTime = new Date(endDateYears,endDateMonths-1,endDatedays,endH,endM,endS);
            

          // // Update the count down every 1 second
          var x = setInterval(function() {
             var today = new Date();
             var todayYear = today.getUTCFullYear();
             var todayMonth = today.getUTCMonth();
             var todayDay = today.getUTCDate();
             var todayHours = today.getUTCHours();
             var todayMinutes = today.getUTCMinutes();
             var todaySeconds = today.getUTCSeconds();
             //+4 hours because we need the time in beirut and its UTC+2
             var todayUTC = new Date(todayYear,todayMonth,todayDay,todayHours+2,todayMinutes,todaySeconds);
            // todayUTC.setHours(todayUTC.getHours());
            // todayUTC.setMinutes(todayUTC.getMinutes());
            // todayUTC.setSeconds(todayUTC.getSeconds());
            

            // Find the distance between d and the count down date
            var distance = endTime.getTime() - todayUTC.getTime();

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            //var days = Math.floor(distance / (1000 * 3600 * 24));
            //console.log(days+' '+hours+' '+minutes+' '+seconds);
            
            // Display the result in the element with id="demo"

            if(hours>0){
                document.getElementById("ending_hours").style.display = "inline";
                document.getElementById("separate").style.display = "inline";
                //document.getElementById("ending_days").innerHTML = days;
                //document.getElementById("ending_days").style.visibility = "hidden";

            }else{
                document.getElementById("ending_hours").style.display = "none";
                document.getElementById("separate").style.display = "none";
            }
                
            document.getElementById("ending_hours").innerHTML = checkTimeElement(hours);
            document.getElementById("ending_minutes").innerHTML = checkTimeElement(minutes);
            document.getElementById("ending_seconds").innerHTML = checkTimeElement(seconds);

            // If the count down is finished, write some text

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("ending_hours").innerHTML = '00';
                document.getElementById("ending_minutes").innerHTML = '00';
                document.getElementById("ending_seconds").innerHTML = '00';

                
                var meta = $('#meta-token').attr('content');
                var url = $('input[name="url"]').val();

                $.ajax({
                    url: url+'/admin/set-winner',
                    type: 'POST',
                    data:{
                        '_token': meta,

                    },
                    dataType: 'json',
                    success: function(response){

                    },
                    error: function(response){
                        console.log('error');
                    },
                });

                //display the word and star icon winner above winner name
                $('#winner_star').attr('style','none');
                $('#winner_word').attr('style','none');

                //display the visacard button to the winner just
                var userId = $('#user_id').val();
                var winnerUserId = $('#winner_user_id').val();
                if(userId == winnerUserId){
                    $('#payment').attr('style','none');
                }

                //CHANGE max vlaue  value if timer finshed
                //$('.informations .prices .max').text('0$');

              // document.getElementById("value").innerHTML = "EXPIRED";
              // location.replace("/finish");
            }
          }, 1000);
        }
      
      function checkStartDate(){
            //var currentDate = $('.current_date').val();
            var startDate = $('.start_date').val();


            // let [currentJustDate, currentJustTime] = currentDate.split(' ');
            // let [currentDateYears, currentDateMonths , currentDatedays] = currentJustDate.split('-');
            // let [currentH,currentM,currentS] = currentJustTime.split(':');
            // var currentTime = new Date(currentDateYears,currentDateMonths-1,currentDatedays,currentH,currentM,currentS);

            let [startJustDate, startJustTime] = startDate.split(' ');
            let [startDateYears, startDateMonths , startDatedays] = startJustDate.split('-');
            let [startH,startM,startS] = startJustTime.split(':');
            var startTime = new Date(startDateYears,startDateMonths-1,startDatedays,startH,startM,startS);
            

             // // Update the count down every 1 second
             var x = setInterval(function() {
             var today = new Date();
             var todayYear = today.getUTCFullYear();
             var todayMonth = today.getUTCMonth();
             var todayDay = today.getUTCDate();
             var todayHours = today.getUTCHours();
             var todayMinutes = today.getUTCMinutes();
             var todaySeconds = today.getUTCSeconds();
             //+4 hours because we need the time in beirut and its UTC+2
             var todayUTC = new Date(todayYear,todayMonth,todayDay,todayHours+2,todayMinutes,todaySeconds);
            // todayUTC.setHours(todayUTC.getHours());
            // todayUTC.setMinutes(todayUTC.getMinutes());
            // todayUTC.setSeconds(todayUTC.getSeconds());
            

            // Find the distance between d and the count down date
            var distance = startTime.getTime() - todayUTC.getTime();

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            var days = Math.floor(distance / (1000 * 3600 * 24));
            //console.log(days+' '+hours+' '+minutes+' '+seconds);
            
            // Display the result in the element with id="demo"

            if(days>0){
              hours += days* 24;
            }
                
            document.getElementById("ending_hours").innerHTML = hours;
            document.getElementById("ending_minutes").innerHTML = minutes;
            document.getElementById("ending_seconds").innerHTML = seconds;

            // If the count down is finished, write some text

            if (distance < 0) {
              clearInterval(x);
              document.getElementById("ending_hours").innerHTML = '00';
              document.getElementById("ending_minutes").innerHTML = '00';
              document.getElementById("ending_seconds").innerHTML = '00';
              checkEndDate();
            }
          }, 1000);

      }
        


        if($('.pause-status').val() == 1){

        }else{
            checkStartDate();
        }

        function clearAllIntervals(){
            // Set a fake timeout to get the highest timeout id
            var highestTimeoutId = setTimeout(";");
            for (var i = 0 ; i < highestTimeoutId ; i++) {
                clearTimeout(i); 
            }
        }

        //edit timer
        var editTimerChannel = pusher.subscribe('edit-timer-channel');
            editTimerChannel.bind('edit-timer', function(data) {
                console.log(JSON.stringify(data));
                
                if(!data.statusPause){
                    
                    clearAllIntervals();

                    $('.end_date').val(data.date+' '+data.time);
                    checkEndDate();

                    $('#winner_star').attr('style','visibility:hidden;');
                    $('#winner_word').attr('style','visibility:hidden;');

                    //display the visacard button to the winner just
                      
                    //$('#payment').attr('style','visibility:hidden;');

                }else{
                    clearAllIntervals();
                }
                

            });
    </script>


</body>
</html>