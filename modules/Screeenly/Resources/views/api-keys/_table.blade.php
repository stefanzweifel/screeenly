<div class="table-responsive">
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Secret</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($apiKeys as $key)
        <tr>
            <td>{{ $key->name }}</td>
            <td><code>{{ $key->key }}</code></td>
            <td>
                @include('screeenly::api-keys._destroy_form')
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>