@if ($showLabel && $options['label'] !== false)
    {!! Form::label($name, $options['label'], $options['label_attr']) !!}
@endif
@if ($showField)
    @if($options['value'])
        {{ Arr::get($options['choices'], $options['value']) }}
    @endif
    @include('laravel-form-builder::help_block')
@endif

@include('laravel-form-builder::errors')
