<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <title>Login</title>
    <link rel="stylesheet" href="{{url('/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/normalize.css">
    <link rel="stylesheet" href="{{url('/')}}/package/css/swiper.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/hover-min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/user.css">
</head>
<body>

    @if(Session::has('failed'))
        <div class="alert alert-danger">
        {{ Session::get('failed') }}
        </div>
    @endif

    <div class="main-flex-container">
        <div class="details">
            <div class="logo">
                <h1>{{ settings()->auction_name }}</h1>
                <hr>
            </div>
            <div class="informations">
                <p>Offer a variety of exquisite Amber and 100% silver rosaries, necklaces, rings, bracelets , and pendants All of our pieces are uniquely designed We ship all over the US and Canada
                </p>
            </div>
            <a href="{{route('post.login',['service'=>'facebook'])}}" class="login-link"><img src="{{url('/')}}/icons/icons8-facebook.svg">Login with facebook</a>
            <div class="contact-us">
                <h3>Contact Us</h3>
                <div class="social-links">
                    <a href="#" class="facebook"><img src="{{url('/')}}/icons/icons8-facebook.svg"></a>
                    <a href="#" class="whatsapp"><img src="{{url('/')}}/icons/icons8-whatsapp.svg"></a>
                    <a href="#" class="instagram"><img src="{{url('/')}}/icons/insta.png"></a>
                </div>
                
            </div>
        </div>

        @include('user_layouts.ads-slider',['ads'=>$ads])
        
    </div>
    <script src="{{url('/')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{url('/')}}/js/popper.js"></script>
    <script src="{{url('/')}}/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/package/js/swiper.min.js"></script>
    <script src="{{url('/')}}/js/jquery.nicescroll.min.js"></script>
    <script src="{{url('/')}}/js/user.js"></script>
</body>
</html>