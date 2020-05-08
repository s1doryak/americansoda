@php($is_template = $is_template ?? false)
@php($items = $options['items'] ?? collect())
@php($can_add = isset($options['can_add']) ? is_callable($options['can_add']) ? call_user_func($options['can_add']) : (boolean)$options['can_add'] : true)
@php($actions = isset($options['actions']) ? is_callable($options['actions']) ? call_user_func($options['actions']) : (boolean)$options['actions'] : true)

@if ($is_template)

    @include('dashboard::forms._relation-form-row', [
        'can_select' => true,
        'can_edit' => true,
        'can_remove' => true
    ])

@else

    @if($items->get($group->getKey()))

        @foreach($items->get($group->getKey()) as $item)

            @php($can_select = isset($options['can_select']) ? is_callable($options['can_select']) ? call_user_func($options['can_select'], $item) : (boolean)$options['can_select'] : true)
            @php($can_edit = isset($options['can_edit']) ? is_callable($options['can_edit']) ? call_user_func($options['can_edit'], $item) : (boolean)$options['can_edit'] : true)
            @php($can_remove = isset($options['can_remove']) ? is_callable($options['can_remove']) ? call_user_func($options['can_remove'], $item) : (boolean)$options['can_remove'] : true)

            @include('dashboard::forms._relation-form-row', [
                'item' => $item,
                'idx' => static_idx(),
                'is_template' => false,
                'multiple_rows' => true,
                'can_add' => $can_add,
                'can_select' => $can_select,
                'can_edit' => $can_edit,
                'can_remove' => $can_remove,
                'actions' => $actions
            ])

        @endforeach

    @else
        @php($item = null)
        @php($can_select = isset($options['can_select']) ? is_callable($options['can_select']) ? call_user_func($options['can_select'], $item) : (boolean)$options['can_select'] : true)
        @php($can_edit = isset($options['can_edit']) ? is_callable($options['can_edit']) ? call_user_func($options['can_edit'], $item) : (boolean)$options['can_edit'] : true)
        @php($can_remove = isset($options['can_remove']) ? is_callable($options['can_remove']) ? call_user_func($options['can_remove'], $item) : (boolean)$options['can_remove'] : true)

    @include('dashboard::forms._relation-form-row', [
        'can_select' => $can_select,
        'can_edit' => $can_edit,
        'can_remove' => $can_remove,
        'item' => $item

    ])
@endif



@endif
