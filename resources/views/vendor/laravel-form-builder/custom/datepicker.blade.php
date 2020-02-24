@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif
            @php($options['attr']['class'] .= ' datepicker')
            @if ($showLabel && $options['label'] !== false)
                {!! Form::label($name, $options['label'], $options['label_attr']) !!}
            @endif
            @if ($showField)
                {!! Form::text($name, $options['value'], $options['attr']) !!}
                @include('laravel-form-builder::help_block')
            @endif
            @include('laravel-form-builder::errors')
            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif