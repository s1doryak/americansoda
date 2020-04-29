@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif

            @if ($showLabel && $options['label'] !== false)
                <div>{!! Form::label($name, $options['label'], $options['label_attr']) !!}</div>
            @endif

            @if ($showField)
                @if (isset($options['value']['original']['url']))
                    <a href="{{ $options['value']['original']['url'] }}" target="_blank">
                        <img class="img-rounded" src="{{ $options['value']['original']['url'] }}" alt="{{ $options['label'] }}" width="150">
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