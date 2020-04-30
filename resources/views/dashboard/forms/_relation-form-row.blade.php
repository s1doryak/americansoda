@php($is_template = $is_template ?? false)
@php($multiple_rows = $multiple_rows ?? false)
<tr class="js-row">
    @foreach($fields as $field)
        @php($type = $field->getType())
        @php($name = $field->getRealName())
        @php($value = $field->getValue())

        @if ($type === 'hidden')
            @continue
        @endif

        @if (in_array($name, $exclude))
            @continue
        @endif

        @if($multiple_rows && $is_template === false)
            @if(preg_match('/\[(%%idx%%|idx|\d+)]/', $field->getName()))
                @php($field->setName(preg_replace('/\[(%%idx%%|idx|\d+)]/', "[{$idx}]", $field->getName())))
            @else
                @php($field->setName(sprintf("%s[{$idx}]", $field->getName())))
            @endif
        @endif

        <td class="td-{{ $name }} td-{{ $type }}">
            @php($containerClass = 'form-group')
            @if ($errors->has($field->getNameKey()))
                @php($containerClass .= ' has-error')
            @endif
            <div class="{{ $containerClass }}">

                @if(isset($item))
                    @if(is_object($item))
                        @if($item->{$name} instanceof \Illuminate\Database\Eloquent\Model)
                            @php($value = $item->{$name}->getKey())
                        @elseif($item->{$name} instanceof \Illuminate\Contracts\Support\Arrayable)
                            @php($value = $item->{$name}->toArray())
                        @else
                            @php($value = $item->{$name})
                        @endif
                    @else
                        @php($value = Arr::get($item, $name))
                    @endif
                @endif

                @if(in_array($type, ['select', 'choice']))
                    @if ($can_select)
                        @php($field->enable())
                    @else
                        @php($field->disable())
                        @php($field->setOption('attr.disabled', 'disabled'))
                        {!! Form::hidden($field->getName(), $value) !!}
                    @endif
                @else
                        @if ($can_edit)
                            @php($field->enable())
                        @else
                            @php($field->disable())
                            @php($field->setOption('attr.disabled', 'disabled'))
                            {!! Form::hidden($field->getName(), $value) !!}
                        @endif
                @endif

                @php($field->setOption('parent_name', $field->getName()))
                @if(in_array($type, ['select', 'choice']))
                    @php($field->setOption('selected', $value))
                @else
                    @php($field->setValue($value))
                @endif

                {!! $field->render([], false, true, false) !!}
            </div>
        </td>
    @endforeach
    @if($actions ?? true)
        <td class="td-actions">
            @include('dashboard::forms.buttons.remove')

            @foreach($fields as $field)
                @php($type = $field->getType())
                @php($name = $field->getRealName())
                @php($value = $field->getValue())

                @if ($type === 'hidden' && !in_array($name, $exclude))

                    @if($multiple_rows && $is_template === false)
                        @if(preg_match('/\[(%%idx%%|idx|\d+)]/', $field->getName()))
                            @php($field->setName(preg_replace('/\[(%%idx%%|idx|\d+)]/', "[{$idx}]", $field->getName())))
                        @else
                            @php($field->setName(sprintf("%s[{$idx}]", $field->getName())))
                        @endif
                    @endif

                    @if (isset($item))
                        @if(is_object($item))
                            @if($item->{$name} instanceof \Illuminate\Database\Eloquent\Model)
                                @php($value = $item->{$name}->getKey())
                            @elseif($item->{$name} instanceof \Illuminate\Contracts\Support\Arrayable)
                                @php($value = $item->{$name}->toArray())
                            @else
                                @php($value = $item->{$name})
                            @endif
                        @else
                            @php($value = Arr::get($item, $name))
                        @endif
                    @endif

                    @php($field->setOption('parent_name', $field->getName()))
                    @php($field->setValue($value))

                    {!! $field->render(['value' => $value], false, true, false) !!}
                @endif
            @endforeach
        </td>
        <td class="td-removed hidden js-td-removed" colspan="{{ count($fields) - 1 }}">
            @lang('forms.labels.removed').
            <a class="js-undo-link" href="#">@lang('forms.buttons.undo')</a>
        </td>
    @endif
</tr>
