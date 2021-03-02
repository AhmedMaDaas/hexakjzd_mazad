@extends('user_layouts.mobile-live')
@section('headr')
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <title>Live</title>
        <link rel="stylesheet" href="{{url('/')}}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/admin_design/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/css/normalize.css">
        <link rel="stylesheet" href="{{url('/')}}/package/css/swiper.min.css">
        <link rel="stylesheet" href="{{url('/')}}/css/hover-min.css">
        <link rel="stylesheet" href="{{url('/')}}/css/user.css?v=0.0.3">
        <style type="text/css">
          .modal-body img {
            width: 358px;
            height: 302px;
            border-radius: 15px;
          }

          .modal-body p.winner {
            font-size: 26px;
            color: var(--dblue);
          }

          .modal-body p#n {
            font-size: 18px;
          }

          .hidden{
            display: none;
          }
        </style>
    </head>
    <!-- onbeforeunload="return myFunction()" -->
    <body>
@endsection


@section('secondDesign')

@if(Session::has('success'))
  <div class="alert alert-success">
    {{ Session::get('success') }}
   </div>
@endif

@if(Session::has('failed'))
  <div class="alert alert-danger">
    {{ Session::get('failed') }}
   </div>
@endif


    <input type="hidden" name="url" value="{{ url('/') }}">
    <input type="hidden" class="min_value" value="{{$live->min_value}}">
    <input type="hidden" id="user_id" value="{{session('login')}}">
    @if(isset($bigValue))
    <input type="hidden" id="winner_user_id" value="{{$bigValue->user->id}}">
    @else
    <input type="hidden" id="winner_user_id" value="0">
    @endif
    <meta name="_token" id="meta-token" content="{{ csrf_token() }}">
    <!-- Start dropdown menu -->
        <div class="navbar-container">
            @include('user_layouts.separeted-files.user-info',['user'=>$user])
            <div class="logo-side">
                <img src="{{ Storage::has(settings()->site_logo) ? url('/storage/' . settings()->site_logo) : url('/admin_design/images/ring.png') }}" class="filter-base">
                <span class="website-name">{{ settings()->auction_name }}</span>
            </div>
        </div>
      
        <div class="dropdown-menu-swiper-container">
            <!-- Links Container -->
              @include('user_layouts.separeted-files.links-container',['storeLinks'=>$storeLinks,'winner'=>$winner])
        </div>
            
        
    <!-- End dropdown menu -->
    

    <!-- Start Video And Details -->
        <div class="row video-details">
            <div class="video-container col-md-8">
                <p>Live</p>
                <!--<iframe src="WhatsApp%20Video%202020-09-30%20at%209.53.13%20PM.mp4" class="video"></iframe>-->
                <video id="video" class="video" playsinline autoplay muted></video>
                <button id="enable-audio" class="enable-audio">Enable audio</button>
                <button id="mute-audio" class="enable-audio">Mute audio</button>
                <?php
                  $live->hide_live ? $style='none' : $style='display:none;';
                ?>
                <div class="hide-video" style='{{$style}}'></div>
                @include('user_layouts.separeted-files.actions-on-live',['live'=>$live,'welcomeInfo'=>$welcomeInfo,'user'=>$user])

            </div>


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
            <div class="informations-and-comments col-md-4">

                @include('user_layouts.separeted-files.information-timer-winner',['live'=>$live,
                                                                                'bigValue'=>$bigValue,
                                                                                'timerValue'=>$timerValue])

                @include('user_layouts.separeted-files.commints-replies',['commints'=>$commints,
                                                                          'interactions'=>$interactions,
                                                                          'live'=>$live,
                                                                          'bigValue'=>$bigValue])
            </div>
        </div>

        @if($welcomeInfo->voic_before_live_status)
            <input type="hidden" id="audio_status" value="1">
        @else
            <input type="hidden" id="audio_status" value="0">
        @endif

        <audio id="live-player" style="visibility:hidden;">
            <source src="{{url('/storage/'.$welcomeInfo->voic_before_live)}}" type="audio/mp3">
        </audio>

        <!-- Modal -->
        <div class="modal fade audio-modal-live" id="staticBackdrop" name="start" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

        <div class="modal fade" id="winnerModal" tabindex="-1" role="dialog" aria-labelledby="winnerModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
               <img class="hidden" src="{{ url('/') }}/admin_design/images/c143ac465ef08b2f74cc0a84c1774e31.jpg">
              <p class="winner">{{ trans('admin.the_winner') }}</p>
              <p id="n"><i class='fa fa-spin fa-spinner load'></i><span></span></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.close') }}</button>
              </div>
            </div>
          </div>
        </div>


<!-- paypal script -->

        <!--<script
          src="https://www.paypal.com/sdk/js?client-id=AV1lCxApqv0y25Yi1V1d5Y0g0TBi8LZDzzN7-RhvOx8D_uZf5FvaC29f9MLTsMUYoD8MroJ1mCafvVr_"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
        </script>

        <div id="paypal-button-container"></div>

        <script>
          paypal.Buttons({
            createOrder: function(data, actions) {
              // This function sets up the details of the transaction, including the amount and line item details.
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: '0.01'
                  }
                }]
              });
            },
            onApprove: function(data, actions) {
              // This function captures the funds from the transaction.
              return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                console.log('Transaction completed by ' + details.payer.name.given_name);
              });
            }
          }).render('#paypal-button-container');
          //This function displays Smart Payment Buttons on your web page.
        </script> -->

<!-- end paypal script -->

        <!-- {{url('/')}}/checkout
        id="myCCForm" -->
        <form id="myCCForm"  action="{{url('/')}}/checkout" method="post">
          {{csrf_field()}}
          <!-- <input type='hidden' name='sid' value='250712686285' />
          <input type='hidden' name='mode' value='2CO' />
          <input type='hidden' name='li_0_name' value='test' />
          <input type='hidden' name='li_0_price' value='1.00' />
          <input type='hidden' name='demo' value='Y' />
          <input name='submit' type='submit' value='Checkout' /> -->

          <!-- <input name="token" type="hidden" value="" />
          <div>
            <label>
              <span>Card Number</span>
              <input id="ccNo" type="text" value="" autocomplete="off" required />
            </label>
          </div>
          <div>
            <label>
              <span>Expiration Date (MM/YYYY)</span>
              <input id="expMonth" type="text" size="2" required />
            </label>
            <span> / </span>
            <input id="expYear" type="text" size="4" required />
          </div>
          <div>
            <label>
              <span>CVC</span>
              <input id="cvv" type="text" value="" autocomplete="off" required />
            </label>
          </div>
          <input type="submit" value="Submit Payment" />
          <input type="submit" value="Submit Payment" /> -->
        </form>

        <!-- <script src="https://secure-global.paytabs.com/payment/js/paylib.js"></script>  -->

        <!-- <form action="http://localhost:8000/checkout" id="payform" method="post">
          {{csrf_field()}}
          <span id="paymentErrors"></span>
          <div class="row">
            <label>Card Number</label>
            <input type="text" data-paylib="number" size="20">
          </div>
          <div class="row">
            <label>Expiry Date (MM/YYYY)</label>
            <input type="text" data-paylib="expmonth" size="2">
            <input type="text" data-paylib="expyear" size="4">
          </div>
          <div class="row">
            <label>Security Code</label>
            <input type="text" data-paylib="cvv" size="4">
          </div>
          <input type="submit" value="Place order">
        </form> -->


        <!-- <script type="text/javascript">
          var myform = document.getElementById('payform');
          paylib.inlineForm({
            'key': 'CBKM2P-2T9H62-M2K29H-2VMVDD',
            'form': myform,
            'autosubmit': true,
            'callback': function(response) {
              document.getElementById('paymentErrors').innerHTML = '';
              if (response.error) {             
                paylib.handleError(document.getElementById('paymentErrors'), response); 
              }
            }
          });
          </script> -->


    <!-- End Video And Comments -->
    <script src="{{url('/')}}/js/jquery-3.3.1.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{url('/')}}/js/popper.js"></script>
    <script src="{{url('/')}}/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/package/js/swiper.min.js"></script>
    <script src="{{url('/')}}/js/jquery.nicescroll.min.js"></script>
    <script src="{{url('/')}}/js/user.js?v=0.0.3"></script>
    <script src="https://hexapi.live/socket.io/socket.io.js"></script>
    <script src="{{url('/')}}/broadcast/js/watch.js?v=0.0.39"></script>
    <script src="{{url('/')}}/js/user-live.js?v=0.0.3"></script>

    <!-- ajax script -->
    <script src="{{url('/')}}/js/ajax-files/commintByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/directedValueByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/likeOnLiveByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/likeOnCommintByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/replyByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/editCommintByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/editReplyByAjax.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/ajax-files/deleteCommintOrReplyByAjax.js?v=0.0.3"></script>
    <!-- end ajax script -->

    <!-- user script -->
    <script src="{{url('/')}}/js/ajax-files/logoutByAjax.js?v=0.0.3"></script>
    <!-- end user script -->

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
    <script src="{{url('/')}}/js/real-time-files/admin/blockUser.js"></script>
    <script src="{{url('/')}}/js/real-time-files/admin/choose_winner.js?v=0.0.3"></script>
    <script src="{{url('/')}}/js/real-time-files/admin/confirm_winner.js?v=0.0.3"></script>
    <!-- end admin files -->

    <!-- payment -->
    <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

    <script>
      // Called when token created successfully.
      var successCallback = function(data) {
        var myForm = document.getElementById('myCCForm');

        // Set the token as the value for the token input
        myForm.token.value = data.response.token.token;

        // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
        myForm.submit();
      };

      // Called when token creation fails.
      var errorCallback = function(data) {
        // Retry the token request if ajax call fails
        if (data.errorCode === 200) {
           // This error code indicates that the ajax call failed. We recommend that you retry the token request.
        } else {
          console.log(data.errorMsg);
        }
      };

      var tokenRequest = function() {
        // Setup token request arguments
        var args = {
          sellerId: "250712686285",
          publishableKey: "1FFAF4FA-B22E-43D9-96D7-91106D5748AB",
          ccNo: $("#ccNo").val(),
          cvv: $("#cvv").val(),
          expMonth: $("#expMonth").val(),
          expYear: $("#expYear").val()
        };

        // Make the token request
        TCO.requestToken(successCallback, errorCallback, args);
      };

      $(function() {
        // Pull in the public encryption key for our environment
        TCO.loadPubKey('production');

        $("#myCCForm").submit(function(e) {
          // Call our token request function
          tokenRequest();

          // Prevent form from submitting
          return false;
        });
      });

    </script>

    <!-- end payment -->

    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
        FB.init({appId: '396398234949136', status: true, cookie: true,
        xfbml: false,});
        };
        (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
        '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
        }());
    </script>

    <script>
      var url = $('input[name="url"]').val();
        $('.share_facebook').click(function(e){
          //window.location.href;
          //$(location).attr("href");
          var mySite = url + '/home';

          e.preventDefault();

          FB.ui({
            method: 'feed',
            //redirect_uri:'https://www.facebook.com/dialog/share?app_id=145634995501895&display=popup&href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2F&redirect_uri=%2Fcallback%2Ffacebook',
            link: mySite,
            caption: '',
          }, function(response){
              if(response){

                console.log('suc');
                var meta = $('#meta-token').attr('content');
                $.ajax({
                  url: url + "/share",
                  type: 'POST',
                  data: {
                    '_token' : meta,
                    // 'reply': reply,
                    // 'commintId' : commintId,
                    //'button': button,
                  }, 
                  dataType: 'json',
                  success: function (response) {
                    //console.log(response.operation);
                    //$('.modal-second').html(response.view);
                  },
                  error: function (response) {
                    console.log("error ");
                    //location.href="";
                  },
                });

              }else{
                console.log('none');
              }
              console.log(response);
          });

        });
    </script>

    <script>
        var url = $('input[name="url"]').val();
        var meta = $('#meta-token').attr('content');

        window.onbeforeunload = function() {
            var data = new FormData();
            data.append("_token", meta);
            navigator.sendBeacon(
              url + "/discount-views",
              data
            );

            // more safely (optional...?)
            var until = new Date().getTime() + 1000;
            while (new Date().getTime() < until);
        }
       
        // window.addEventListener('beforeunload', function (event) { // or 'unload'
        //     var data = new FormData();
        //     data.append("_token", meta);
        //     navigator.sendBeacon(
        //       url + "/discount-views",
        //       data
        //     );

        //     // more safely (optional...?)
        //     var until = new Date().getTime() + 1000;
        //     while (new Date().getTime() < until);
        // });

        // window.onbeforeunload = function() {
        //     console.log('saved');
        //     var meta = $('#meta-token').attr('content');
        //     $.ajax({
        //       url: url + "/discount-views",
        //       type: 'POST',
        //       data: {
        //         '_token' : meta,
        //         // 'reply': reply,
        //         // 'commintId' : commintId,
        //         //'button': button,
        //       }, 
        //       dataType: 'json',
        //       success: function (response) {
        //         //console.log(response.operation);
        //         //$('.modal-second').html(response.view);
        //       },
        //       error: function (response) {
        //         console.log("error ");
        //         //location.href="";
        //       },
        //     });
        //     //return null;
        //     return;
        // }

        // $(window).on('beforeunload', function(){
        //     console.log('test');
        //     return '';
        // });
    </script>

    <script>
      function checkTimeElement(myElement){
        if(myElement < 10)
          return '0'+myElement;
        else
          return myElement;
      }

      var userId = $('#user_id').val();
      function checkEndDate(){
            //var currentDate = $('.current_date').val();
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

            // show the hour in timer if > 0 else dont show it
            if(hours>0){
                document.getElementById("ending_hours").style.display = "inline";
                $('.informations-and-comments').find('#ending_hours').attr('style',"display:inline");

                document.getElementById("separate").style.display = "inline";
                $('.informations-and-comments').find('#separate').attr('style',"display:inline");
                //document.getElementById("ending_hours").innerHTML = days;
                //document.getElementById("ending_hours").style.visibility = "hidden";

            }else{
              document.getElementById("ending_hours").style.display = "none";
                $('.informations-and-comments').find('#ending_hours').attr('style',"display:none");

                document.getElementById("separate").style.display = "none";
                $('.informations-and-comments').find('#separate').attr('style',"display:none");

            }
                
            document.getElementById("ending_hours").innerHTML = checkTimeElement(hours);
            $('.informations-and-comments').find('#ending_hours').text(checkTimeElement(hours));

            document.getElementById("ending_minutes").innerHTML = checkTimeElement(minutes);
            $('.informations-and-comments').find('#ending_minutes').text(checkTimeElement(minutes));

            document.getElementById("ending_seconds").innerHTML = checkTimeElement(seconds);
            $('.informations-and-comments').find('#ending_seconds').text(checkTimeElement(seconds));

            // If the count down is finished, write some text

            if (distance < 0) {
              clearInterval(x);
              document.getElementById("ending_hours").innerHTML = '00';
              $('.informations-and-comments').find('#ending_hours').text('00');

              document.getElementById("ending_minutes").innerHTML = '00';
               $('.informations-and-comments').find('#ending_minutes').text('00');

              document.getElementById("ending_seconds").innerHTML = '00';
               $('.informations-and-comments').find('#ending_seconds').text('00');

              //console.log($('.min_value').val());

              //display the word and star icon winner above winner name
              $('#winner_star').attr('style','none');
              $('.informations-and-comments').find('#winner_star').attr('style','none');

              $('#winner_word').attr('style','none');
              $('.informations-and-comments').find('#winner_word').attr('style','none');

              //display the visacard button to the winner just
              
              var winnerUserId = $('#winner_user_id').val();
              if(userId == winnerUserId){
                $('#payment').attr('style','none');
                $('.dropdown-menu-swiper-container').find('#payment').attr('style','none');
              }

              //CHANGE max vlaue and directed value if timer finshed
              // $('#direct-value').val('{{$live->min_value}}$');
              $('.informations-and-comments').find('#direct-value').val('{{$live->min_value}}$');
              // $('.informations .prices .max').text('0$');
              // document.getElementById("value").innerHTML = "EXPIRED";
              // location.replace("/finish");
            }
          }, 1000);
    }

    if($('.pause-status').val() == 1){

    }else{
        checkEndDate();
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
                $('.informations-and-comments').find('#winner_star').attr('style','visibility:hidden;');

                $('#winner_word').attr('style','visibility:hidden;');
                $('.informations-and-comments').find('#winner_word').attr('style','visibility:hidden;');

                //display the visacard button to the winner just
                  
                $('#payment').attr('style','visibility:hidden;');
                $('.dropdown-menu-swiper-container').find('#payment').attr('style','visibility:hidden;');

            }else{
                clearAllIntervals();
            }
            

        });

    </script>


    <script>
      $(document).on('click','#payment',function(){
        //console.log('s');
        var meta = $('#meta-token').attr('content');

        // $.ajax({
        //     url: 'https://test.oppwa.com/v1/checkouts',
        //     headers: { 'Authorization': 'Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg=' },
        //     type: 'POST',
        //     data:{
        //         //'_token': meta,
        //         'entityId':'8a8294174b7ecb28014b9699220015ca',
        //         'amount':'90.00',
        //         'currency':'USD',
        //         'paymentType':'DB'

        //     },
        //     dataType: 'json',
        //     success: function(response){
        //       console.log(response);
        //     },
        //     error: function(response){
        //       console.log(response);
        //         console.log('error');
        //     },
        // });

      });
    </script>
    
</body>
</html>
@endsection