@php
    if (is_null($item->picked)) {
        $color = 'none';
    } elseif ($item->picked === 0) {
        $color = 'rgb(244, 67, 54, 0.5)'; // #f44336;
    } elseif ($item->picked === 100) {
        $color = 'rgb(76, 175, 80, 0.5)'; // #4caf50
    } else {
        $color = 'rgb(255, 235, 59, 0.5)'; // #ffeb3b
    }
@endphp
@php($is_template = $is_template ?? false)

<tr class="js-row" style="background-color: {{ $color }}">
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

        @if($is_template === false)
            @if(preg_match('/\[(%%idx%%|idx|\d+)]/', $field->getName()))
                @php($field->setName(preg_replace('/\[(%%idx%%|idx|\d+)]/', "[{$idx}]", $field->getName())))
            @else
                @php($field->setName(sprintf("%s[{$idx}]", $field->getName())))
            @endif
        @endif

        <td class="td-{{ $name }} td-{{ $type }}" style="border: none">
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

                {!! $field->render(['attr' => ['style' => 'background: transparent; border: none;']], false, true, false) !!}

                @if($name == 'product_code'
                    && $item->updated_at->diffInMinutes(now()) <= 60)
                        <div class="badge-circle s-small bgm-green" data-toggle="tooltip" data-placement="right"
                             title="{{ trans('material-admin::datatables.badges.recently_updated') }}"></div>
                @endif
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

                    @if($is_template === false)
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
