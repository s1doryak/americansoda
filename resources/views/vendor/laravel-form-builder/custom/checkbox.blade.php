@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif

            @if ($showField)
                @php($disabled = isset($options['attr']['disabled']) ? 'disabled' : '')
                @php($color = isset($options['ts-color']) ? $options['ts-color'] : 'green')
                <div class="toggle-switch {{ $disabled }}" data-ts-color="{{ $color }}">
                    {!! Form::checkbox($name, true, $options['checked'] || $options['value'] === true, $options['attr']) !!}
                    <label for="{{ $name }}" class="ts-helper"></label>
                    @if ($showLabel && $options['label'] !== false)
                        <label for="{{ $name }}" class="ts-label">{!! $options['label'] !!}</label>
                    @endif
                    @include('laravel-form-builder::help_block')
                </div>

                @include('laravel-form-builder::errors')
            @endif

            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif
