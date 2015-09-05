@if (Session::has('message'))

    <div id="flash-message" class="bold center p2 white bg-green {!! session('message_type') !!}">
        {!! session('message') !!}
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

@if (Session::has('error'))

    <div class="bold center p2 white bg-black">
        {!! session('error') !!}
    </div>

@endif