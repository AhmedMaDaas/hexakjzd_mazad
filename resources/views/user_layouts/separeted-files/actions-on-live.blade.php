<div class="actions">
    <div class="views">
        <img src="{{url('/')}}/icons/visibility-24px.svg" class="filter-darkgray">
        <span class="views-span">{{$live->views + $live->cheat_views}}</span>
    </div>
    <div class="make-action">
        <div class="like-this">
            <?php $found = false;?>

            @foreach($live->interactions as $interactionOnLive)
                @if($interactionOnLive->user->id == session('login'))
                <?php $found = true;?>
                    <a href="#"><img src="{{url('/')}}/icons/thumb_up-24px.svg" id="like-on-live" class="filter-base like-on-live"></a>
                @endif
            @endforeach

            @if(!$found)
                <a href="#"><img src="{{url('/')}}/icons/thumb_up-24px.svg" id="like-on-live" class="filter-darkgray like-on-live"></a>
            @endif
            <!-- <a href="#"><img src="{{url('/')}}/icons/thumb_up-24px.svg" id="like-on-live" class="filter-darkgray"></a> -->
            <span class="likes-span">{{$live->likes + $live->cheat_likes}}</span>
        </div>
        <div class="share-this">
            <!-- https://www.facebook.com/sharer/sharer.php?u=example.org -->
            <!-- <a href="#" target="_blank"> -->
                <img id="share_facebook"  src="{{url('/')}}/icons/share-24px.svg" class="filter-base share_facebook"  data-container="body" data-toggle="popover" data-placement="top" data-content="share on facebook" data-trigger="hover">
            <!-- </a> -->
            <!-- <a href="#"><img src="{{url('/')}}/icons/share-24px.svg" class="filter-base"  data-container="body" data-toggle="popover" data-placement="top" data-content="share on facebook" data-trigger="hover"></a> -->
        </div>
        <div class="link-whatsapp">
            <a href="https://api.whatsapp.com/send?phone={{$welcomeInfo->whatsapp_number}}&text=my name is:{{$user->name}},and my location:" target="_blank">
                <img src="{{url('/')}}/icons/icons8-whatsapp.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="send informations" data-trigger="hover">
            </a>
            <!-- <a href="#"><img src="{{url('/')}}/icons/icons8-whatsapp.svg" data-container="body" data-toggle="popover" data-placement="top" data-content="send informations" data-trigger="hover"></a> -->
        </div>
    </div>
</div>