@php($exclude = (array)$options['exclude'])
@php($fields = (array)$options['children'])
@php($groups = $options['groups'] ?? collect())
@php($can_add = isset($options['can_add']) ? is_callable($options['can_add']) ? call_user_func($options['can_add']) : (boolean)$options['can_add'] : true)
@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif

            <h4>{{ $options['form_title'] }}</h4>
            @foreach($groups as $group)
                <table class="{{ Str::plural(str_replace('.', '-', $options['resource'])) }}-table relation-form-table table js-relation-form"
                       data-resource="{{ $options['resource'] }}[{{ $group->getKey() }}]">
                    <tbody>
                    @include('dashboard::resources.customer.policies._group-header', [
                        'group' => $group,
                        'is_template' => false,
                        'can_add' => $can_add,
                        'can_select' => true,
                        'can_edit' => true,
                        'can_remove' => true
                    ])
                    @include('dashboard::resources.customer.policies.policies', compact('fields', 'group'))
                    </tbody>
                </table>
            @endforeach

            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif

@section('scripts')
    @foreach($groups as $group)
        <script data-role="template" data-resource="{{ $options['resource'] }}[{{ $group->getKey() }}]" type="text/html">
        @include('dashboard::resources.customer.policies.policies', [
            'group' => $group,
            'is_template' => true,
            'exclude' => ['id'],
            'can_select' => true,
            'can_edit' => true,
            'can_remove' => true
        ])
        </script>
    @endforeach
@stop
