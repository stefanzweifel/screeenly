@extends ('layouts.master')

    @section('meta_title')
        Dashboard
    @stop

    @section('content')

        <div class="message">
            <p>Hi there! Thanks for using Screeenly.</p>
            <p>If you find any bugs or just want to leave some feedback you can use <a href="https://docs.google.com/forms/d/1rSfWcUrPCf2Ony3blKh6L3dOQiIanVKU0HZ0Org4eFs/viewform?usp=send_form">this Google Form</a>.</p>
        </div>

        <h2>API Key</h2>
        <p>Please use the following key with when using our API.</p>

        <div class="message"><code>{{ $user->api_key }}</code></div>

        <p>If you ever want to reset your API Key kust click on the following button.</p>
        {{ Form::open(array('route' => 'front.resetAPIKey')) }}
            <button class="button small">Reset API Key now</button>
        {{ Form::close() }}

        <h2>Statistic</h2>
        <p>You created {{ count($logs) }} Screenshots so far.</p>

        <h2>Close Account</h2>
        <p>If you no longer wan't to use Screeenly, just hit that button down there. We will erase all your screenshots and will close your account.</p>
        <p>We would be pleased to hear why you left us. Just drop a line.</p>

        {{ Form::open(array('route' => 'front.closeAccount')) }}
            <button class="button small">Close Account</button>
        {{ Form::close() }}

    @stop
