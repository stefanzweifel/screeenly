@extends ('layouts.master')

@section('meta_title')
    Edit API key
@stop

@section('content')

    <h1>Edit API Key</h1>

    {!! Form::model($apikey, ['route' => ['apikeys.update', $apikey->id], 'method' => 'PATCH']) !!}

        @include('app.apikeys._form', ['buttonText' => 'Save changes'])

    {!! Form::close() !!}

@stop