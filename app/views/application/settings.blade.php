@extends ('layouts.master')

    @section('meta_title')
        Screenly
    @stop

    @section('page_title')Settings @stop

    @section('content')

        <div class="card">

            <h2 class="material--display-1">User settings</h2>
            <p class="material--body-1">You were registered with your primary Github email address ( {{ $user->email }} ).</p>

            <hr>

            <h2 class="material--display-1">API settings and stats</h2>

            <div class="message">Your current API Key is <code>{{ $user->api_key }}</code>.</div>

            <p class="material--body-1">You signed up at {{ $user->created_at }}.</p>
            <p class="material--body-1">You created {{ count($logs) }} Screenshots so far.</p>

            {{ Form::open(array('route' => 'front.resetAPIKey')) }}
                <button>Reset API Key now</button>
            {{ Form::close() }}

            <hr>

            <h2 class="material--display-1">Close account</h2>
            <p class="material--body-1">If you no longer wan't to use Screenly, just hit that button down there. We will erase all your screenshots and will close your account.</p>
            <p class="material--body-1">We would be pleased to hear why you left us. Just drop a line.</p>

            {{ Form::open(array('route' => 'front.closeAccount')) }}
                <button>Close Account</button>
            {{ Form::close() }}

            <!-- Shadow -->
            <div class="paper-shadow paper-shadow-bottom-z-1"></div>
            <div class="paper-shadow paper-shadow-top-z-1"></div>
        </div>

    @stop
