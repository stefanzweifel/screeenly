@extends('layouts.marketing')

@section('content')

    <section class="u-background--primary u-white text-center c-hero">
        <div class="container">
            <h1 class="u-fs--ultra">Screenshot as a Service</h1>

            <p class="lead">Create website screenshots through a simple API. Try it. It's free!</p>

            <a href="/oauth/github/redirect" data-turbolinks="false" class="btn btn-black">
                Sign up with Github
            </a>
        </div>
    </section>

    <section class="container c-feature-set">

        <div class="row">
            <div class="col-sm-4">
                <h3>Simple</h3>
                <p>Our API is quite simple. You just send your API key and the URL of the website. Then we do some magic and send you a fresh screenshot back. No refresh tokens. No OAuth hassle.</p>
            </div>
            <div class="col-sm-4">
                <h3>Open Source</h3>
                <p>The whole platform is Open Source. You can checkout the source code on <a href="https://github.com/stefanzweifel/screeenly">Github</a>.</p>
                <p>We currently write some docs, so you can easily boot up your own version of Screeenly.</p>
            </div>
            <div class="col-sm-4">
                <h3>Free</h3>
                <p>
                    There are no hidden fees or monthly plans. If you like the project you can <a href="https://buymeacoff.ee/3oQ64YW" target="_blank" ref="noopener">buy us a coffee</a> and help keep the servers running.
                </p>
            </div>
        </div>

    </section>
    <section class="container c-feature-set">

        <div class="row">
            <div class="col-sm-6">
                <h3>BASE64 Encoded / Filepath</h3>
                <p>You receive your screenshot either as a file path or as base64 encoded string. <b>Keep in mind, your generated screenshot will be deleted from our servers 1 hour after it's creation.</b></p>
            </div>
            <div class="col-sm-6">
                <h3>Multiple API Keys</h3>
                <p>You like your stuff organized? Create up to 25 personal API keys.</p>
            </div>
        </div>
    </section>

    <div class="t-sponsored">

        <p>Sponsored by</p>
        <a href="http://bugsnag.com" target="_blank" rel="noopener noreferrer">
            @php
                include (public_path('images/bgsnag-logo.svg'))
            @endphp
        </a>

    </div>

@stop