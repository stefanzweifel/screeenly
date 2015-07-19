@extends ('layouts.master')

    @section('meta_title')
        Dashboard
    @stop

    @section('content')

        <div class="p2 bg-silver mb2">
            <p><b>Hi there! Thanks for using Screeenly.</b></p>
            You find instructions to use the API in our <a href="https://github.com/stefanzweifel/screeenly/wiki/Use-the-API" target="blank">Wiki on Github</a>.
            <br>PHP Developer? Checkout <a href="https://github.com/stefanzweifel/ScreeenlyClient">wnx/screeenly-client</a>
        </div>


        <h2>API Keys</h2>
        <p>Screeenly supports multiple API keys. Create and manage your keys here.</p>


        @if ($apikeys->count() <= 25)

            {!! Form::open(['route' => 'apikeys.store']) !!}

                @include('app.apikeys._form', ['buttonText' => 'Create key'])

            {!! Form::close() !!}

        @else

            <div class="p2 bg-orange white rounded mb2">
                Sorry, but you can only create up to 25 different API keys.
            </div>

        @endif

        @if ($apikeys->count() > 0)

            @include('app.apikeys._table', ['apikeys' => $apikeys])

            <div class="center mt1">
                <span class="gray">{{ $apikeys->count() }} / 25 keys</span>
            </div>

        @else

            <div class="flash flash-info">
                <p>You dont have any active API keys. Create one now.</p>
            </div>

        @endif

    @stop
