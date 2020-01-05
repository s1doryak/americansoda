@php($exclude = (array)$options['exclude'])
@php($fields = (array)$options['children'])
@php($groups = (isset($options['groups']) ? $options['groups'] : collection()))
@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif

            <h4>{{ $options['form_title'] }}</h4>
            @foreach($groups as $group)
                <table class="{{ str_plural(str_replace('.', '-', $options['resource'])) }}-table relation-form-table table js-relation-form"
                       data-resource="{{ $options['resource'] }}[{{ $group->id }}]">
                    <tbody>
                    @include('dashboard::resources.customer.policies._group-header', [
                        'group' => $group,
                        'can_add' => true
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
        <script data-role="template" data-resource="{{ $options['resource'] }}[{{ $group->id }}]">
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
