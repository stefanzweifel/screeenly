<header>

    <div class="statusbar">
        <nav class="container">
            @if(Auth::check())
                <ul>
                    <li>{{ link_to_route('front.dashboard', 'Dashboard') }}</li>
                    <li>{{ link_to_route('front.settings', 'Settings') }}</li>
                    <li>{{ link_to_route('oauth.logout', 'Logout') }}</li>
                </ul>
            @else
                <ul>
                    <li>{{ link_to_route('oauth.github', 'Login with Github') }}</li>
                </ul>
            @endif
        </nav>
    </div>



</header>