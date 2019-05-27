<tr>
    <td colspan="3">
        <h4>
            {{ ucfirst($group->name) }}
            @if($can_add)
                @include('dashboard::partials.forms.buttons.add')
            @endif
        </h4>
    </td>
</tr>
<tr>
    @foreach($fields as $field)
        @set($type = $field->getType())
        @if ($type !== 'hidden' && !in_array($field->getRealName(), $exclude))
            @set($th = 'th-' . $field->getRealName() . ' th-' . $type)
            <th class="{{ $th }}">{{ $field->getOption('label') }}</th>
        @endif
    @endforeach
    <th>{{ trans('forms.labels.actions') }}</th>
</tr>