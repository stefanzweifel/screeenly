@extends ('layouts.master')

@section('meta_title')
    Terms of Service & FAQ
@stop

@section('content')

    <article>
        <h2>I have a problem. How can I reach you?</h2>
        <p>You can always send me an <a href="mailto:hello@screeenly.com">Email</a>, a <a href="http://twitter.com/screeenly">Tweet</a> or leave your Feedback <a href="//docs.google.com/forms/d/1rSfWcUrPCf2Ony3blKh6L3dOQiIanVKU0HZ0Org4eFs/viewform?usp=send_form">here</a>.</p>

        <p>Due to the fact that this is just a sideproject I can't guarantee and answer in the next 5 minutes. But I try to answer questions as fast a possible.</p>
    </article>

    <article>
        <h2>Is this service free?</h2>
        <p>Yes. Screeenly is free.</p>
        <p>However, if Screeenly would get really popular and the server would run into problems, I would have to find a solution on how to keep the service alive. Maybe there will come a paid plan (with more features?) but early adopters can use this service for free. Forever.</p>
        <p>(Or you selfhost it on your own server).</p>
    </article>

    <article>
        <h2>What about the screenshots?</h2>
        <p>All screenshots you create with our API have a lifetime of <strong>12 hours! (Screeenly does not host your images)</strong> After 12 hours the file will be deleted from our server.</p>

        <p>Concering privacy, Screeenly is hosted on <a href="//uberspace.de">Uberspace</a>, a German hosting solution.</p>
    </article>

    <article>
        <h2>Why does this service exist?</h2>
        <p>I created Screeenly because I wasn't happy with other solutions on the internet. So I wrote my own public API and with the help of Laravel and other Open Source Packages Screeenly was born.</p>
        <p>Screeenly is also <a href="//github.com/stefanzweifel/screeenly">Open Source</a>! So you could selfhost the whole application. You just need PHP and MySQL.</p>
    </article>

    <article>
        <h2>How can I support you?</h2>
        <p>You can do different things:
        <ul>
            <li>Make a pull-request on <a href="//github.com/stefanzweifel/screeenly">Github</a></li>
            <li>share us on all those social networks</li>
            <li>Send us <a href="mailto:hello@screeenly.com">emails</a></li>
            <li>Create a better design / logo / styleguide</li>
        </ul>
        </p>
    </article>

    <article>
        <h2>Good to know</h2>
        <p>We also use <a href="//google.com/analytics">Google Analytics</a> on the frontend.</p>
    </article>

@stop