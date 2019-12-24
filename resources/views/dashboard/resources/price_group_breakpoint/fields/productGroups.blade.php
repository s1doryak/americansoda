@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif
            @if ($showLabel && $options['label'] !== false)
                {!! Form::label($name, $options['label'], $options['label_attr']) !!}
            @endif
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    @foreach($options['groups'] as $group)
                        <tr>
                            <td>
                                @php($name = sprintf('priceGroupBreakpoints[idx][productGroups][%s][id]', optional($group)->id))
                                @php($value = optional($group)->id)
                                {!! Form::hidden($name, old($name, $value)) !!}

                                @php($name = sprintf('priceGroupBreakpoints[idx][productGroups][%s][name]', optional($group)->id))
                                @php($value = optional($group)->name)
                                {!! Form::input('text', $name, old($name, $value), ['class' => 'form-control', 'disabled' => true]) !!}
                            </td>
                            <td>
                                @php($name = sprintf('priceGroupBreakpoints[idx][productGroups][%s][price]', optional($group)->id))
                                @php($value = optional($group)->price)
                                {!! Form::input('text', $name, old($name, $value), ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('laravel-form-builder::help_block')
            @include('laravel-form-builder::errors')
            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif
