<ul class="attributes-list">
    @foreach ($customer->getChangedAttributes() as $attribute => $value)
    <li class="attributes-list-item">
        <span class="attribute-text">
            @if($attribute !== 'comment')
                @php($label = trans(sprintf('models/customer.fields.%s', $attribute)))
                @if (is_array($label))
                    <strong>{{ $label['name'] }}:</strong>
                @else
                    <strong>{{ $label }}:</strong>
                @endif
            @endif
            @if (empty($value))
                <em>@lang('forms.labels.empty_value')</em>
            @else
                @if (is_array($value))
                    {!! strip_tags($value['name'],'<p><b><i><ul><ol><li>'); !!}
                @else
                    {!! strip_tags($value,'<p><b><i><ul><ol><li>'); !!}
                @endif
            @endif
        </span>
    </li>
    @endforeach
</ul>
