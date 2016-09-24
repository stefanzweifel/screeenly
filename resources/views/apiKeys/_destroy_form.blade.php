<form method="post" action="/apikeys/{{ $key->id }}">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" id="apiKey--{{ $key->id }}" class="btn btn-danger">Delete</button>

</form>