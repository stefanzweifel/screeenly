@extends('layouts.app')

@section('title', 'About')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">About</div>
    <div class="panel-body">


            <dl>
                <dt>I have a problem. How can I reach you?</dt>
                <dd>
                     <p>
                        The best way is to send us an email at <a href="mailto:hello@stefanzweifel.io">hello@stefanzweifel.io</a> or Tweet us at <a href="http://twitter.com/screeenly">@screeenly</a>
                    </p>
                    <p>
                        Due to the fact that this is just a sideproject we can't guarantee and answer in the next 5 minutes (But we try to answer questions as soon as possible)
                    </p>
                </dd>
                <dt>Is this service free?</dt>
                <dd>
                    Yes. Screeenly <b>is free for everyone</b>!
                </dd>

                <dt>What about the screenshots?</dt>
                <dd>
                    All screenshots created have a lifetime of up to 60 minutes. After 60 minutes the files are being deleted from the server.
                </dd>
                <dt>Where is screeenly.com hosted?</dt>
                <dd>
                    The application is currendly hosted on a <a href="https://digitalocean.com">Digital Ocean</a> Droplet in the FRA1 region.
                </dd>

                <dt>Why does this service exist?</dt>
                <dd>
                    I created screeenly because I wasn't happy with current solutions.
                    So I wrote my own public API and with the help of Laravel and other Open Source Packages screeenly was born.
                </dd>

                <dt>Is screeenly Open Source?</dt>
                <dd>
                    <p>Yes, screeenly is Open Source. You can find the Source Code on <a href="//github.com/stefanzweifel/screeenly">Github</a>.</p>
                    <p>The app is written PHP and built upon the Laravel Framework.</p>
                </dd>

                <dt>Which data is stored (or not stored) when using the API?</dt>
                <dd>
                    <h5>Stored (temporarily)</h5>
                    <ul>
                        <li>API Key used to generate Screenshot</li>
                    </ul>

                    <h5>Never stored</h5>

                    <ul>
                        <li>URL for which Screenshot is generated</li>
                    </ul>
                </dd>

                <dt>How can I support the project?</dt>
                <dd>
                    <ul>
                        <li>Open Issues on <a href="//github.com/stefanzweifel/screeenly">Github</a> if you found a Bug</li>
                        <li>Open a Pull Request on <a href="//github.com/stefanzweifel/screeenly">Github</a></li>
                        <li>If you're a designer, you could design a new logo</li>
                        <li>If you're a writer, you could improve the copy text within the application or in our documentation</li>
                    </ul>
                </dd>
            </dl>
    </div>
</div>


@stop