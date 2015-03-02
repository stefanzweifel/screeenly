@extends ('layouts.master')

    @section('meta_title')
        Email Settings
    @stop

    @section('content')

        <h1>Email Settings</h1>

        <p>It looks like, we couldn't find any email address in your Account.</p>
        <p>It would be great if you could leave your email in the form below, so we can reach you if something would change with Screeenly.</p>

        @include('app.partials._storeEmail', ['submitButtonText' => 'Store and proceed'])

    @stop