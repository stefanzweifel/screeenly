@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        <h1>screeenly</h1>
        <p>Screenshot as a Service</p>

        <a href="/oauth/github/redirect" data-turbolinks="false" class="btn btn-default">Sign in with Github</a>

    </div>

        <ul>
            <li>Sponsored by Bugsnag</li>
        </ul>

@stop