@extends ('layouts.landingpage')

    @section('body-class')body--landingpage @stop

    @section('content')

        <div class="layer layer--primary">
            <div class="container">
                <h1 class="site-logo text-center"><img src="{{ URL::asset('assets/images/site-logo.png') }}" alt="screeenly Logo"></h1>
                <p class="material--display-1 text-center animated fadeIn">Dead simple screenshot grabbing API</p>

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
                        <img src="{{ URL::asset('assets/images/landing-api.png') }}" alt="How to use the API">
                    </div>
                    <div class="col--6">
                        <h3>Check it out. It's free.</h3>
                        <p>We are tired of all those apps, where you have to pay a monthly fee.</p>
                        <br>
                        <p>Screeenly is also <a href="https://github.com/stefanzweifel/screeenly">Open Source</a>.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="layer layer--white">
            <div class="container animated fadeInUp">
                <div class="row">
                    <div class="col--6">
                        <h3>Simple to use.</h3>
                        <p>You just have to remember one single API rule. If you still have trouble, check out the {{ link_to_route('front.documentation', 'Docs') }}.</p>
                    </div>
                    <div class="col--6">
                        <img src="{{ URL::asset('assets/images/landing-dashboard.png') }}" alt="How to use the API">
                    </div>
                </div>
            </div>
        </div>

    @stop