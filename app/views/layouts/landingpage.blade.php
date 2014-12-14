{{-- Include Header (Styles, Meta Tags and more) --}}
@include('layouts.partials._header')

<!-- {{-- Navigation --}}
@include('layouts.navigation') -->

<div class="container landingpage">

    <section role="main" class="hero app--content">

        <h1>screeenly</h1>
        <p>Create fullsize website screenshots through a simple API.</p>

        {{ link_to_route('oauth.github', 'Sign in with Github', null, ['class' => 'button']) }}

    </section>

    {{-- include footer  --}}
    @include('layouts.footer')

</div>

{{-- include tail (scripts and end tags) --}}
@include('layouts..partials._tail')
