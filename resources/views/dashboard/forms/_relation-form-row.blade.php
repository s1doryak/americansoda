@php($is_template = isset($is_template) && $is_template === true)
@php($multiple_rows = isset($multiple_rows) && $multiple_rows === true)
<tr class="js-row">
    @foreach($fields as $field)
        @php($type = $field->getType())
        @php($name = $field->getRealName())
        @if ($type === 'hidden')
            @continue
        @endif

        @if (in_array($name, $exclude))
            @continue
        @endif

        @if($multiple_rows && $is_template === false)
            @if(preg_match('/\[(%%idx%%|idx|\d*)]/', $field->getName()))
                @php($field->setName(preg_replace('/\[(%%idx%%|idx|\d*)]/', "[{$idx}]", $field->getName())))
            @else
                @php($field->setName(sprintf("%s[%d]", $field->getName(), $idx)))
            @endif
        @endif

        <td class="td-{{ $name }} td-{{ $type }}">
            @php($containerClass = 'form-group')
            @if ($errors->has($field->getNameKey()))
                @php($containerClass .= ' has-error')
            @endif
            <div class="{{ $containerClass }}">
                @php($attrs = [])
                @if ($type !== 'static')
                    @php($attrs = ['attr' => ['class' => 'form-control fc-alt']])
                @endif

                @if(isset($item))
                    @if(is_object($item))
                        @if(is_object($item->{$name}))
                            @php($value = $item->{$name}->getKey())
                        @else
                            @php($value = $item->{$name})
                        @endif
                    @else
                        @php($value = array_get($item, $name))
                    @endif
                @else
                    @php($value = '')
                @endif

                @if($can_edit)
                    @if(in_array($type, ['select', 'choice']))
                        @if ($can_select)
                            @php($field->enable())
                        @else
                            @php($field->disable())
                            @php($field->setOption('attr.disabled', 'disabled'))
                            {!! Form::hidden($field->getName(), $value) !!}
                        @endif
                    @endif
                @else
                    @if(in_array($type, ['select', 'choice']))
                        @if ($can_select)
                            @php($field->enable())
                        @else
                            @php($field->disable())
                            @php($field->setOption('attr.disabled', 'disabled'))
                            {!! Form::hidden($field->getName(), $value) !!}
                        @endif
                    @else
                        @php($field->disable())
                        {!! Form::hidden($field->getName(), $value) !!}
                    @endif
                @endif

                @if (isset($item) && $is_template === false)
                    @php($key = in_array($type, ['select', 'choice']) ? 'selected' : 'value')
                    @php($attrs[$key] = $value)
                @endif

                {!! $field->render($attrs, false, true, false) !!}
            </div>
        </td>
    @endforeach
    @if(!isset($actions) || $actions)
        <td class="td-actions">
            @include('dashboard::forms.buttons.remove')

            @foreach($fields as $field)
                @php($name = $field->getRealName())
                @if ($field->getOption('type') === 'hidden' && !in_array($name, $exclude))
                    @if(isset($multiple_rows) && $multiple_rows === true)
                        @php($field->setName(preg_replace('/\[(%%idx%%|idx|\d*)]/', "[{$idx}]", $field->getName())))
                    @endif

                    @php($attrs = [])
                    @if (isset($item))
                        @if(is_object($item))
                            @if(is_object($item->{$name}))
                                @php($value = $item->{$name}->getKey())
                            @else
                                @php($value = $item->{$name})
                            @endif
                        @else
                            @php($value = array_get($item, $name))
                        @endif
                        @php($attrs['value'] = $value)
                    @endif

                    {!! $field->render($attrs) !!}
                @endif
            @endforeach
        </td>
        <td class="td-removed hidden js-td-removed" colspan="{{ count($fields) - 1 }}">
            @lang('forms.labels.removed').
            <a class="js-undo-link" href="#">@lang('forms.buttons.undo')</a>
        </td>
    @endif
</tr>
