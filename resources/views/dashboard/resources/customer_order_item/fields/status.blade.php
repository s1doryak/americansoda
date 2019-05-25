@if ($showLabel && $options['label'] !== false)
    {!! Form::label($name, $options['label'], $options['label_attr']) !!}
@endif
@if ($showField)
    @if($options['value'])
        <span class="status-{{ $options['value'] }}">{!! trans(sprintf('models/customer_order.statuses.%s', $options['value'])) !!}</span>
    @endif
    @include('laravel-form-builder::help_block')
@endif

@include('laravel-form-builder::errors')