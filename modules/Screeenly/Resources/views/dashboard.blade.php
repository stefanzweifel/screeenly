@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="content">

        <div class="alert alert-info">
            <h4 style="margin-top: 0; margin-bottom: 1rem; font-weight: bold;">A brand new version of screeenly has been
                released ✨</h4>
            <p>screeenly v3 comes with an all new API. It allows you to generate screenshots or PDFs of websites or of
                your own HTML code.</p>
            <p>It is a new <b>paid</b> service. Subscribing to one of our plans ensures the future of screeenly. (This
                version of screeenly will remain available for the foreseeable future)</p>
            <p>
                <a href="https://3.screeenly.com?ref=screeenly.com" class="btn btn-success">
                    Check it out &rarr;
                </a>
            </p>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Documentation</div>

            <div class="panel-body">
                You can find our API documentation in our <a href="https://github.com/stefanzweifel/screeenly/wiki">Github Wiki</a>.
            </div>
        </div>

        @if ($apiKeys->count() < 10)
        <div class="panel panel-default">
            <div class="panel-heading">Create new API Keys</div>

            <div class="panel-body">
                @include('screeenly::api-keys._form')
            </div>
        </div>
        @else
            <div class="alert alert-warning">
                <i>You've reached the limit of active API keys.</i>
            </div>
        @endif

        @if ($apiKeys->count() > 0)
            <div class="panel panel-default">
                <div class="panel-heading">{{ $apiKeys->count() }} / 10 API Keys</div>
                @include('screeenly::api-keys._table')
            </div>
        @else
            <div class="alert alert-warning">
                <span>You currently don't have any API keys.</span>
            </div>
        @endif
    </div>
@stop
