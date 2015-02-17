<header class="nav-background">

    <nav class="container">
        <ul class="nav-left">
            <li><a class="nav-logo" href="/">screeenly</a></li>
        </ul>
        @if(Auth::check())
            <ul class="nav-right">
                <li>{!! link_to_route('front.dashboard', 'Dashboard') !!}</li>
                <li>{!! link_to_route('oauth.logout', 'Logout') !!}</li>
            </ul>
        @else
            <ul class="nav-right">
                <li>{!! link_to_route('login', 'Sign in') !!}</li>
            </ul>
        @endif
    </nav>

</header>