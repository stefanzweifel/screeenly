<form method="post" action="/apikeys">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="name">Name for your new API Key</label>
        <input type="text" id="name" name="name" required class="form-control" placeholder="Give your new API Key a name">
    </div>
    @if ($errors->has('name'))
        <span class="help-block">
            @foreach($errors->get('name') as $message)
            {{ $message}}
            @endforeach
        </span>
    @endif

    <button type="submit" class="btn btn-success">Create API Key</button>

</form>