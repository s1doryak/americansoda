@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif

@if ($showLabel && $options['label'] !== false)
    <div>{!! Form::label($name, $options['label'], $options['label_attr']) !!}</div>
@endif

@if ($showField)
    @php($value = isset($options['value']['original']) ? $options['value']['original']['url'] : null)
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
            @if ($value)
                <img src="{{ $value }}" alt="">
            @endif
        </div>
        <div>
            <span class="btn btn-primary btn-file waves-effect">
                <span class="fileinput-new">{{ trans('material-admin::forms.image.select') }}</span>
                <span class="fileinput-exists">{{ trans('material-admin::forms.image.change') }}</span>
                {!! Form::input('file', $name, null, $options['attr']) !!}
            </span>
            <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">{{ trans('material-admin::forms.image.remove') }}</a>
        </div>

        @include('laravel-form-builder::help_block')
    </div>
@endif

@include('laravel-form-builder::errors')

@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif