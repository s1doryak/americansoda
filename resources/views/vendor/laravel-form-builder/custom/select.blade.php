@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif
            @if ($showLabel && $options['label'] !== false)
                {!! Form::label($name, $options['label'], $options['label_attr']) !!}
            @endif

            @if ($showField)
                {!! Form::select($name, $options['choices'], $options['selected'], $options['attr'], $options['options'] ?? []) !!}

                @include('laravel-form-builder::help_block')
            @endif

            @include('laravel-form-builder::errors')
            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif
