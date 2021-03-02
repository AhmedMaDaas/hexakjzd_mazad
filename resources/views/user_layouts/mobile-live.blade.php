@yield("headr")
<!-- Start Mobile Style -->
    <div class="header-mobile">
        <div class="dropdown-menu-swiper-container-mobile">
            <!-- Links Container -->
            @include('user_layouts.separeted-files.links-container',['storeLinks'=>$storeLinks,'winner'=>$winner])

        </div>
        @include('user_layouts.separeted-files.user-info',['user'=>$user])
    </div>
    
            
        
    <!-- End dropdown menu -->
    <div class="video-container-mobile">
                <p>Live</p>
                <!--<iframe src="WhatsApp%20Video%202020-09-30%20at%209.53.13%20PM.mp4" class="video"></iframe>-->
                <video id="mobile-video" class="video" playsinline autoplay muted></video>
                <button id="enable-audio-mobile" class="enable-audio">Enable audio</button>
                <button id="mute-audio-mobile" class="enable-audio">Mute audio</button>
                <?php
                  $live->hide_live ? $style='none' : $style='display:none;';
                ?>
                <div class="hide-video" style='{{$style}}'></div>
                  @include('user_layouts.separeted-files.commints-replies',['commints'=>$commints,
                                                                                  'interactions'=>$interactions,
                                                                                  'live'=>$live,
                                                                                  'bigValue'=>$bigValue])

                @include('user_layouts.separeted-files.actions-on-live',['live'=>$live,'welcomeInfo'=>$welcomeInfo,'user'=>$user])

                <?php
                    if(!is_null($live->timer_pause)){
                        $timerValue = explode(':', $live->timer_pause);
                    }else{
                        $timerValue = null;
                    }
                ?>
                @if(!is_null($live->timer_pause))
                    <input type="hidden" class="pause-status" value="1">
                @else
                    <input type="hidden" class="pause-status" value="0">
                @endif
                <input type="hidden" class="end_date" value="{{$endTimeOfLive}}">
                <div class="informations-and-comments-mobile">
                      @include('user_layouts.separeted-files.information-timer-winner',['live'=>$live,
                                                                                        'bigValue'=>$bigValue,
                                                                                        'timerValue'=>$timerValue])
                        
                </div>
    </div>
    <!-- End Mobile Style -->

    
    @yield("secondDesign")