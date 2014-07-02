@extends ('layouts.master')

    @section('meta_title')
        Screenly
    @stop

    @section('page_title')Dashboard @stop

    @section('content')

        <div class="card">
            <p>Your API Key: <code>{{ $user->api_key }}</code> </p>
        </div>

        @if($logs)

            @foreach ($logs as $key => $log)

                <div class="card animated- fadeIn" id="card-{{ $key }}">

                    <img src="{{ asset(Config::get('api.storage_path').$log->images); }}" alt="Screenshot from Page">

                    <section>

                        <h3 class="material__title">{{ $log->images }}</h3>

                        <h6 class="material__subheader">Timestamp</h6>
                        <p>{{ $log->created_at }}</p>

                        <h6>IP</h6>
                        <p>999.999.999.999</p>

                        <a href="{{ asset(Config::get('api.storage_path').$log->images); }}" class="material__button" target="blank">Open Image</a>
                    </section>


                </div>

            @endforeach

        @endif

    @stop
