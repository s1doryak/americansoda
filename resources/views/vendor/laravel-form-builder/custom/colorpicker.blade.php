@if ($showLabel && $showField)
@if ($options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs'] !!}>
@endif
@endif
        @if ($showLabel && $options['label'] !== false)
            {!! Form::label($name, $options['label'], $options['label_attr']) !!}
        @endif
        <div class="cp-container">
            <div class="input-group form-group">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-invert-colors"></i>
                </span>
                <div class="fg-line dropdown">
                    @if ($showField)
                        @php($options['attr']['class'] .= ' cp-value')
                        @php($options['attr']['data-toggle'] = 'dropdown')
                        {!! Form::text(
                            $name,
                            $options['value'] ?: config('laravel-form-builder.defaults.color_picker.color'),
                            $options['attr']
                        ) !!}

                        <i data-toggle="dropdown" class="cp-value"></i>

                        <div class="dropdown-menu">
                            <div class="color-picker" data-cp-default="{{ config('laravel-form-builder.defaults.color_picker.color') }}"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @include('laravel-form-builder::help_block')
        @include('laravel-form-builder::errors')
@if ($showLabel && $showField)
@if ($options['wrapper'] !== false)
    </div>
@endif
@endif