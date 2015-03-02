{{-- Include Header (Styles, Meta Tags and more) --}}
@include('layouts.partials._header')

<div class="container">

    <header class="page-header">
        <a href="#" id="mobile-nav">M</a>

        <a id="top-link" href="/">screeenly <span class="version-tag">v 1.0</span></a>
    </header>

    <aside class="sidebar">

        @include('layouts.partials._navigation')

    </aside>

    <section role="main" class="page-content">

        @include('layouts.partials._flash')

        @yield('content')

    </section>

</div>

{{-- include tail (scripts and end tags) --}}
@include('layouts..partials._tail')
