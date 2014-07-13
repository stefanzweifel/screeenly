@extends ('layouts.landingpage')


    @section('content')

        <div class="layer layer--primary">
            <div class="container">
                <h1 class="site-logo text-center"><img src="/images/site-logo.png" alt="screeenly Logo"></h1>
                <p class="material--display-1 text-center animated fadeIn">Dead simple screenshot grapping API</p>

            @if(!Auth::check())
                <div class="row text-center">
                    {{ link_to_route('oauth.github', 'Login with Github', null, ['class' => 'button--raised']) }}
                </div>
            @endif


            </div>
        </div>

        <div class="layer layer--dark">
            <div class="container animated fadeInUp">
                <div class="row">
                    <div class="col--6">
                        <img src="#" alt="BIld">
                    </div>
                    <div class="col--6">
                        <h3>Check it out. It's free</h3>
                        <p>screeenly is free!</p>
                        <p>We are tired of all those apps, where you have to pay a monthly fee.</p>
                        <br>
                        <p>Screeenly is also Open Source.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="layer layer--white">
            <div class="container animated fadeInUp">
                <div class="row">
                    <div class="col--6">
                        <h3>Simple. Fast.</h3>
                        <p>It's so simple to use. And it's also really fast. If you still have trouble, check out the {{ link_to_route('home.landingpage', 'Docs') }}.</p>
                    </div>
                    <div class="col--6">
                        <img src="#" alt="Picture">
                    </div>
                </div>
            </div>
        </div>

    @stop