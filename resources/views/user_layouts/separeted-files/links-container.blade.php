<div class="dropdown-menu-links">
            <!-- Swiper -->
            <div class="swiper-container">
              <div class="swiper-wrapper">
                <div class="swiper-slide link-container" id="payment" style="visibility:{{isset($winner) ? 'none;' : 'hidden;'}}">
                  <!-- <form method='post' action='/checkout'>
                    {{csrf_field()}}
                    <button type="submit">button</button>
                  </form> -->
                  <form method='post' action="{{route('checkout')}}">
                    {{csrf_field()}}
                    <button type="submit">
                        <img src="{{url('/')}}/images/inside-headers-credit-cards-card-help-visa--customer-service.jpg">  
                    </button>
                  </form>
                  <p>Buy with Visa Card</p>  
                </div>

                  @foreach($storeLinks as $storeLink)
                  <div class="swiper-slide link-container">
                    <form>
                    {{csrf_field()}}
                      <button type="button" onclick="location.href = '{{$storeLink->link}}';">
                      <!-- <a href="{{$storeLink->link}}"> -->
                          <img src="{{url('/storage/'.$storeLink->image)}}">  
                      <!-- </a> -->
                      </button>
                    </form>
                      <p>Buy {{$storeLink->name}}</p> 
                  </div>

                  @endforeach

                  
              </div>
              <!-- Add Arrows -->
              @if(count($storeLinks) > 4)
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
              @endif
            </div>
           
            <!-- Swiper JS -->
        </div>
  <!-- Links Container -->
  <span class="arrow-container">
      <img src="{{url('/')}}/icons/keyboard_arrow_down-24px.svg" class="filter-gray down">
  </span>