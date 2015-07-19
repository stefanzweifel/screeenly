@extends ('layouts.master')

@section('meta_title')
    Terms of Service & FAQ
@stop

@section('content')

    <div class="col md-col-8">

    <h1>Terms of Service</h1>

    <article>
        <h2>I have a problem. How can I reach you?</h2>
        <p>You can always send us an Email (hello[at]screeenly.com) , a <a href="http://twitter.com/screeenly">Tweet</a> or leave your Feedback <a href="//docs.google.com/forms/d/1rSfWcUrPCf2Ony3blKh6L3dOQiIanVKU0HZ0Org4eFs/viewform?usp=send_form">here</a>.</p>

        <p>Due to the fact that this is just a sideproject we can't guarantee and answer in the next 5 minutes. But we try to answer questions as fast a possible.</p>
    </article>

    <article>
        <h2>Is this service free?</h2>
        <p>Yes. Screeenly is free for everyone, but Screeenlys user base is growing rapitly and creating screenshots is needs power. If we would run into massive server issues, we might have to find a solution to monetize the service. But till then, the service is free.</p>
    </article>

    <article>
        <h2>What about the screenshots?</h2>
        <p>All screenshots you create with our API have a lifetime of <strong>1 hour! (Screeenly does not host your images)</strong> After 1 hour the file will be deleted from our server.</p>

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
            <li>Developer? Improve the codebase or write some better test.</li>
            <li>Designer? Create a new logo or a better suitable design</li>
            <li>Writer? Improve the copy on the site</li>
        </ul>
        </p>
    </article>

    <article>
        <h2>Good to know</h2>

        <ul>
            <li>Screeenly is built with <a href="http://laravel.com">Laravel</a>. The PHP Framework for artisans</li>
            <li>We used <a href="http://www.basscss.com/">BASSCSS</a>, a low level CSS toolkit for our frontend</li>
            <li><a href="//google.com/analytics">Google Analytics</a> is used.</li>
        </ul>
    </article>


    </div>

@stop