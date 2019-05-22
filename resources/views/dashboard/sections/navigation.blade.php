<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->image}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>En ligne</a>
            </div>
        </div>
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
                {{--<span class="input-group-btn">--}}
                {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
                {{--</button>--}}
              {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="@yield('profile') treeview">
                <a href="{{route('profile')}}">
                    <i class="fa fa-user-o"></i> <span>@lang('messages.profile')</span>
                </a>
            </li>
            @if(Auth::user()->role !== \App\User::VISITOR)
            <li class="@yield('ranking') treeview">
                <a href="{{route('ranking')}}">
                    <i class="fa fa-hourglass"></i> <span>@lang('messages.ranking')</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->role === \App\User::ADMIN)
                <li class="@yield('users') treeview">
                    <a href="{{route('users')}}">
                        <i class="fa fa-users"></i> <span>@lang('messages.users')</span>
                    </a>
                </li>
                <li class="@yield('recipes') treeview">
                    <a href="{{route('recipes.admin')}}">
                        <i class="fa fa-file-text"></i> <span>@lang('messages.recipes')</span>
                    </a>
                </li>
                <li class="@yield('competitions') treeview">
                    <a href="{{route('competitions')}}">
                        <i class="fa fa-trophy"></i> <span>@lang('messages.competitions')</span>
                    </a>
                </li>
            @endif
            <li class="@yield('') treeview">
                <a href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#logoutModal">
                    <i class="fa fa-sign-out"></i> <span>@lang('messages.logout')</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>