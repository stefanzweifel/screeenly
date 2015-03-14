{!! Form::open(['route' => 'app.storeEmail']) !!}

    <input type="email" name="email" id="email" value="{!! Auth::user()->email; !!}" placeholder="email" required>
    @if ($errors->any())
        <small class="error">
           {{ $errors->first('email') }}
        </small><br>
    @endif

    <button class="button small">{{ $submitButtonText }}</button>

{!! Form::close() !!}