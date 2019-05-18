@if ($showLabel && $showField)
@if ($options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs'] !!}>
@endif
@endif
        <div class="datetimepicker-container">
            @if ($showLabel && $options['label'] !== false)
                {!! Form::label($name, $options['label'], $options['label_attr']) !!}
            @endif

            @if ($showField)
                @php($options['attr']['class'] .= ' date-picker')
                {!! Form::text(
                    $name,
                    $options['value'],
                    $options['attr']
                ) !!}
            @endif
        </div>
        @include('laravel-form-builder::help_block')
        @include('laravel-form-builder::errors')
@if ($showLabel && $showField)
@if ($options['wrapper'] !== false)
    </div>
@endif
@endif