{{-- Include Header (Styles, Meta Tags and more) --}}
@include('layouts.partials._header')



<div class="container landingpage">

    @yield('content')

    {{-- include footer  --}}
    @include('layouts.footer')

</div>

<div id="particles-js"></div>

{{-- include tail (scripts and end tags) --}}
@include('layouts..partials._tail')
