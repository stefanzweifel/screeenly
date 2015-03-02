<nav class="sidebar-nav">
    <ul>
        @if (Auth::check())
            <li><a class="{!! setActive('app.dashboard') !!}" href="/dashboard">Dashboard</a></li>
            <li><a class="{!! setActive('app.settings') !!}" href="/settings">Settings</a></li>
            <li><a class="{!! setActive('oauth.logout') !!}" href="/logout">Logout</a></li>
        @else
            <li><a class="{!! setActive('oauth.login') !!}" href="/login">Login</a></li>
        @endif

    </ul>

    <hr class="divider">

    <ul>
        <li><a class="{!! setActive('app.feedback') !!}" href="/feedback">Feedback</a></li>
        <li><a class="{!! setActive('app.statistics') !!}" href="/statistics">Statistics</a></li>
        <li><a class="{!! setActive('front.terms') !!}" href="/terms">Terms</a></li>
        <li><a class="{!! setActive('front.imprint') !!}" href="/imprint">Imprint</a></li>
        <li><a href="//github.com/stefanzweifel/screeenly/wiki" target="blank">Docs</a></li>
        <li><a href="//github.com/stefanzweifel/screeenly" target="blank">Source</a></li>
    </ul>
</nav>