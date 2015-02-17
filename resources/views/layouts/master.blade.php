{{-- Include Header (Styles, Meta Tags and more) --}}
@include('layouts.partials._header')

{{-- Navigation --}}
@include('layouts.navigation')

<div class="container">

    <section role="main" class="app--content">
        @yield('content')
    </section>

    {{-- include footer  --}}
    @include('layouts.footer')

</div>

{{-- include tail (scripts and end tags) --}}
@include('layouts..partials._tail')
