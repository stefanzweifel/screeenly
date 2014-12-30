@extends ('layouts.master')

    @section('meta_title') Documentation @stop

    @section('content')

    <h3>General Information</h3>
    <p>Before you start, please be aware of the following rules</p>
    <ol>
        <li>You must have an API Key to create Screenshots</li>
        <li><strong>Your screenshots will be removed after 12 hours of their creation.</strong></li>
    </ol>

    <h3>Do API Request</h3>
    <p>For a simple request, just send a POST-Request to <code>http://screeenly.com/api/v1/fullsize</code>. The API will then take a screenshot of the given URL width a with of 1024 pixels. The height of the screenshot is 100%.</p>
    <p><a href="https://gist.github.com/stefanzweifel/968e68785277013ac214">Simple PHP CURL Example</a>.</p>

<pre>
{
    "key": "YOUR_API_KEY",
    "url": "http://en.wikipedia.org/"
}</pre>

<p>Return Value</p>
            <pre>{
    "path":     "http://screeenly.com/images/generated/FILENAME.jpg",
    "base64":   "ENCODED_FILE"
}</pre>

    @stop