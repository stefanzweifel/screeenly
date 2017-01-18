@if(session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
