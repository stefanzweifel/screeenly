@extends ('layouts.master')

    @section('meta_title')
        Settings
    @stop

    @section('content')

        <h1>Settings</h1>

        <h2>Change Email address</h2>
        <p>Feel free to change your email address here. We won't bother you with marketing emails. We will only notice you, if something is changing with screeenly.</p>
        @include('app.partials._storeEmail', ['submitButtonText' => 'Update email'])

        <h2>Reset API Key</h2>
        <p>If you ever have the feeling to reset your API key, you can do this here.</p>
        @include('app.partials._resetKey')

        <h2>Close account</h2>
        <p>If you no longer wan't to use Screeenly, just hit that button down there. We will erase all your screenshots and will close your account.</p>
        <p>We would be pleased to hear why you left us. Just drop a line.</p>

        @include('app.partials._closeAccount')

    @stop
