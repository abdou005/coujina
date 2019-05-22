<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Cookery</title>
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
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="{{asset('web/js/move-top.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/easing.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
    <link href="{{asset('web/css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/component.css')}}" />
    <!-- animation-effect -->
    <link href="{{asset('web/css/animate.min.css')}}" rel="stylesheet">
    <script src="{{asset('web/js/wow.min.js')}}"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->
</head>
<body>
<div class="header">
    <div class="container">
        <div class="logo animated wow pulse" data-wow-duration="1000ms" data-wow-delay="500ms">
            <h1><a href="{{url('/')}}"><span>C</span><img src="/web/images/oo.png" alt=""><img src="/web/images/oo.png" alt="">ujina</a></h1>
        </div>
        @section('home','active')
        @include('web.includes.navigation')
        <div class="clearfix"></div>
    </div>
    <!-- start search-->
    <div class="banner">
        <p class="animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">partager vos recettes</p>
        <label></label>
        <h4 class="animated wow fadeInTop" data-wow-duration="1000ms" data-wow-delay="500ms">Bonjour et bienvenue à la nourriture</h4>
        <a class="scroll down" href="#content-down"><img src="/web/images/down.png" alt=""></a>
    </div>
</div>
<div class="container">
    <div class="row" style="text-align: center;">
        <div class="col-md-12 content-left animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
            <h3>@lang('messages.recipes')</h3>
            <label><i class="glyphicon glyphicon-menu-up"></i></label>
            <span>@lang('messages.many_variations')</span>
        </div>
    </div>
</div>
<!--content-->
<div class="content" id="content-down">
    <!--news-->
    <div class="content-top-top">
        <div class="container">
            <div class="news-bottom">
                @foreach($recipes as $recipe)
                    <div class="col-md-4 blog-top" style="margin-bottom: 20px;">
                        <div class="blog-in">
                            <a href="{{url('/recipe').$recipe->id}}"><img class="img-responsive" src="{{$recipe->image}}" alt="recette" style="width: 350px; height: 250px;"></a>
                            <div class="blog-grid">
                                <h3 style="height: 25px;"><a href="{{url('/recipe').$recipe->id}}">{{Str::limit($recipe->title, 20, ' (...)')}}</a></h3>
                                <div class="date">
                                    <span class="date-in"><i class="glyphicon glyphicon-calendar"> </i>22.08.2014</span>
                                    <a href="{{url('/recipe').$recipe->id}}" class="comments"><i class="glyphicon glyphicon-comment"></i> {{$recipe->comments_count}}  <span><i class="glyphicon glyphicon-heart" style="font-size: 14px;margin-right: 0.3em;vertical-align: middle;"></i> {{$recipe->likes_count}}</span></a>
                                    <div class="clearfix"> </div>
                                </div>
                                <p style="height: 50px;">{{Str::limit($recipe->desc, 50, ' (...)')}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="text-align: center;">
                <a class="link link-yaku" href="{{route('search-recipes')}}">
                    <span>@lang('messages.read_more')</span>
                </a>
            </div>
        </div>
    </div>
    <!--//news-->
    <!--services-->
    <div class="services">
        <div class="container">
            <div class="services-top">
                <div class="col-md-8 services-right animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                    <p>Avec vos recettes Vous avez le temps pour se préparer à une compétition.</p>
                </div>
                <div class="col-md-4 services-left animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">
                    <h3>@lang('messages.competitions')</h3>
                    <label><i class="glyphicon glyphicon-menu-up"></i></label>
                    <span>Participer à des compétitions</span>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="service-top">
                <div class="col-md-5 service-top animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                    <div class=" service-grid">
                        <div class="col-md-6 service-grid1">
                            <div class="hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a">
                                <a href="#" class="hi-icon hi-icon-mobile glyphicon glyphicon-leaf"></a>
                            </div>
                        </div>
                        <div class="col-md-6 service-grid1">
                            <div class="hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a">
                                <a href="#" class="hi-icon hi-icon-mobile glyphicon glyphicon-star-empty"></a>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class=" service-grid">
                        <div class="col-md-6 service-grid1">
                            <div class="hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a">
                                <a href="#" class="hi-icon hi-icon-mobile glyphicon glyphicon-folder-open"></a>
                            </div>
                        </div>
                        <div class="col-md-6 service-grid1">
                            <div class="hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a">
                                <a href="#" class="hi-icon hi-icon-mobile glyphicon glyphicon-home"></a>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-7 service-bottom animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">
                    @foreach($competitions as $competition)
                    <div class=" service-bottom1">
                        <div class=" ser-bottom">
                            <img src="{{$competition->image}}" class="img-responsive" style="width: 90px; height: 90px;" alt="">
                        </div>
                        <div class="ser-top ">
                            <h5>{{$competition->name}}</h5>
                            <p>{{$competition->desc}}</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    @endforeach
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col-md-12 content-left animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                <h3>@lang('messages.profiles')</h3>
                <label><i class="glyphicon glyphicon-menu-up"></i></label>
                <span>Voir tous les chefs et les amateurs</span>
            </div>
        </div>
    </div>
    <!--//services-->
    <div class="content-top-top">
        <div class="container">
            <div class="content-mid" id="content-conpetitions">
                @foreach($users as $user)
                    <div class="col-md-4">
                        <div class="media-left" style="text-align: center; padding-right: 0; display: block;">
                            <a href="#">
                                <img src="{{$user->image}}" alt="">
                            </a>
                        </div>
                        <p style="text-align: center">
                            {{$user->first_name.' '.$user->last_name}}
                        </p>
                    </div>
                @endforeach
                <div class="clearfix" style="padding: 20px;"></div>
                <div style="text-align: center;">
                    <a class="link link-yaku" href="{{route('search-users')}}">
                        <span>@lang('messages.read_more')</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('web.includes.footer')
</body>
</html>