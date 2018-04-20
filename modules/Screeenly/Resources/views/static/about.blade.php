@extends('layouts.app')

@section('title', 'About')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">About</div>
    <div class="panel-body">

        <h3>I have a problem. How can I reach you?</h3>
        <p>
            The best way is to send me an email at <a href="mailto:hello@stefanzweifel.io">hello@stefanzweifel.io</a> or @ me at <a href="http://twitter.com/@_stefanzweifel">@_stefanzweifel</a> or <a href="http://twitter.com/@screeenly">@screeenly</a> on Twitter.
        </p>
        <p>
            Due to the fact that this is just a sideproject I can't guarantee an answer in the next 5 minutes (I usually answer in the next 24 hours)
        </p>

        <h3>Is this service free?</h3>
        <p>
            Yes, screeenly is a free service. No hidden fees.
        </p>

        <h3>What data is beeing stored when using the service?</h3>

        <h4>Creating a new account (with email and password)</h4>

        <ul>
            <li>Your username</li>
            <li>Your email address</li>
            <li>Your password (salted and encrypted)</li>
        </ul>

        <h4>Creating a new account (through Github)</h4>
        <ul>
            <li>Your Github user ID</li>
            <li>Your public Github email address</li>
        </ul>

        <h4>Using the API (Creating a Screenshot)</h4>
        <p>All logs created by using the API are automatically deleted after 60 minutes.</p>

        <ul>
            <li>The ID of the API key used with the request</li>
            <li>The path to the screenshot file created during the request</li>
        </ul>

        <h3>Can I delete my account?</h3>
        <p>
            You can delete your account in your settings. All assoicated logs and APIs are immediately deleted.
        </p>

        <h3>How long are screenshots stored on your server?</h3>
        <p>
            All screenshots created have a lifetime of up to 60 minutes. After 60 minutes the files and the corresponding logs are being deleted from the server.
        </p>

        <h3>Where is screeenly.com hosted?</h3>
        <p>
            The application is currendly hosted on a <a href="https://digitalocean.com">Digital Ocean</a> Droplet in the FRA1 region.
        </p>

        <h3>Why does this service exist?</h3>
        <p>
            I created screeenly because I wasn't happy with other screenshot solutions available on the web (too expensive, too slow, don't support webfonts).
        </p>

        <h3>Is screeenly Open Source?</h3>
        <p>Yes, screeenly is Open Source. You can find the Source Code on <a href="//github.com/stefanzweifel/screeenly">Github</a>.</p>
        <p>The app is written PHP and built with the Laravel Framework.</p>


    </div>
</div>

@stop
