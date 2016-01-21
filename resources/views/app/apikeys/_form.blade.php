{!! Form::label('name', 'Name') !!}

<div class="clearfix">
    {!! Form::text('name', null, [
        'class' => 'col col-8 md-col-6 field rounded-left y-group-item mb2',
        'maxlength' => '100',
        'placeholder' => 'Give your API key a name.',
        'required'
    ]) !!}

    <button class="btn white rounded-right bg-green col col-4 md-col-2">{{ $buttonText }}</button>

</div>