@extends ('layouts.master')

    @section('meta_title')
        Dashboard
    @stop

    @section('content')

        <h1>Dashboard</h1>

        <div class="flash flash-info">
            <p>Hi there! Thanks for using Screeenly.</p>
            <p>You find instructions to use the API in our <a href="https://github.com/stefanzweifel/screeenly/wiki/Use-the-API" target="blank">Wiki on Github</a>.</p>
        </div>

        <h2>API Key</h2>
        <p>Please use the following key with when using our API. You can reset your API key in your <a href="/settings">settings</a>.</p>
        <code class="code">{{ Auth::user()->api_key }}</code>

    @stop
