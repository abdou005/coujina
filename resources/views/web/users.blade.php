<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@lang('messages.profiles')</title>
    <link href="{{asset('web/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('web/js/jquery.min.js')}}"></script>
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="{{asset('web/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Cookery Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!---->
    <link href='//fonts.googleapis.com/css?family=Raleway:400,200,100,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
    <link href="{{asset('web/css/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('web/css/component.css')}}" rel="stylesheet" type="text/css" />

    <!-- animation-effect -->
    <link href="{{asset('web/css/animate.min.css')}}" rel="stylesheet">
    <script src="{{asset('web/js/wow.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->

</head>
<body>
<div class="header head">
    <div class="container">
        <div class="logo animated wow pulse" data-wow-duration="1000ms" data-wow-delay="500ms">
            <h1><a href="{{url('/')}}"><span>C</span><img src="/web/images/oo.png" alt=""><img src="/web/images/oo.png" alt="">ujina</a></h1>
        </div>
        @section('profiles','active')
        @include('web.includes.navigation')
        <div class="clearfix"></div>
    </div>
    <!-- start search-->
</div>
<!--content-->
<div class="content">
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col-md-12 content-left animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                <h3>@lang('messages.profiles')</h3>
                <label><i class="glyphicon glyphicon-menu-up"></i></label>
                <span>Voir tous les chefs et les amateurs</span>
            </div>
        </div>
    </div>
    <div class="col-md-offset-4 col-md-4 search-in animated wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
        <div class="search">
            <form>
                <input type="text" placeholder="@lang('messages.search_users')" required="">
                <input type="submit" value="" >
            </form>
        </div>
    </div>
    <div class="events">
        <div class="container">
            @foreach($users as $user)
                <div class="col-md-3">
                    <div class="panel panel-default" style="border-color: #8BC34A;">
                        <div class="panel-heading" style="color: white;background-color: #8BC34A;border-color: #8BC34A;">
                            <h3 class="profile-username text-center @if($user->role === \App\User::LEADER) {{'leader'}}@endif ">{{$user->first_name.' '.$user->last_name}}</h3>
                        </div>
                        <div class="panel-body" style="width: 253px; height: 150px;">
                            <div class="media-left" style="text-align: center; padding-right: 0; display: block;">
                                <a href="#">
                                    <img src="{{$user->image}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@include('web.includes.footer')
</body>
</html>