<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@lang('messages.competitions')</title>
    <link href="{{asset('web/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('web/js/jquery.min.js')}}"></script>
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="{{asset('web/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="{{asset('web/css/component.css')}}" rel="stylesheet" type="text/css" />

    <!-- animation-effect -->
    <link href="{{asset('web/css/animate.min.css')}}" rel="stylesheet">
    <script src="{{asset('web/js/wow.min.js')}}"></script>
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
        @section('competitions','active')
        @include('web.includes.navigation')
        <div class="clearfix"></div>
    </div>
    <!-- start search-->
</div>
<!--content-->
<div class="content">
    <div class="events">
        <div class="container">
            <div class="events-top">
                <div class="col-md-4 events-left animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                    <h3>@lang('messages.competitions')</h3>
                    <label><i class="glyphicon glyphicon-menu-up"></i></label>
                    <span>Participer à des compétitions</span>
                </div>
                <div class="col-md-8 events-right animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">
                    <p>
                        Avec vos recettes Vous avez le temps pour se préparer à une compétition
                    </p>
                </div>
                <div class="clearfix"> </div>
            </div>
            @foreach($competitions as $competition)
                <div class="events-bottom">
                    <div class="col-md-5 events-bottom1 animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">
                        <a href="#"><img src="{{$competition->image}}" alt="" class="img-responsive"></a>
                    </div>
                    <div class="col-md-7 events-bottom2 animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                        <h3>{{$competition->name}}</h3>
                        <label><i class="glyphicon glyphicon-menu-up"></i></label>
                        <p>
                           {{'Du '.$competition->start_at. ' au '.$competition->end_at}}
                        </p>
                        <p>{{$competition->desc}}</p>
                        <div class="read-more">
                            <a class="link link-yaku" data-toggle="modal" data-competition-id="{{$competition->id}}" data-target="#myModal">
                                <span>@lang('messages.participate')</span>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Mes recettes</h4>
            </div>
            <div class="modal-body content-modal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
</div>
@include('web.includes.footer')
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>
<script>
    /**
     * add the token to all request headers. This provides simple,
     * convenient CSRF protection for your AJAX based applications:
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /**
     *Attach Click event to participate
     */
    $(function () {
        $( ".events-bottom" ).on( "click",".link-yaku", function( event ) {
            event.preventDefault();
            var competitionId = ($(this).data('competitionId'));
            loadRecipes(competitionId);
        });
    });

    $(function () {
        $( ".content-modal" ).on( "click",".add-recipe", function( event ) {
            event.preventDefault();
            var competitionId = ($(this).data('competitionId'));
            var recipeId = ($(this).data('recipeId'));
            participate(competitionId, recipeId);
        });
    });
    /**
     * add or participate
     * @param competitionId
     * @param recipeId
     */
    function participate(competitionId, recipeId){
        var url = '/participate/' + competitionId + '/' + recipeId;
        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            processData: false,
            async:false,
            success: function (response) {
                loadRecipes(competitionId);
            },
            error: function (response) {
                loadRecipes(competitionId);
            }
        });
    }
    /**
     * Ajax function edit Slider
     */
    function loadRecipes(competitionId){
        $.ajax({
            method : 'GET',
            url : '/get-recipes-participate/'+competitionId,
            data : {}
        }).done(function (recipes) {
            var html = '';
            $('.content-modal').html('');
            $.each(recipes, function( index, recipe ) {
                html+='<div class="product-go">\n' +
                    '                    <a href="#" class="fashion"><img class="img-responsive" src="'+recipe.image+'" alt=""></a>\n' +
                    '                    <div class="grid-product">\n' +
                    '                        <a href="#" class="elit">'+recipe.title+'</a>\n' +
                    '                        <p>'+recipe.desc+'</p><button type="button" class="btn btn-sm btn-default btn-cook add-recipe" data-recipe-id="'+recipe.id+'" data-competition-id="'+competitionId+'">Ajouter</button>\n' +
                    '                    </div>\n' +
                    '                    <div class="clearfix"> </div>\n' +
                    '                </div>';
            });
            $('.content-modal').html(html);
        }).error(function (data) {
            console.log(data);
        });
    }
</script>
</body>
</html>