<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@lang('messages.recipes')</title>
    <link href="{{asset('web/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('web/js/jquery.min.js')}}"></script>
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="{{asset('web/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Cookery Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!---->
    <link href='//fonts.googleapis.com/css?family=Raleway:400,200,100,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
    <link href="{{asset('web/css/styles.css')}}" rel="stylesheet" />
    <style>
        .btn-like-1{
            border-color: #8BC34A;
            border-style: double;
            border-width: 8px;
            border-radius: 10px;
            background-color: #000000;
        }
        .btn-like-1-span{
            color: #8BC34A;
        }

        .btn-like-2{
            border-color: white;
            border-style: double;
            border-width: 8px;
            border-radius: 10px;
            background-color: #000000;
        }
        .btn-like-2-span{
            color: white;
        }
        .link-yaku::before{
            border-width: 0;
        }

    </style>
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
        @section('recipes','active')
        @include('web.includes.navigation')

        <div class="clearfix"></div>
    </div>
    <!-- start search-->
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
<div class="col-md-offset-4 col-md-4 search-in animated wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
    <div class="search">
        <form>
            <input type="text" placeholder="@lang('messages.search_recipes')" name="name_search" id="name_search">
            <input type="submit" value="" >
        </form>
    </div>
</div>
<!--content-->
<div class="blog">
    <div class="container">
        <div class="col-md-9 blog-header" id="content-recipes">
            @foreach($recipes as $recipe)
                <div class="col-md-6 blog-top" style="margin-bottom: 20px;">
                    <div class="blog-in">
                        <a href="{{route('get-recipe-view', ['id' => $recipe->id])}}"><img class="img-responsive" src="{{$recipe->image}}" alt=" " style="width: 380px; height: 250px;"></a>
                        <div class="blog-grid">
                            <h3 style="height: 50px; margin-bottom: 10px;"><a href="{{route('get-recipe-view', ['id' => $recipe->id])}}">{{Str::limit($recipe->title, 45, ' (...)')}}</a></h3>
                            <p style="height: 100px;">{{Str::limit($recipe->desc, 100, ' (...)')}}</p>
                            <div style="text-align: center;">
                                @if(isset($recipe->is_Liked))
                                    <a class="link link-yaku btn-like" href="" data-recipe-id="{{$recipe->id}}">
                                        <button type="button" class="{{$recipe->is_Liked ? 'btn-like-1' : 'btn-like-2'}}" title="like"><span class="{{$recipe->is_Liked ? 'btn-like-1-span' : 'btn-like-2-span'}}"><i class="glyphicon glyphicon-heart"></i></span></button>
                                    </a>
                                @endif
                                <ul class="grid-news">
                                    <li><span style="color: black;"><i class="glyphicon glyphicon-comment"> </i>{{$recipe->comments_count}}</span><b>/</b></li>
                                    <li><span style="color: black;"><i class="glyphicon glyphicon-heart"> </i>{{$recipe->likes_count}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-3 categories-grid">
            <div class="grid-categories animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                <h4>type</h4>
                <ul class="popular">
                    @foreach($tags as $tag)
                    <li><a href="#" class="tag-search" data-tag="{{$tag->id}}"><i class="glyphicon glyphicon-menu-right"> </i>{{$tag->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="blog-bottom animated wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="500ms">
                <h4>Nouveautés</h4>
                @foreach($recipes as $recipe)
                <div class="product-go">
                    <a href="{{route('get-recipe-view', ['id' => $recipe->id])}}" class="fashion"><img class="img-responsive" src="{{$recipe->image}}" alt=""></a>
                    <div class="grid-product">
                        <a href="{{route('get-recipe-view', ['id' => $recipe->id])}}" class="elit">{{Str::limit($recipe->title, 20, ' ...')}}</a>
                        <p>{{Str::limit($recipe->desc, 40, ' ...')}}</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                    @if($loop->index === 9)
                        @break
                    @endif

                @endforeach
            </div>

        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!--//content-->
@include('web.includes.footer')
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
    var contentRecipes = $('#content-recipes');
    $('body').on('click', '.btn-like', function (event) {
        event.preventDefault();
        var btnLike = $(this).find('button');
        var spanLike = $(this).find('button span');
        var recipeId = $(this).data('recipeId');
        console.log(spanLike);
        if (btnLike.hasClass('btn-like-1')){ // is liked
            btnLike.removeClass('btn-like-1');
            spanLike.removeClass('btn-like-1-span');
            btnLike.addClass('btn-like-2');
            spanLike.addClass('btn-like-2-span');
            likeRecipe(recipeId, 'unlike')
        }else {
            btnLike.removeClass('btn-like-2');
            spanLike.removeClass('btn-like-2-span');
            btnLike.addClass('btn-like-1');
            spanLike.addClass('btn-like-1-span');
            likeRecipe(recipeId, 'like')
        }
    });
    $('body').on('click', '.tag-search', function (event) {
        event.preventDefault();
        getRecipes($('#name_search').val(), $(this).data('tag'));
    });
    /**
     * Like Recipe
     * @param recipeId
     * @param type
     */
    function likeRecipe(recipeId, type){
        $.ajax({
            method: 'POST',
            url : '/'+type+'-recipe/'+recipeId,
            contentType : false,
            processData : false
        }).done(function(response){
        }).error(function (error) {
        });
    }
    $('body').on('keyup', '#name_search', function (event) {
        event.preventDefault();
        var name = $(this).val();
        setTimeout(function(){
            getRecipes(name, null);
        }, 1000);
    });

    /**
     * get Recipes
     * @param name
     * @param tag
     */
    function getRecipes(name, tag){
        $.ajax({
            method: 'GET',
            url : '/search/recipes',
            data : {name : name, tag : tag}
        }).done(function(recipes){
            contentRecipes.html('');
            var html = '';
            $.each(recipes, function (index, recipe) {
                var htmlLike = '';
                if (recipe.is_Liked){
                    htmlLike = ' <a class="link link-yaku btn-like" href="" data-recipe-id="'+recipe.id+'">\n' +
                        '        <button type="button" class="btn-like-1" title="like"><span class="btn-like-1-span"><i class="glyphicon glyphicon-heart"></i></span></button>\n' +
                        '        </a>';
                }
                var urlViewRecipe = '/recipe-view/'+recipe.id;
                html+='                <div class="col-md-6 blog-top" style="margin-bottom: 20px;">\n' +
                    '                    <div class="blog-in">\n' +
                    '                        <a href="'+urlViewRecipe+'"><img class="img-responsive" src="'+recipe.image+'" alt=" " style="width: 380px; height: 250px;"></a>\n' +
                    '                        <div class="blog-grid">\n' +
                    '                            <h3 style="height: 50px; margin-bottom: 10px;"><a href="'+urlViewRecipe+'">'+recipe.title.substring(0, 45)+'</a></h3>\n' +
                    '                            <p style="height: 100px;">'+recipe.desc.substring(0, 100)+'</p>\n' +
                    '                            <div style="text-align: center;">'+htmlLike+'<ul class="grid-news">\n' +
                    '                                    <li><span style="color: black;"><i class="glyphicon glyphicon-comment"> </i>'+recipe.comments_count+'</span><b>/</b></li>\n' +
                    '                                    <li><span style="color: black;"><i class="glyphicon glyphicon-heart"> </i>'+recipe.likes_count+'</span></li>\n' +
                    '                                </ul>\n' +
                    '                            </div>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                </div>';
            });
            contentRecipes.append(html);
        }).error(function (error) {

        });
    }
</script>
</body>
</html>