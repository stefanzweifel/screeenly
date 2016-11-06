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

        <div class="panel panel-default">
            <div class="panel-heading">Create new API Keys</div>

            <div class="panel-body">
                @include('screeenly::api-keys._form')
            </div>
        </div>


        @if (count($apiKeys) > 0)

            <div class="panel panel-default">
                <div class="panel-heading">API Keys</div>
                @include('screeenly::api-keys._table')
            </div>

        @else
            <div class="alert alert-warning">
                <span>You currently doesn't have an API keys.</span>
            </div>
        @endif

    </div>
@stop