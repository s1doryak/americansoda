@set($old = old(camel_case(str_plural(str_replace('.', '_', $options['resource'])))))
@set($items = ($old !== null ? $old : (isset($options['items']) ? $options['items'] : [])))
@if ($items)
    @foreach($items as $idx => $item)
        @include('dashboard::vendor.laravel-form-builder.custom.forms._relation-form-row', [
            'is_template' => false,
            'multiple_rows' => true,
            'item' => $item,
            'index' => $idx,
            'can_add' => (isset($options['can_add']) ? $options['can_add'] : true),
            'can_select' => (isset($options['can_select']) ? $options['can_select']($item) : true),
            'can_edit' => (isset($options['can_edit']) ? $options['can_edit']($item) : true),
            'can_remove' => (isset($options['can_remove']) ? $options['can_remove']($item) : true),
            'actions' => (isset($options['actions']) ? $options['actions'] : true)
        ])
    @endforeach
@endif