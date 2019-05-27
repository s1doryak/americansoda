@set($is_template = isset($is_template) && $is_template === true)

@set($old = old(camel_case(str_plural(str_replace('.', '_', $options['resource'])))))
@set($items = ($old !== null ? collect($old) : (isset($options['items']) ? $options['items'] : collect([]))))
@set($groupItems = $items->filter(function($item) use($group) {
if(is_object($item)) {
return ($item->productGroup->getKey() == $group->getKey()) && $item->deleted_at === null;
} else {
return ($item['productGroup'] == $group->getKey());
}
}))


@if (!$is_template)

    @forelse($groupItems as $idx => $policy)

        @include('dashboard::vendor.laravel-form-builder.custom.forms._relation-form-row', [
            'item' => $policy,
            'index' => $idx,
            'multiple_rows' => true,
            'can_select' => (isset($options['can_select']) ? $options['can_select']($policy) : true),
            'can_edit' => (isset($options['can_edit']) ? $options['can_edit']($policy) : true),
            'can_remove' => (isset($options['can_remove']) ? $options['can_remove'] : true)
        ])

    @empty
        @include('dashboard::vendor.laravel-form-builder.custom.forms._relation-form-row', [
            'item' => [
                'productGroup' => $group->getKey(),
            ],
            'can_select' => true,
            'can_edit' => true,
            'can_remove' => (isset($options['can_remove']) ? $options['can_remove'] : true)
        ])
    @endforelse

@else

    @include('dashboard::vendor.laravel-form-builder.custom.forms._relation-form-row', [
        'item' => [
            'productGroup' => $group->getKey(),
        ],
        'can_select' => true,
        'can_edit' => true,
        'can_remove' => (isset($options['can_remove']) ? $options['can_remove'] : true)
    ])

@endif