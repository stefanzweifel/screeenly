@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="content">

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