<!-- top navigation -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{url('/')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="web/images/oo.png" alt=""></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>C</b><img src="web/images/oo.png" alt=""><img src="web/images/oo.png" alt="">ujina</span>
    </a>

    {{--<div class="login-logo" data-wow-duration="1000ms" data-wow-delay="500ms">--}}
        {{--<h1><a href="{{url('/')}}" style="color: white;"><span>C</span><img src="web/images/oo.png" alt=""><img src="web/images/oo.png" alt="">kery</a></h1>--}}
    {{--</div>--}}
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                {{--<li class="dropdown messages-menu">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                        {{--<i class="fa fa-envelope-o"></i>--}}
                        {{--<span class="label label-success">4</span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li class="header">You have 4 messages</li>--}}
                        {{--<li>--}}
                            {{--<!-- inner menu: contains the actual data -->--}}
                            {{--<ul class="menu">--}}
                                {{--<li><!-- start message -->--}}
                                    {{--<a href="#">--}}
                                        {{--<div class="pull-left">--}}
                                            {{--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}
                                        {{--</div>--}}
                                        {{--<h4>--}}
                                            {{--Support Team--}}
                                            {{--<small><i class="fa fa-clock-o"></i> 5 mins</small>--}}
                                        {{--</h4>--}}
                                        {{--<p>Why not buy a new awesome theme?</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<!-- end message -->--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<div class="pull-left">--}}
                                            {{--<img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">--}}
                                        {{--</div>--}}
                                        {{--<h4>--}}
                                            {{--AdminLTE Design Team--}}
                                            {{--<small><i class="fa fa-clock-o"></i> 2 hours</small>--}}
                                        {{--</h4>--}}
                                        {{--<p>Why not buy a new awesome theme?</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<div class="pull-left">--}}
                                            {{--<img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">--}}
                                        {{--</div>--}}
                                        {{--<h4>--}}
                                            {{--Developers--}}
                                            {{--<small><i class="fa fa-clock-o"></i> Today</small>--}}
                                        {{--</h4>--}}
                                        {{--<p>Why not buy a new awesome theme?</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<div class="pull-left">--}}
                                            {{--<img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">--}}
                                        {{--</div>--}}
                                        {{--<h4>--}}
                                            {{--Sales Department--}}
                                            {{--<small><i class="fa fa-clock-o"></i> Yesterday</small>--}}
                                        {{--</h4>--}}
                                        {{--<p>Why not buy a new awesome theme?</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<div class="pull-left">--}}
                                            {{--<img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">--}}
                                        {{--</div>--}}
                                        {{--<h4>--}}
                                            {{--Reviewers--}}
                                            {{--<small><i class="fa fa-clock-o"></i> 2 days</small>--}}
                                        {{--</h4>--}}
                                        {{--<p>Why not buy a new awesome theme?</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li class="footer"><a href="#">See All Messages</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <!-- Notifications: style can be found in dropdown.less -->
                @if(Auth::check() and isset($notifications) and count($notifications))
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">1</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Vous avez {{count($notifications)}} notification</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @foreach($notifications as $notification)
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-trophy text-green"></i>{{$notification->message}}<br>
                                            Vous êtes un chef.
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer"><a href="#"></a></li>
                        </ul>
                    </li>
                @endif
                <!-- Tasks: style can be found in dropdown.less -->
                {{--<li class="dropdown tasks-menu">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                        {{--<i class="fa fa-flag-o"></i>--}}
                        {{--<span class="label label-danger">9</span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li class="header">You have 9 tasks</li>--}}
                        {{--<li>--}}
                            {{--<!-- inner menu: contains the actual data -->--}}
                            {{--<ul class="menu">--}}
                                {{--<li><!-- Task item -->--}}
                                    {{--<a href="#">--}}
                                        {{--<h3>--}}
                                            {{--Design some buttons--}}
                                            {{--<small class="pull-right">20%</small>--}}
                                        {{--</h3>--}}
                                        {{--<div class="progress xs">--}}
                                            {{--<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                                {{--<span class="sr-only">20% Complete</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<!-- end task item -->--}}
                                {{--<li><!-- Task item -->--}}
                                    {{--<a href="#">--}}
                                        {{--<h3>--}}
                                            {{--Create a nice theme--}}
                                            {{--<small class="pull-right">40%</small>--}}
                                        {{--</h3>--}}
                                        {{--<div class="progress xs">--}}
                                            {{--<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                                {{--<span class="sr-only">40% Complete</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<!-- end task item -->--}}
                                {{--<li><!-- Task item -->--}}
                                    {{--<a href="#">--}}
                                        {{--<h3>--}}
                                            {{--Some task I need to do--}}
                                            {{--<small class="pull-right">60%</small>--}}
                                        {{--</h3>--}}
                                        {{--<div class="progress xs">--}}
                                            {{--<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                                {{--<span class="sr-only">60% Complete</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<!-- end task item -->--}}
                                {{--<li><!-- Task item -->--}}
                                    {{--<a href="#">--}}
                                        {{--<h3>--}}
                                            {{--Make beautiful transitions--}}
                                            {{--<small class="pull-right">80%</small>--}}
                                        {{--</h3>--}}
                                        {{--<div class="progress xs">--}}
                                            {{--<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                                {{--<span class="sr-only">80% Complete</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<!-- end task item -->--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li class="footer">--}}
                            {{--<a href="#">View all tasks</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ Auth::user()->image }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ Auth::user()->image }}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->first_name.' '.Auth::user()->last_name }}
                                <small>Membre depuis {{Auth::user()->created_at}}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        {{--<li class="user-body">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">Followers</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#" class="btn btn-default btn-flat btn-cook">Devenir un abonnées</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">Friends</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<!-- /.row -->--}}
                        {{--</li>--}}
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            @if(Auth::user()->role === \App\User::VISITOR)
                                <div style="text-align: center;">
                                    <a href="{{route('change-role')}}" class="btn btn-default btn-flat btn-cook" style="color: white;">Devenir un abonné</a>
                                </div>
                            @else
                                <div class="pull-left">
                                    <a href="{{route('profile')}}" class="btn btn-default btn-flat btn-cook" style="color: white;">@lang('messages.profile')</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat btn-cook" style="color: white;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">@lang('messages.logout')</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            @endif
                        </li>
                    </ul>
                </li>
                {{--<!-- Control Sidebar Toggle Button -->--}}
                {{--<li>--}}
                    {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </nav>
</header>