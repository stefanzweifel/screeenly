@extends ('layouts.master')

    @section('meta_title')
        Email Settings
    @stop

    @section('content')

        <h1>Email Settings</h1>



        <p>It looks like, we couldn't find any email address in your Account.</p>
        <p>It would be great if you could leave your email in the form below, so we can reach you if something would change with Screeenly.</p>

        {!! Form::open(['route' => 'app.storeEmail']) !!}

            <label for="email">Your email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            @if ($errors->any())
                <small class="error">
                   {{ $errors->first('email') }}
                </small><br>
            @endif

            <button class="button small">Store email and proceed</button>

        {!! Form::close() !!}

    @stop