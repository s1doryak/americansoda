@set($policies = collect($policies)->groupBy('productGroup.name'))
@set($attributes = ['products_range', 'price'])
<table class="revisions-table table">
    <tbody>
    @foreach($policies as $group => $grouped)
        <tr><td colspan="2"><h4>{{ ucfirst($group) }}</h4></td></tr>
        <tr>
            @foreach($attributes as $attribute)
                <th>@lang(sprintf('models/customer_pricing_policy.fields.%s', $attribute))</th>
            @endforeach
        </tr>
        @foreach($grouped as $policy)
        <tr>
            @if ($policy->deleted_at)
                @foreach($attributes as $attribute)
                    <td>{!! $policy->{$attribute} !!}</td>
                @endforeach
            @else
                @foreach($policy->getChangedAttributes() as $attribute => $value)
                    <td>
                        @if (is_array($value))
                            {!! $value['name'] !!}
                        @else
                            {!! $value !!}
                        @endif
                    </td>
                @endforeach
            @endif
        </tr>
        @endforeach
    @endforeach
    </tbody>
</table>