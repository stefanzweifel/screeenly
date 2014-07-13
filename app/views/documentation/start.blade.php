@extends ('layouts.master')

    @section('meta_title')
        Documentation
    @stop

    @section('page_title')Documentation @stop

    @section('content')

        <div class="card">

            <h3 class="material--display-1">General Information</h3>
            <p class="material--body-1">Before you start, please be aware of the following rules</p>
            <ol>
                <li>You must have an API Key to create Screenshots</li>
                <li><strong>Your screenshots will be removed after 7 days (604'800 seconds) of their creation.</strong></li>
            </ol>
            <br>


            <h3 class="material--title">Simple Request</h3>
            <p class="material--body-1">For a simple request, just send a POST-Request to <code>http://screenly.com/api/v1/screen</code>. The API will then take a screenshot of the given URL in the dimensions 1024 x 768 px.</p>

            <pre>
{
    "key": "YOUR_API_KEY",
    "url": "http://en.wikipedia.org/"
}</pre>

            <p class="material--body-2">Return value</p>
            <pre>{
    "filename": "http://screeenly.com/images/generated/53c14c7e1d76dF9LuQB9upf2jtjpn0dOm.jpg"
}</pre>

            <h3 class="material--title">Advanced Request with dimensions</h3>
            <p class="material--body-1">You can also specify your own dimensions. Just add a <code>width</code> and <code>height</code> parameter to your request.</p>

            <pre>
{
    "key": "YOUR_API_KEY",
    "url": "http://en.wikipedia.org/",
    "width": 2000,
    "height": 1000
}</pre>

            <p class="material--body-2">Return value</p>
            <pre>{
    "filename": "http://screeenly.com/images/generated/53c14c7e1d76dF9LuQB9upf2jtjpn0dOm.jpg"
}</pre>

            <!-- Shadow -->
            <div class="paper-shadow paper-shadow-bottom-z-1"></div>
            <div class="paper-shadow paper-shadow-top-z-1"></div>
        </div>

    @stop
