<ul class="attributes-list">
    @foreach ($customer->getChangedAttributes() as $attribute => $value)
    <li class="attributes-list-item">
        <span class="attribute-text">
            @if($attribute != 'comment')
                <strong>{{ trans(sprintf('models/customer.fields.%s', $attribute)) }}:</strong>
            @endif
            @if (empty($value))
                <em>@lang('forms.labels.empty_value')</em>
            @else
                @if (is_array($value))
                    {!! $value['name'] !!}
                @else
                    {!! $value !!}
                @endif
            @endif
        </span>
    </li>
    @endforeach
</ul>