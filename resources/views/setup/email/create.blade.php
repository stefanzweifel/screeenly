@extends('layouts.app')

@section('content')

<div class="container">

    <div class="content">

        <h2>Setup</h2>
        <p>Welcome to Screeenly! You're account doesn't have an email address yet.</p>

        <p>We won't share this email address with any one! We will only send you an email, if we have an announcement to make!</p>

        <form method="post" action="/setup/email">

            {{ csrf_field() }}

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required class="form-control" placeholder="You're email address goese here">
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    @foreach($errors->get('email') as $message)
                    {{ $message}}
                    @endforeach
                </span>
            @endif

            <button type="submit" class="btn btn-success">Update Account</button>

        </form>

    </div>

</div>
@stop