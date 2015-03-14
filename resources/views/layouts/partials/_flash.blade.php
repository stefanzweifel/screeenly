@if (Session::has('message'))

    <div id="flash-message" class="flash flash-{!! session('message_type') !!}">
        <p>{!! session('message') !!}</p>
    </div>

    <script>
        setTimeout(function(){
            var el = document.getElementById('flash-message');

            el.className += ' animated fadeOutUp';

            setTimeout(function(){

                el.parentNode.removeChild(el);
            }, 500);

        }, 3000);
    </script>

@endif