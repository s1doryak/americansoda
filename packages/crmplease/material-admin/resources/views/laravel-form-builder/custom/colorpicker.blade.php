@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif
            @if ($showLabel && $options['label'] !== false)
                {!! Form::label($name, $options['label'], $options['label_attr']) !!}
            @endif
            @if ($showField)
                <div class="color-palette">
                    @if(!in_array($options['value'], array_values($options['palette'])))
                        <span style="background-color: {{ $options['value'] }}" title="{{ trans('colors.custom') }}">
                            {!! Form::radio($name, $options['value'], true, $options['attr']) !!}
                            <i></i>
                        </span>
                    @endif
                    @foreach($options['palette'] as $color => $hex)
                        <span class="bgm-{{ $color }}" title="{{ trans("colors.palette.{$color}") }}">
                            {!! Form::radio($name, $hex, $options['value'] === $hex) !!}
                            <i></i>
                        </span>
                    @endforeach
                </div>
                @include('laravel-form-builder::help_block')
            @endif
            @include('laravel-form-builder::errors')
            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif