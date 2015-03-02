@if (Session::has('message'))

    <div id="flash-message" class="flash flash-{!! session('message_type') !!}">
        <p>{!! session('message') !!}</p>
    </div>

    <script>
        setTimeout(function(){
            document.getElementById('flash-message').className += ' hide-me';
        }, 3000);
    </script>

@endif