@extends ('layouts.landingpage')

    @section('body-class')body--landingpage @stop

    @section('content')

        <div class="container landingpage">

            <section role="main" class="hero app--content">

                <h1>screeenly</h1>
                <p>Create website screenshots through a simple API.</p>

                {{ link_to_route('oauth.github', 'Sign up with Github', null, ['class' => 'button']) }}

            </section>


            {{-- include footer  --}}
            @include('layouts.footer')

        </div>

        <div id="particles-js"></div>


    @stop
