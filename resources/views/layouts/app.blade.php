@include('layouts._head')
<body>
    @include('layouts._navigation')

    <div class="container" style="margin-top: 2em;">
        @include('layouts._messages')
        @yield('content')
    </div>

    @include('layouts._footer')

@include('layouts._tail')
