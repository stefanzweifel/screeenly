<h1>Dashboard</h1>

<p>This is your dashboard. Here you see, how many calls you have made with your API Key</p>


<p>Your API Key is <code>{{ $user->api_key }}</code> </p>


<p>{{ link_to_route('oauth.logout', 'Logout') }}</p>


<hr>


@if($logs)

    <ul>
    @foreach ($logs as $key => $log)

        <li>
            <a href="{{ asset(Config::get('api.storage_path').$log->images); }}" target="blank">{{ $log->images }}</a>
        </li>

    @endforeach
    </ul>


@else


@endif