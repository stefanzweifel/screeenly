@extends ('layouts.master')

@section('meta_title')
    Try Screeenly
@stop

@section('content')

    <div class="clearfix">
        <div class="col lg-col-6">

            <h1>Try Screeenly right now!</h1>
            <p>Just enter a public accessible URL and we generate a screenshot for you. Depending on the size of the entered page, the rendering can take some seconds.</p>

            {!! Form::open(['url' => 'try', 'method' => 'POST']) !!}

                {!! Form::input('hidden', 'key', 'this-is-just-a-dummy-key') !!}

                {!! Form::label('url', 'URL of website') !!}
                {!! Form::input('text', 'url', 'http://laravel.com', ['required', 'class' => 'block col-12 field rounded-bottom y-group-item mb1']) !!}

                {!! Form::label('proof', "Proof your human") !!}
                {!! Form::input('text', 'proof', null, ['required', 'placeholder' => 'Which framework was used to create Screeenly?', 'class' => 'block col-12 field rounded-bottom y-group-item mb2']) !!}

                <button class="btn btn-primary">Create Screenshot</button>

            {!! Form::close() !!}


        </div>
    </div>

    <div class="clearfix m2">
        @if (Session::has('asset') === true)
            <img src="{!! Session::get('asset') !!}" alt="A randomly generated Screenshot" class="border">
        @endif
    </div>

@stop