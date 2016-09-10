@extends('layouts.app')

@section('content')

<div class="container">

    <div class="content">

        <h1>Settings</h1>

        <form method="post" action="/settings/">

            <h3>Update Email Address</h3>
            <p>Feel free to change your email address here. We won't bother you with marketing emails. We will only notice you, if something is changing with screeenly.</p>

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


        <hr>

        <form method="post" action="/settings/account">

            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">

            <button type="submit" class="btn btn-danger">Close Account</button>

        </form>

    </div>
</div>
@stop