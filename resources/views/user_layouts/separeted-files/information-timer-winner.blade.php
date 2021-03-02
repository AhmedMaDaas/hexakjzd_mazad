<div class="time-container justify-content-center">
    <!--  check if the timer is paused when user load the page after the live started  -->
    @if(!is_null($live->timer_pause))
        <span class="minutes ending_hours" id="ending_hours" style="display:none">{{$timerValue[0]}}</span>
        <span class="separator separate" id="separate" style="display:none">:</span>
        <span class="seconds" id="ending_minutes">{{$timerValue[1]}}</span>
        <span class="separator">:</span>
        <span class="seconds" id="ending_seconds">{{$timerValue[2]}}</span>
    @else
        <span class="minutes ending_hours" id="ending_hours" style="display:none">15</span>
        <span class="separator separate" id="separate" style="display:none">:</span>
        <span class="seconds" id="ending_minutes">44</span>
        <span class="separator">:</span>
        <span class="seconds" id="ending_seconds">44</span>
    @endif
    
</div>
<div class="informations">
    <div class="prices">
        <span class="min">{{$live->min_value}}$</span>
        @if(isset($bigValue))
            <span class="max">{{$bigValue->price}}$</span>
        @else
            <span class="max">0$</span>
        @endif
    </div>
    <div class="winner">
        <p class="pop" id="winner_word" style="visibility:hidden;">Winner!</p>
        <div class="winner-name">
            <img src="{{url('/')}}/icons/star-24px.svg" id="winner_star" style="visibility:hidden;" class="filter-gold">
            @if(isset($bigValue))
                <span class="winner-name-span">{{$bigValue->user->name}}</span>
            @else
                <span class="winner-name-span">empty</span>
            @endif
        </div>
    </div>
</div>