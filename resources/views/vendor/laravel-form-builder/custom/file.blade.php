@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif

@if ($showLabel && $options['label'] !== false)
    <div>{!! Form::label($name, $options['label'], $options['label_attr']) !!}</div>
@endif

@if ($showField)
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-preview download">
            @if (isset($options['value']['file']) && isset($options['value']['file']['url']))
                {{ trans('material-admin::forms.file.download') }}
                <a href="{{ $options['value']['file']['url'] }}" target="_blank">
                    {{ sprintf('%s.%s', $options['real_name'], pathinfo($options['value']['file']['url'], PATHINFO_EXTENSION)) }}
                </a>
                {{ sprintf(trans('material-admin::forms.file.size'), $options['value']['file']['size']) }}
            @endif
        </div>
        <div>
            <span class="btn btn-primary btn-file waves-effect">
                <span class="fileinput-new">{{ trans('material-admin::forms.file.select') }}</span>
                <span class="fileinput-exists">{{ trans('material-admin::forms.file.change') }}</span>
                {!! Form::input('file', $name, '', $options['attr']) !!}
            </span>
            <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">{{ trans('material-admin::forms.file.remove') }}</a>
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