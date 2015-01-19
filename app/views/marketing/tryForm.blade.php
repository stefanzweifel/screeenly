@extends ('layouts.master')

@section('meta_title')
    Try Screeenly
@stop

@section('content')

    <h1>Try Screeenly right now!</h1>
    <p>Just enter a public accessible URL and we generate a screenshot for you. Depending on the size of the entered page, the rendering can take some seconds.</p>

    {{ Form::open(['url' => 'try', 'method' => 'POST']) }}

        {{ Form::input('hidden', 'key', 'this-is-just-a-dummy-key') }}

        {{ Form::label('url', 'URL of website') }}
        {{ Form::input('text', 'url', 'http://medium.com', ['required']) }}

        {{ Form::label('proof', "Proof your human") }}
        {{ Form::input('text', 'proof', null, ['required', 'placeholder' => 'Which framework was used to create Screeenly?']) }}

        <button class="button small">Create Screenshot</button>

    {{ Form::close() }}

    @if (Session::has('asset') === true)
        <img src="{{ Session::get('asset') }}" alt="A randomly generated Screenshot">
    @endif

@stop