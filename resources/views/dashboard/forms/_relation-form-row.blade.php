@set($is_template = isset($is_template) && $is_template === true)
@set($multiple_rows = isset($multiple_rows) && $multiple_rows === true)
<tr class="js-row">
    @foreach($fields as $field)
        @set($type = $field->getType())
        @set($name = $field->getRealName())
        @if ($type === 'hidden')
            @continue
        @endif

        @if (in_array($name, $exclude))
            @continue
        @endif

        @if($multiple_rows && !$is_template)
            @set($field->setName(preg_replace('/(\d+)/', "{$index}", $field->getName())))
        @endif

        <td class="td-{{ $name }} td-{{ $type }}">
            @set($containerClass = 'form-group')
            @if ($errors->has($field->getNameKey()))
                @set($containerClass .= ' has-error')
            @endif
            <div class="{{ $containerClass }}">
                @set($attrs = [])
                @if ($type !== 'static')
                    @set($attrs = ['attr' => ['class' => 'form-control fc-alt']])
                @endif

                @if(isset($item))
                    @if(is_object($item))
                        @if(is_object($item->{$name}))
                            @set($value = $item->{$name}->getKey())
                        @else
                            @set($value = $item->{$name})
                        @endif
                    @else
                        @set($value = array_get($item, $name))
                    @endif
                @else
                    @set($value = '')
                @endif

                @if($can_edit)
                    @if(in_array($type, ['select', 'choice']))
                        @if ($can_select)
                            @set($field->enable())
                        @else
                            @set($field->disable())
                            @set($field->setOption('attr.disabled', 'disabled'))
                            {!! Form::hidden($field->getName(), $value) !!}
                        @endif
                    @else
                        @set($field->enable())
                    @endif
                @else
                    @if(in_array($type, ['select', 'choice']))
                        @if ($can_select)
                            @set($field->enable())
                        @else
                            @set($field->disable())
                            @set($field->setOption('attr.disabled', 'disabled'))
                            {!! Form::hidden($field->getName(), $value) !!}
                        @endif
                    @else
                        @set($field->disable())
                        {!! Form::hidden($field->getName(), $value) !!}
                    @endif
                @endif

                @if (isset($item) && $is_template === false)
                    @set($key = in_array($type, ['select', 'choice']) ? 'selected' : 'value')
                    @set($attrs[$key] = $value)
                @else
                    @set($attrs['value'] = '')
                @endif

                {!! $field->render($attrs, false, true, false) !!}
            </div>
        </td>
    @endforeach
    @if(!isset($actions) || $actions)
        <td class="td-actions">
            @include('dashboard::partials.forms.buttons.remove')

            @foreach($fields as $field)
                @set($name = $field->getRealName())
                @if ($field->getOption('type') === 'hidden' && !in_array($name, $exclude))
                    @if(isset($multiple_rows) && $multiple_rows === true)
                        @set($field->setName(preg_replace('/(\d+)/', "{$index}", $field->getName())))
                    @endif

                    @set($attrs = [])
                    @if (isset($item))
                        @if(is_object($item))
                            @if(is_object($item->{$name}))
                                @set($value = $item->{$name}->getKey())
                            @else
                                @set($value = $item->{$name})
                            @endif
                        @else
                            @set($value = array_get($item, $name))
                        @endif
                        @set($attrs['value'] = $value)
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