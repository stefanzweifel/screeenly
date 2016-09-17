@extends('layouts.app')

@section('content')

<div class="container">
    @if (Route::has('login'))
    <div class="top-right links">
        <a href="{{ url('/login') }}">Login</a>
        <a href="{{ url('/register') }}">Register</a>
    </div>
    @endif

    <div class="content">
        <div class="text-center">
            <h1>screeenly</h1>
            <h2>Screenshot as a Service</h2>

            <a href="/oauth/github/redirect" class="btn btn-default">Github</a>
        </div>

        <ul>
            <li>Sponsored by Bugsnag</li>
        </ul>

    </div>
</div>
@stop