@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Registration Closed</div>
    <div class="panel-body">
        <p>The open source version of screeenly is no longer accepting new registrations and will shutdown on {{ config('screeenly.sunset_date') }}.</p>
        <p>
            If you need to continue using screeenly, consider switching to our paid version (https://3.screeenly.com/) or hosting this application on your own servers (https://github.com/stefanzweifel/screeenly/wiki/Requirements-and-Install).
        </p>
        <p><a href="https://stefanzweifel.dev">Learn more on the blog of the maintainer.</a></p>
    </div>
</div>

@endsection
