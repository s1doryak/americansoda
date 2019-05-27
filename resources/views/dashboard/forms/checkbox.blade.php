@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif

@if ($showField)
    @php($disabled = isset($options['attr']['disabled']) ? 'disabled' : '')
    <div class="toggle-switch {{ $disabled }}" data-ts-color="{{ isset($options['ts-color']) ? $options['ts-color'] : 'green' }}">
        @if ($showLabel && $options['label'] !== false)
            <label for="{{ $name }}" class="ts-label">{!! $options['label'] !!}</label>
        @endif

        {!! Form::checkbox($name, $options['value'], $options['checked'] || $options['value'] == 1, $options['attr']) !!}
        <label for="{{ $name }}" class="ts-helper"></label>

        @include('laravel-form-builder::errors')
    </div>

    @include('laravel-form-builder::help_block')
@endif

@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif