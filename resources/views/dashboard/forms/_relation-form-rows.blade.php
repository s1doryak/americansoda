@php($old = old(Str::camel(Str::plural(str_replace('.', '_', $options['resource'])))))
@php($items = ($old !== null ? $old : (isset($options['items']) ? $options['items'] : [])))
@if ($items)
    @foreach($items as $idx => $item)
        @include('dashboard::forms._relation-form-row', [
            'idx' => $idx,
            'item' => $item,
            'is_template' => false,
            'multiple_rows' => true,
            'can_add' => (isset($options['can_add']) ? is_callable($options['can_add']) ? $options['can_add']() : (boolean)$options['can_add'] : true),
            'can_select' => (isset($options['can_select']) ? is_callable($options['can_select']) ? $options['can_select']($item) : (boolean)$options['can_select'] : true),
            'can_edit' => (isset($options['can_edit']) ? is_callable($options['can_edit']) ? $options['can_edit']($item) : (boolean)$options['can_edit'] : true),
            'can_remove' => (isset($options['can_remove']) ? is_callable($options['can_remove']) ? $options['can_remove']($item) : (boolean)$options['can_remove'] : true),
            'actions' => (isset($options['actions']) ? is_callable($options['actions']) ? $options['actions']() : (boolean)$options['actions'] : true)
        ])
    @endforeach
@endif
