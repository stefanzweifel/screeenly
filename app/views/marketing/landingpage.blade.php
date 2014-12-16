@extends ('layouts.landingpage')

    @section('body-class')body--landingpage @stop

    @section('content')

        <section role="main" class="hero app--content">

            <h1>screeenly</h1>
            <p>Create fullsize website screenshots through a simple API.</p>

            {{ link_to_route('oauth.github', 'Sign in with Github', null, ['class' => 'button']) }}

        </section>

    @stop