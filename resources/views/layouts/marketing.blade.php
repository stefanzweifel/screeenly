@include('layouts._head')
<body>
    @include('layouts._navigation')
    @include('layouts._messages')

    @yield('content')

    @include('layouts._footer')

@include('layouts._tail')
