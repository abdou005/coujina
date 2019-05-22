<div class="nav-icon">
    <a href="#" class="navicon"></a>
    <div class="toggle">

        <ul class="toggle-menu">
            <li><a href="{{route('home')}}" class="@yield('home')">@lang('messages.home')</a></li>
            <li><a href="{{route('search-recipes')}}" class="@yield('recipes')">@lang('messages.recipes')</a></li>
            <li><a href="{{route('search-users')}}" class="@yield('profiles')">@lang('messages.profiles')</a></li>
            @if(Auth::check())
                @if(Auth::user()->role === \App\User::SUBSCRIBER || Auth::user()->role === \App\User::LEADER)
                    <li><a href="{{route('search-competitions')}}" class="@yield('competitions')">@lang('messages.competitions')</a></li>
                @endif
                <li><a href="{{route('profile')}}">@lang('messages.my_account')</a></li>
                <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('messages.logout')</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <li><a href="{{route('login')}}">@lang('messages.subject_connect')</a></li>
                <li><a href="{{route('register')}}">@lang('messages.subject_register')</a></li>
            @endif
        </ul>
    </div>
    <script>
        $('.navicon').on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass('navicon--active');
            $('.toggle').toggleClass('toggle--active');
        });
    </script>
</div>