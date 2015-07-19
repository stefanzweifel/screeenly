{!! Form::model(auth()->user(), ['route' => 'app.storeEmail']) !!}


    <div class="clearfix">
        {!! Form::email('email', null, [
            'class' => 'block col-12 field rounded-bottom y-group-item',
            'placeholder' => 'john@appleseed.com',
            'required'
        ]) !!}

        @if ($errors->any())
            <small class="error red">
               {{ $errors->first('email') }}
            </small><br>
        @endif

        <button class="btn btn-primary rounde mt2">{{ $submitButtonText }}</button>

    </div>

{!! Form::close() !!}