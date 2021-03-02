@extends('admin.index')

@section('content')

@push('css')
<link rel="stylesheet" href="{{ url('/') }}/css/normalize.css">
<link rel="stylesheet" href="{{ url('/') }}/package/css/swiper.min.css">
<link rel="stylesheet" href="{{ url('/') }}/css/hover-min.css">
<link rel="stylesheet" href="{{ url('/') }}/css/user.css">
<link rel="stylesheet" href="{{ url('/') }}/admin_design/css/liveadmin.css">
@endpush

@push('js')
<script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/') }}/package/js/swiper.min.js"></script>
<script src="{{ url('/') }}/js/jquery.nicescroll.min.js"></script>
<script src="{{ url('/') }}/js/user.js"></script>
<script src="{{ url('/') }}/admin_design/broadcast/js/socket.io.js"></script>
<script src="{{ url('/') }}/admin_design/broadcast/js/broadcast.js"></script>

<script type="text/javascript">

	$(document).ready(function(){

	});

</script>

@endpush

<div class="infoo" style="display: flex">
    <div class="video-container col-md-8">
        <p>Live</p>
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

        <button id="EndBroadcast">End broadcast</button>

        <div class="actions">
            <div class="views">
                <img src="{{ url('/') }}/icons/visibility-24px.svg" class="filter-darkgray">
                <span></span>
            </div>
            <div class="make-action">
                <div class="like-this">
                    <a href="#"><img src="{{ url('/') }}/icons/thumb_up-24px.svg" class="filter-darkgray"></a>
                    <span></span>
                </div>
                <div class="share-this">
                    <a href="#"><img src="{{ url('/') }}/icons/share-24px.svg" class="filter-base"  data-container="body" data-toggle="popover" data-placement="top" data-content="share on facebook" data-trigger="hover"></a>
                </div>
                <div class="link-whatsapp">
                    <a href="#"><img src="{{ url('/') }}/icons/icons8-whatsapp.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="send informations" data-trigger="hover"></a>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" class="end_date" value="">
    <div class="informations-and-comments col-md-4">
        <div class="time-container justify-content-center">
            <span class="minutes" id="ending_hours">15</span>
            <span class="separator">:</span>
            <span class="seconds" id="ending_minutes">44</span>
            <span class="separator">:</span>
            <span class="seconds" id="ending_seconds">44</span>
        </div>
        <div class="informations">
            <div class="prices">
                <span class="min">$</span>
                <span class="max">$</span>
            </div>
            <div class="winner">
                <p class="pop" style="visibility:hidden;">Winner!</p>
                <div class="winner-name">
                    <img src="{{ url('/') }}/icons/star-24px.svg" style="visibility:hidden;" class="filter-gold">
                    <span></span>
                </div>
            </div>
        </div>

        <div class="comments-container">
            <div class="comments">

                <div class="media comment">
                  <img src="{{ url('/') }}/images/photo_%D9%A2%D9%A0%D9%A2%D9%A0-%D9%A1%D9%A2-%D9%A2%D9%A3_%D9%A2%D9%A3-%D9%A5%D9%A3-%D9%A0%D9%A6.jpg"  alt="user" class="user-image">
                  <div class="media-body comment-body">
                    <span class="mt-0 name">Rami Hasan</span>
                    <p class="content">Nice!</p>
                    <input type="hidden" value="1" class="comment-id">
                    <div class="control-icons">
                        <img src="{{ url('/') }}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                        <a href="#" class="delete-icon"><img src="{{ url('/') }}/icons/delete-24px.svg" class="filter-medgray"></a>
                        <img src="icons/share-24px.svg" class="filter-base">  
                    </div>
                  </div>
                    <form class="edit-comment-form">
                        <input type="text" class="comment-content">
                        <input type="hidden" class="comment-id">
                        <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                    </form>
                </div>
                <div class="comment-footer">
                    <div class="reply-reactions">
                          <div class="reply">
                            <img src="{{ url('/') }}/icons/reply-24px.svg" class="filter-darkgray">
                            <span>reply</span>
                          </div>
                            <div class="reactions">
                                <a href="#"><img src="{{ url('/') }}/icons/angry.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/wow.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/sad.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/haha.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/love.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/like.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="3 reactions" data-trigger="hover"></a>
                                <span class="all-react">10</span>
                            </div>
                            <audio src="{{ url('/') }}/sounds/Tiny%20Button%20Push-SoundBible.com-513260752.mp3" id="react-sound"></audio>
                            
                    </div>
                    <div class="replies">
                        <div class="media reply">
                          <img src="{{ url('/') }}/images/photo_%D9%A2%D9%A0%D9%A2%D9%A0-%D9%A1%D9%A2-%D9%A2%D9%A3_%D9%A2%D9%A3-%D9%A5%D9%A3-%D9%A0%D9%A6.jpg"  alt="user" class="user-image">
                          <div class="media-body reply-body">
                            <span class="mt-0 name">Rami Hasan</span>
                            <p class="content">Nice!</p>
                            <input type="hidden" value="1" class="reply-id">
                            <div class="control-icons">
                                <img src="{{ url('/') }}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                                <a href="#" class="delete-icon"><img src="{{ url('/') }}/icons/delete-24px.svg" class="filter-medgray"></a>
                                <img src="icons/share-24px.svg" class="filter-base">  
                            </div>
                          </div>
                            <form class="edit-reply-form">
                                <input type="text" class="reply-content">
                                <input type="hidden" class="reply-id">
                                <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                            </form>
                        </div>
                        
                        <div class="media reply">
                          <img src="{{ url('/') }}/images/photo_%D9%A2%D9%A0%D9%A2%D9%A0-%D9%A1%D9%A2-%D9%A2%D9%A3_%D9%A2%D9%A3-%D9%A5%D9%A4-%D9%A1%D9%A7.jpg"  alt="user" class="user-image">
                          <div class="media-body reply-body">
                            <span class="mt-0 name">Wael Seif</span>
                            <p class="content">Nice!</p>
                            <input type="hidden" value="1" class="reply-id">
                            <div class="control-icons">
                                <img src="{{ url('/') }}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                                <a href="#" class="delete-icon"><img src="{{ url('/') }}/icons/delete-24px.svg" class="filter-medgray"></a>
                                <img src="icons/share-24px.svg" class="filter-base"> 
                            </div>
                          </div>
                            <form class="edit-reply-form">
                                <input type="text" class="reply-content">
                                <input type="hidden" class="reply-id">
                                <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                            </form>
                        </div>
                        
                        <form class="reply-form">
                            <input type="text" class="reply-input" placeholder="Write a reply..." required>
                            <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                        </form>
                    </div>
                    
                  </div>
                <!-- Comment -->
                
                 <!-- Comment -->
                <div class="media comment">
                  <img src="{{ url('/') }}/images/photo_%D9%A2%D9%A0%D9%A2%D9%A0-%D9%A1%D9%A2-%D9%A2%D9%A3_%D9%A2%D9%A3-%D9%A5%D9%A3-%D9%A0%D9%A6.jpg"  alt="user" class="user-image">
                  <div class="media-body comment-body">
                    <span class="mt-0 name">Rami Hasan</span>
                    <p class="content">Nice!</p>
                    <input type="hidden" value="1" class="comment-id">
                    <div class="control-icons">
                        <img src="{{ url('/') }}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                        <a href="#" class="delete-icon"><img src="{{ url('/') }}/icons/delete-24px.svg" class="filter-medgray"></a>
                        <img src="icons/share-24px.svg" class="filter-base">  
                    </div>
                  </div>
                    <form class="edit-comment-form">
                        <input type="text" class="comment-content">
                        <input type="hidden" class="comment-id">
                        <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                    </form>
                </div>
                <div class="comment-footer">
                    <div class="reply-reactions">
                          <div class="reply">
                            <img src="{{ url('/') }}/icons/reply-24px.svg" class="filter-darkgray">
                            <span>reply</span>
                          </div>
                            <div class="reactions">
                                <a href="#"><img src="{{ url('/') }}/icons/angry.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/wow.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/sad.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/haha.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/love.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/like.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="3 reactions" data-trigger="hover"></a>
                                <span class="all-react">10</span>
                            </div>
                            <audio src="{{ url('/') }}/sounds/Tiny%20Button%20Push-SoundBible.com-513260752.mp3" id="react-sound"></audio>
                            
                    </div>
                    <div class="replies">
                        <div class="media reply">
                          <img src="{{ url('/') }}/images/photo_%D9%A2%D9%A0%D9%A2%D9%A0-%D9%A1%D9%A2-%D9%A2%D9%A3_%D9%A2%D9%A3-%D9%A5%D9%A3-%D9%A0%D9%A6.jpg"  alt="user" class="user-image">
                          <div class="media-body reply-body">
                            <span class="mt-0 name">Rami Hasan</span>
                            <p class="content">Nice!</p>
                            <input type="hidden" value="1" class="reply-id">
                            <div class="control-icons">
                                <img src="{{ url('/') }}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                                <a href="#" class="delete-icon"><img src="{{ url('/') }}/icons/delete-24px.svg" class="filter-medgray"></a>
                                <img src="icons/share-24px.svg" class="filter-base">  
                            </div>
                          </div>
                            <form class="edit-reply-form">
                                <input type="text" class="reply-content">
                                <input type="hidden" class="reply-id">
                                <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                            </form>
                        </div>
                        
                        <div class="media reply">
                          <img src="{{ url('/') }}/images/photo_%D9%A2%D9%A0%D9%A2%D9%A0-%D9%A1%D9%A2-%D9%A2%D9%A3_%D9%A2%D9%A3-%D9%A5%D9%A4-%D9%A1%D9%A7.jpg"  alt="user" class="user-image">
                          <div class="media-body reply-body">
                            <span class="mt-0 name">Wael Seif</span>
                            <p class="content">Nice!</p>
                            <input type="hidden" value="1" class="reply-id">
                            <div class="control-icons">
                                <img src="{{ url('/') }}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                                <a href="#" class="delete-icon"><img src="{{ url('/') }}/icons/delete-24px.svg" class="filter-medgray"></a>
                                <img src="icons/share-24px.svg" class="filter-base"> 
                            </div>
                          </div>
                            <form class="edit-reply-form">
                                <input type="text" class="reply-content">
                                <input type="hidden" class="reply-id">
                                <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                            </form>
                        </div>
                        
                        <form class="reply-form">
                            <input type="text" class="reply-input" placeholder="Write a reply..." required>
                            <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                        </form>
                    </div>
                    
                  </div>
                <!-- Comment -->
                
                <!-- Comment -->
               <div class="media comment">
                  <img src="{{ url('/') }}/images/photo_%D9%A2%D9%A0%D9%A2%D9%A0-%D9%A1%D9%A2-%D9%A2%D9%A3_%D9%A2%D9%A3-%D9%A5%D9%A3-%D9%A0%D9%A6.jpg"  alt="user" class="user-image">
                  <div class="media-body comment-body">
                    <span class="mt-0 name">Rami Hasan</span>
                    <p class="content">Nice!</p>
                    <input type="hidden" value="1" class="comment-id">
                    <div class="control-icons">
                        <img src="{{ url('/') }}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                        <a href="#" class="delete-icon"><img src="{{ url('/') }}/icons/delete-24px.svg" class="filter-medgray"></a>
                        <img src="icons/share-24px.svg" class="filter-base">  
                    </div>
                  </div>
                    <form class="edit-comment-form">
                        <input type="text" class="comment-content">
                        <input type="hidden" class="comment-id">
                        <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                    </form>
                </div>
                <div class="comment-footer">
                    <div class="reply-reactions">
                          <div class="reply">
                            <img src="{{ url('/') }}/icons/reply-24px.svg" class="filter-darkgray">
                            <span>reply</span>
                          </div>
                            <div class="reactions">
                                <a href="#"><img src="{{ url('/') }}/icons/angry.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/wow.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/sad.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/haha.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="1 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/love.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="2 reactions" data-trigger="hover"></a>
                                <a href="#"><img src="{{ url('/') }}/icons/like.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="3 reactions" data-trigger="hover"></a>
                                <span class="all-react">10</span>
                            </div>
                            <audio src="{{ url('/') }}/sounds/Tiny%20Button%20Push-SoundBible.com-513260752.mp3" id="react-sound"></audio>
                            
                    </div>
                    <div class="replies">
                        <div class="media reply">
                          <img src="{{ url('/') }}/images/photo_%D9%A2%D9%A0%D9%A2%D9%A0-%D9%A1%D9%A2-%D9%A2%D9%A3_%D9%A2%D9%A3-%D9%A5%D9%A3-%D9%A0%D9%A6.jpg"  alt="user" class="user-image">
                          <div class="media-body reply-body">
                            <span class="mt-0 name">Rami Hasan</span>
                            <p class="content">Nice!</p>
                            <input type="hidden" value="1" class="reply-id">
                            <div class="control-icons">
                                <img src="{{ url('/') }}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                                <a href="#" class="delete-icon"><img src="{{ url('/') }}/icons/delete-24px.svg" class="filter-medgray"></a>
                                <img src="icons/share-24px.svg" class="filter-base">  
                            </div>
                          </div>
                            <form class="edit-reply-form">
                                <input type="text" class="reply-content">
                                <input type="hidden" class="reply-id">
                                <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                            </form>
                        </div>
                        
                        <div class="media reply">
                          <img src="{{ url('/') }}/images/photo_%D9%A2%D9%A0%D9%A2%D9%A0-%D9%A1%D9%A2-%D9%A2%D9%A3_%D9%A2%D9%A3-%D9%A5%D9%A4-%D9%A1%D9%A7.jpg"  alt="user" class="user-image">
                          <div class="media-body reply-body">
                            <span class="mt-0 name">Wael Seif</span>
                            <p class="content">Nice!</p>
                            <input type="hidden" value="1" class="reply-id">
                            <div class="control-icons">
                                <img src="{{ url('/') }}/icons/edit-24px.svg" class="filter-medgray edit-icon">
                                <a href="#" class="delete-icon"><img src="{{ url('/') }}/icons/delete-24px.svg" class="filter-medgray"></a>
                                <img src="icons/share-24px.svg" class="filter-base"> 
                            </div>
                          </div>
                            <form class="edit-reply-form">
                                <input type="text" class="reply-content">
                                <input type="hidden" class="reply-id">
                                <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                            </form>
                        </div>
                        
                        <form class="reply-form">
                            <input type="text" class="reply-input" placeholder="Write a reply..." required>
                            <button type="submit" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                        </form>
                    </div>
                    
                  </div>
            </div>
            <form class="add-comment" action="/add-commint" method="post">
                {{csrf_field()}}
                <input type="text" name="commint" id="commint" placeholder="Write a comment..." class="content" required>
                <button type="submit" name="add-comment" id="submit-btn" class="form-btn"><img src="{{ url('/') }}/icons/send-24px.svg" class="filter-darkgray"></button>
                <button type="button" class="form-btn toggle-input"><img src="{{ url('/') }}/icons/attach_money-24px.svg" class="filter-darkgray"></button>
                <input type="button" value="" id="direct-value" class="direct-value" name="direct-value" data-container="body" data-toggle="popover" data-placement="top" data-content="fast offer" data-trigger="hover">
            </form>
        </div>
    </div>
</div>

@endsection