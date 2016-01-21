<div class="overflow-scroll">

    <table class="table-light overflow-hidden bg-white border rounded mt2">
        <thead class="bg-darken-1 bold">
            <tr>
                <td width="90">Name</td>
                <td>Key</td>
                <td>Created</td>
                <td width="150">&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @foreach($apikeys as $key)
            <tr>
                <td>{{ $key->name }}</td>
                <td>
                    <code class="inline-block px1 white bg-navy rounded">{{ $key->key }}</code>
                </td>
                <td>{{ $key->created_at->format('d.m.Y H:i:s') }}</td>
                <td>
                    {!! link_to_route('apikeys.edit', 'Edit', [$key->id], ['class' => 'btn btn-primary rounded']) !!}
                    {!! Form::open(['route' => ['apikeys.destroy', $key->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) !!}
                        <button class="btn bg-red white rounded">Delete</button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>