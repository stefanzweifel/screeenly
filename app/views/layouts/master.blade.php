{{-- Include Header (Styles, Meta Tags and more) --}}
@include('layouts.header')

{{-- Include head with navigation and logo --}}
@include('layouts.head')

    <section id="main-content--wrapper" role="main">
        @yield('content')
    </section>

{{-- include footer  --}}
@include('layouts.footer')

{{-- include tail (scripts and end tags) --}}
@include('layouts.tail')
