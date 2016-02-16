<nav class="relative clearfix white bg-orange">

    <div class="container">

        <div class="left">
            {!! link_to_route('home.landingpage', 'screeenly', [], ['class' => 'btn py2 m0']) !!}
        </div>
        <div class="left md-show">

            @if (Auth::check())
                <a class="btn py2 m0 {!! setActive('app.dashboard') !!}" href="/dashboard">Dashboard</a>
            @else
                <a href="/try" class="btn py2 m0 {!! setActive('try') !!}">Try it</a>
            @endif
        </div>

        <div class="right md-show">
            @if (Auth::check())
                <a class="btn py2 m0 {!! setActive('app.settings') !!}" href="/settings">Settings</a>
                <a class="btn py2 m0 {!! setActive('oauth.logout') !!}" href="/logout">Logout</a>
            @else
                <a class="btn py2 m0 {!! setActive('oauth.login') !!}" href="/login">Login</a>
            @endif
        </div>

        <div class="right md-hide">
            <div id="account-menu" class="inline-block" data-disclosure>
                <div data-details class="fixed top-0 right-0 bottom-0 left-0"></div>
                <a href="#!" class="btn py2 m0">
                    <span class="md-hide">Menu &#9662;</span>
                    <span class="md-show">More &#9662;</span>
                </a>
                <div data-details class="absolute right-0 xs-left-0 sm-col-6 md-col-4 lg-col-3 nowrap white bg-black rounded-bottom">
                    <ul class="h5 list-reset py1 mb0">
                        @if (Auth::check())
                            <li><a class="btn py2 m0 {!! setActive('app.settings') !!}" href="/settings">Settings</a></li>
                            <li><a class="btn py2 m0 {!! setActive('oauth.logout') !!}" href="/logout">Logout</a></li>
                        @else
                            <li><a class="btn py2 m0 {!! setActive('oauth.login') !!}" href="/login">Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>

</nav>