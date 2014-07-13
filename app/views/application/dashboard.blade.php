@extends ('layouts.master')

    @section('meta_title')
        Dashboard
    @stop

    @section('page_title')Dashboard @stop

    @section('content')

        <div class="card">

            <p class="material--title">Hi there, thanks for using screeenly.</p>
            <p class="material--body-1">We are currently in an early alpha version, so bugs may apear. We're happy about every <a href="https://docs.google.com/forms/d/1rSfWcUrPCf2Ony3blKh6L3dOQiIanVKU0HZ0Org4eFs/viewform?usp=send_form">Feedback</a>.</p>

            <div class="message">Your API Key: <code>{{ $user->api_key }}</code></div>

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
