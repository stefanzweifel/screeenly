<header>

    <div class="statusbar">
        <nav class="container">
            @if(Auth::check())
                <ul>
                    <li>Settings</li>
                    <li>{{ link_to_route('oauth.logout', 'Logout') }}</li>
                </ul>
            @endif
        </nav>
    </div>

    <div class="appbar">

        <div class="container">

            <h1 class="material__display-3">@yield('page_title', 'Define page_title')</h1>

        </div>


    </div>

</header>