<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{$recipe->title}}</title>
    <link href="{{asset('web/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('web/js/jquery.min.js')}}"></script>
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="{{asset('web/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <!--//theme-style-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Cookery Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!---->
    <link href='//fonts.googleapis.com/css?family=Raleway:400,200,100,300,500,600,700,800,900' rel='stylesheet'
          type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet'
          type='text/css'>
    <link href="{{asset('web/css/styles.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
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
            <h1><a href="{{url('/')}}"><span>C</span><img src="/web/images/oo.png" alt=""><img src="/web/images/oo.png"
                                                                                               alt="">kery</a></h1>
        </div>
        @section('recipes','active')
        @include('web.includes.navigation')
        <div class="clearfix"></div>
    </div>
    <!-- start search-->
</div>
<!--content-->
<div class="blog">
    <div class="container">
        <div class="col-md-9 ">
            <!--content-->
            <div class="single">
                <div class="single-top">
                    <img class="img-responsive wow fadeInUp animated" data-wow-delay=".5s" src="{{$recipe->image}}"
                         alt=""/>
                    <div class="lone-line">
                        <h4>{{$recipe->title}}</h4>
                        <ul class="grid-blog">
                            <li><span><i class="glyphicon glyphicon-time"> </i>{{$recipe->created_at}}</span></li>
                            <li><a href="#"><i class="glyphicon glyphicon-comment"> </i>{{$recipe->count_comments}}</a>
                            </li>
                            <li><a href="#"><i class="glyphicon glyphicon-heart"> </i>{{$recipe->count_likes}}</a></li>
                        </ul>
                        <p class="wow fadeInLeft animated" data-wow-delay=".5s">{{$recipe->desc}}</p>
                    </div>
                </div>
                <div class="comment">
                    <h3>Commentaires</h3>
                    <div class="content-comments">

                    </div>
                </div>
                @if(Auth::check())
                    <div class="leave">
                        <h3>Laissez un commentaire</h3>
                        <form method="POST" action="{{url('/recipe').'/'.$recipe->id.'/comment'}}" name="form-comment" id="form-comment">
                            <div class="single-grid wow fadeInLeft animated" data-wow-delay=".5s">
                                {{--<input type="text" value="Name" name="" onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Name';}">--}}
                                {{--<input type="text" value="E-mail" onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'E-mail';}">--}}
                                {{--<input type="text" value="Web site" onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Web site';}">--}}
                                <textarea value="" onfocus="this.value='';" id="comment" name="comment"
                                          onblur="if (this.value == '') {this.value = 'Comment';}">Votre Commentaire</textarea>
                                <button class="btn btn-sm btn-default btn-cook" id="save-comment" type="submit">Ajouter</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            <!---->
            <!--//content-->
        </div>
        <div class="col-md-3 categories-grid">
            <div class="blog-bottom animated wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="500ms">
                <h4>Nouveautés</h4>
                @foreach($recipes as $recipeNews)
                    <div class="product-go">
                        <a href="{{route('get-recipe-view', ['id' => $recipeNews->id])}}" class="fashion"><img class="img-responsive"
                                                                                          src="{{$recipeNews->image}}"
                                                                                          alt=""></a>
                        <div class="grid-product">
                            <a href="{{route('get-recipe-view', ['id' => $recipeNews->id])}}"
                               class="elit">{{Str::limit($recipeNews->title, 20, ' ...')}}</a>
                            <p>{{Str::limit($recipeNews->desc, 40, ' ...')}}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @if($loop->index === 9)
                        @break
                    @endif
                @endforeach
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--//content-->
@include('web.includes.footer')
<script src="{{asset('/js/global.js')}}"></script>

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


    var recipeId = '{{$recipe->id}}';
    LoadComments(recipeId);
    /**
     * Ajax function edit Slider
     */
    function LoadComments(recipeId) {
        $.ajax({
            method: 'GET',
            url: '/recipe/' + recipeId+'/comments',
            data: {}
        }).done(function (comments) {
            var html = '';
            $('.content-comments').html('');
            $.each(comments, function (index, comment) {
                html += '<div class="media wow fadeInLeft animated" data-wow-delay=".5s">\n' +
                    '                        <div class="code-in">\n' +
                    '                            <p class="smith"><a href="#">'+comment.user.first_name+' '+comment.user.last_name+'</a> <span>'+comment.created_date+'</span></p>\n' +
                    '                            <p class="reply"><a href="#"><i class="glyphicon glyphicon-repeat"> </i></a></p>\n' +
                    '                            <div class="clearfix"></div>\n' +
                    '                        </div>\n' +
                    '                        <div class="media-left">\n' +
                    '                            <a href="#">\n' +
                    '                                <img src="'+comment.user.image+'" alt="">\n' +
                    '                            </a>\n' +
                    '                        </div>\n' +
                    '                        <div class="media-body">\n' +
                    '                            <p>'+comment.comment+'</p>\n' +
                    '                        </div>\n' +
                    '   </div>';
            });
            $('.content-comments').append(html);
        }).error(function (data) {
            console.log(data);
        });
    }

    $(function(){
       $('#form-comment').submit(function(event){
           event.preventDefault();
           $('#save-comment').prop('disabled', true);
           var formData = new FormData($('#form-comment')[0]);
           var url = $('#form-comment')[0].action;
           $.ajax({
               method : 'POST',
               url : url,
               data : formData,
               contentType : false,
               processData : false
           }).done(function (comment) {
               var html = '<div class="media wow fadeInLeft animated" data-wow-delay=".5s">\n' +
                   '                        <div class="code-in">\n' +
                   '                            <p class="smith"><a href="#">'+comment.user.first_name+' '+comment.user.last_name+'</a> <span>'+comment.created_date+'</span></p>\n' +
                   '                            <p class="reply"><a href="#"><i class="glyphicon glyphicon-repeat"> </i></a></p>\n' +
                   '                            <div class="clearfix"></div>\n' +
                   '                        </div>\n' +
                   '                        <div class="media-left">\n' +
                   '                            <a href="#">\n' +
                   '                                <img src="'+comment.user.image+'" alt="">\n' +
                   '                            </a>\n' +
                   '                        </div>\n' +
                   '                        <div class="media-body">\n' +
                   '                            <p>'+comment.comment+'</p>\n' +
                   '                        </div>\n' +
                   '   </div>';
               $('.content-comments').prepend(html);
               $('#comment').val('');
               $('#save-comment').prop('disabled',false);
           }).error(function () {
               $('#save-comment').prop('disabled',false);
           });

       });
    });
</script>

</body>
</html>