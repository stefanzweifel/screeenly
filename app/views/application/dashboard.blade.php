@extends ('layouts.master')

    @section('meta_title')
        Screenly
    @stop

    @section('page_title')Dashboard @stop

    @section('content')

        <div class="card">

            <p class="material--title">Hi there, thanks for using Screenly.</p>
            <p class="material--body-1">We are currently in an early alpha version and we will improve the overall app over the upcoming weeks. We are currently working on the overall design and documention of the app. If you find any bugs or just want to give us feedback, please let us know via <a href="mailto:hello@wnx.ch">email</a> or via <a href="http//twitter.com/_stefanzweifel">Twitter</a>.</p>

            <p class="material--body-2">Your personal API Key is <code>{{ $user->api_key }}</code>. Just create a POST-Request to <strong>http://screenshot.app:8000/api/v1/screen</strong> with the parameters <strong>key</strong> (your API key) and <strong>url</strong>.</p>

            <!-- Shadow -->
            <div class="paper-shadow paper-shadow-bottom-z-1"></div>
            <div class="paper-shadow paper-shadow-top-z-1"></div>
        </div>

        @if($logs)

            @foreach ($logs as $key => $log)

            @if($key%2 == 0)
                <div class="row">
            @endif

            <div class="col--6">

                <div class="card" id="card-{{ $key }}">
                    <div class="card-inner">

                        <a href="{{ asset(Config::get('api.storage_path').$log->images); }}" class="material__button" target="blank">
                            <img src="{{ asset(Config::get('api.storage_path').$log->images); }}" alt="Screenshot from Page">
                        </a>

                        <section>

                            <h3 class="material--title">{{ $log->images }}</h3>

                            <h6 class="material--subheader">Timestamp</h6>
                            <p>{{ $log->created_at }}</p>

                            <a href="{{ asset(Config::get('api.storage_path').$log->images); }}" class="material--button" target="blank">Open Image</a>

                        </section>

                    </div>

                    <!-- Shadow -->
                    <div class="paper-shadow paper-shadow-bottom-z-1"></div>
                    <div class="paper-shadow paper-shadow-top-z-1"></div>
                </div>


            </div>

            @if($key%2 == 1)
                </div>
            @endif

            @endforeach

        @endif

    @stop
