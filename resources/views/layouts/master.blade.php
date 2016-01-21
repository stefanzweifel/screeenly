@include('layouts.partials._header')

<div class="flex flex-column" style="min-height: 100vh;">

    @include('partials._navigation')
    @include('partials._messages')

    <main class="flex-auto screeenly">

        <div class="container">
            @yield('content')
        </div>

    </main>


    @include('partials._footer')

</div>

@include('layouts.partials._tail')