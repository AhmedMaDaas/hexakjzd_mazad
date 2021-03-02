<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <title>HOUSE OF AMBER</title>
    <link rel="stylesheet" href="{{url('/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/normalize.css">
    <link rel="stylesheet" href="{{url('/')}}/package/css/swiper.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/hover-min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/user.css">
</head>
<body>
  <input type="hidden" name="url" value="{{ url('/') }}">
    <div class="main-flex-container">
        <div class="details">
            <div class="logo">
                <h1>{{ settings()->auction_name }}</h1>
                <hr>
            </div>
            <div class="welcome-msg">
                <p>
                    {{$welcomeInfo->welcome_text_message}}
                </p>
            </div>
            <div class="user-side">
              <div class="user-dropdown">
                <img src="{{url('/storage/' . $user->photo)}}">
                <span class="name">{{$user->name}}</span>
                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{url('/')}}/icons/keyboard_arrow_down-24px.svg" class="filter-lightgray"></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                  </div>
              </div>
            </div>
            
            @if(!is_null($live))
            <input type="hidden" class="start_date" value="{{$live->live_start}}">
            <div class="time-container" data-container="body" data-toggle="popover" data-placement="right" data-content="next live" data-trigger="hover">
                <span class="minutes" id="starting_hours">15</span>
                <span class="separator">:</span>
                <span class="seconds" id="starting_minutes">44</span>
                <span class="separator">:</span>
                <span class="seconds" id="starting_seconds">44</span>
            </div>
            
            <div class="ads">
                <div class="card advertisement text-center">
                  <div class="card-header">
                    <p>The next Auction</p>
                    <span>On {{$live->live_start}}</span>
                  </div>
                  <div class="card-body">
                    <p class="card-text">{{$live->description}}</p>
                  </div>
                </div>
            </div>
            @else
              <div class="ads">
                  <div class="card advertisement text-center">
                    <div class="card-header">
                      <p>The next Auction</p>
                      <span>not faund any auction yet</span>
                    </div>
                    <div class="card-body">
                      <p class="card-text"></p>
                    </div>
                  </div>
              </div>
            @endif
            <div class="contact-us">
                <h3>Contact Us</h3>
                <div class="social-links">
                    <a href="https://www.facebook.com/HexaPiTech/" class="facebook"><img src="{{url('/')}}/icons/icons8-facebook.svg"></a>
                    <a href="https://api.whatsapp.com/send?phone={{$welcomeInfo->whatsapp_number}}" target="_blank" class="whatsapp">
                      <img src="{{url('/')}}/icons/icons8-whatsapp.svg">
                    </a>
                    <a href="https://instagram.com/hexa.pi?igshid=h9wvtyrps4nu" class="instagram"><img src="{{url('/')}}/icons/insta.png"></a>
                </div>
                
            </div>
        </div>

        @include('user_layouts.ads-slider',['ads'=>$ads])

        <!-- <div class="slider">
            <div id="imagesSlider" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#imagesSlider" data-slide-to="0" class="active"></li>
                <li data-target="#imagesSlider" data-slide-to="1"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{url('/')}}/images/132635397_203211004804143_6631424463649881218_o.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{url('/')}}/images/133281301_203189431472967_3745309141761668023_o.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
            </div>
        </div> -->

        <audio id="player">
            <source src="{{url('/storage/'.$welcomeInfo->welcome_voic_message)}}" type="audio/mp3">
        </audio>

        <!-- Modal -->
        <div class="modal fade audio-modal" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    <script src="{{url('/')}}/js/jquery-3.3.1.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{url('/')}}/js/popper.js"></script>
    <script src="{{url('/')}}/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/package/js/swiper.min.js"></script>
    <script src="{{url('/')}}/js/jquery.nicescroll.min.js"></script>
    <script src="{{url('/')}}/js/user.js"></script>

    <script src="{{url('/')}}/js/real-time-files/setPusher.js"></script>

    <script>
      var url = $('input[name="url"]').val();
      function getTodayByUtc(){
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
          return todayUTC;
      }


        var endDate = $('.start_date').val();
        if(endDate != null){

          let [endJustDate, endJustTime] = endDate.split(' ');
          let [endDateYears, endDateMonths , endDatedays] = endJustDate.split('-');
          let [endH,endM,endS] = endJustTime.split(':');
          var endTime = new Date(endDateYears,endDateMonths-1,endDatedays,endH,endM,endS);

          
          
          var todayUTC = getTodayByUtc();
          // Find the distance between d and the count down date
          var distance = endTime.getTime() - todayUTC.getTime();

          if(distance>0){

             // // Update the count down every 1 second
            var x = setInterval(function() {
             var todayUTC = getTodayByUtc();
            

            // Find the distance between d and the count down date
            var distance = endTime.getTime() - todayUTC.getTime();

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            var days = Math.floor(distance / (1000 * 3600 * 24));
            //console.log(days+' '+hours+' '+minutes+' '+seconds);

            if(days>0){
              hours += days* 24;
            }
            
            // Display the result in the element with id="demo"

            // if(days>0){
            //     document.getElementById("starting_days").style.visibility = "visible";
            //     document.getElementById("end_d").style.visibility = "visible";
            //     document.getElementById("starting_days").innerHTML = days;
            //     //document.getElementById("starting_days").style.visibility = "hidden";

            // }
                
            document.getElementById("starting_hours").innerHTML = hours;
            document.getElementById("starting_minutes").innerHTML = minutes;
            document.getElementById("starting_seconds").innerHTML = seconds;

            // If the count down is finished, write some text

            if (distance < 0) {
                clearInterval(x);
                // document.getElementById("value").innerHTML = "EXPIRED";
                location.replace(url+"/home");
              }
            }, 1000);

          }

       

        }
        
    </script>

    <script>
    var url = $('input[name="url"]').val();
      var editTimerChannel = pusher.subscribe('edit-timer-channel');
          editTimerChannel.bind('edit-timer', function(data) {
              console.log(JSON.stringify(data));

              if(data.startLive){
                  location.replace(url+"/home");
              }
              

          });

    </script>
</body>
</html>