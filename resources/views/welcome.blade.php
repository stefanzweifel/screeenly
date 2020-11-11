@extends('layouts.marketing')

@section('content')

    <section class="u-background--primary u-white c-hero">

        <div class="container">
            <div class="alert alert-info text-left">
                <h4 style="margin-top: 0; margin-bottom: 1rem; font-weight: bold;">A brand new version of screeenly has been released ✨</h4>
                <p>screeenly v3 comes with an all new API. It allows you to generate screenshots or PDFs of websites or of your own HTML code.</p>
                <p>It is a new <b>paid</b> service. Subscribing to one of our plans ensures the future of screeenly. (This version of screeenly will remain available for the foreseeable future)</p>
                <p>
                    <a href="https://3.screeenly.com?ref=screeenly.com" class="btn btn-success">
                        Check it out &rarr;
                    </a>
                </p>
            </div>
        </div>

        <div class="container text-center ">
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
                    There are no paid plans or other fees. screeenly currently runs on a 15$ server. If you want to support me you can <a href="https://buymeacoff.ee/3oQ64YW" target="_blank" ref="noopener">buy me a coffee</a> or use <a href="https://m.do.co/c/b8270043ffd3">this link</a> to create your next DigitalOcean Account.
                </p>
            </div>
        </div>

    </section>

@stop
