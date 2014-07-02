@extends ('layouts.master')

    @section('meta_title')
        Screenly
    @stop

    @section('page_title')
        Screenshot-App
    @stop

    @section('content')

        <div class="card">
            <p>Get Screenshots from websites.</p>

            @if(Auth::check())
                {{ link_to_route('oauth.logout', 'Logout') }}
            @else
                {{ link_to_route('oauth.github', 'Login via Github') }}
            @endif

        </div>

    @stop