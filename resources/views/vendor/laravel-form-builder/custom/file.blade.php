@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif

            @if ($showLabel && $options['label'] !== false)
                <div>{!! Form::label($name, $options['label'], $options['label_attr']) !!}</div>
            @endif

            @if ($showField)
                @if (isset($options['value']['file']['url']))
                    <a href="{{ $options['value']['file']['url'] }}" target="_blank">
                        {{ sprintf('%s.%s', $options['real_name'], pathinfo($options['value']['file']['url'], PATHINFO_EXTENSION)) }}
                    </a>
                @endif
                {!! Form::input('file', $name, null, $options['attr']) !!}
                @include('laravel-form-builder::help_block')
            @endif

            @include('laravel-form-builder::errors')

            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif