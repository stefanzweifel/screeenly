@include('layouts.partials._header')

<div class="flex flex-column" style="min-height: 100vh;">

    @include('partials._messages')

    <main class="flex-auto">

        @yield('content')

    </main>


    @include('partials._footer')

</div>

@include('layouts.partials._tail')