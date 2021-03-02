@if(count($ads))
    <div class="slider">
        <div id="imagesSlider" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @foreach($ads as $i => $ad)
                @if($i==0)
                    <li data-target="#imagesSlider" data-slide-to="{{$i}}" class="active"></li>
                @else
                    <li data-target="#imagesSlider" data-slide-to="{{$i}}"></li>
                @endif
            @endforeach
          </ol>
          <div class="carousel-inner">
             @foreach($ads as $i => $ad)
                @if($i==0)
                    <div class="carousel-item active">
                @else
                    <div class="carousel-item">
                @endif
                    <img src="{{url('/storage/'.$ad->photo)}}" class="d-block w-100" alt="...">
                </div>
            @endforeach
          </div>
        </div>
    </div>
@endif