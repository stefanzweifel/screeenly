{{-- Include Header (Styles, Meta Tags and more) --}}
@include('layouts.header')

{{-- Include head with navigation and logo --}}
<header>
    @include('layouts.head')
</header>


    <main role="main">
        @yield('content')
    </main>

{{-- include footer  --}}
@include('layouts.footer')

{{-- include tail (scripts and end tags) --}}
@include('layouts.tail')
