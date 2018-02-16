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
                <p>
                    Just send your API key and a URL to our API and we create a fresh screenshot for you.
                </p>
                <p>
                    Screenshots come as a file path or as a base64 encoded string. <b>Keep in mind that screenshots are deleted from our server after 1 hour.</b>
                </p>
            </div>
            <div class="col-sm-4">
                <h3>Open Source</h3>
                <p>The whole platform is Open Source. You can checkout the source code on <a href="https://github.com/stefanzweifel/screeenly">Github</a>.</p>
            </div>
            <div class="col-sm-4">
                <h3>Free</h3>
                <p>
                    There are no paid plans or other fees. screeenly currently runs on a 15$ server. If you want to support us you can <a href="https://buymeacoff.ee/3oQ64YW" target="_blank" ref="noopener">buy us a coffee</a> or use <a href="https://m.do.co/c/b8270043ffd3">this link</a> to create your next DigitalOcean Account.
                </p>
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
