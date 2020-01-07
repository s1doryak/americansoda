@php($exclude = (array)$options['exclude'])
@php($fields = (array)$options['children'])
@php($can_add = isset($options['can_add']) ? is_callable($options['can_add']) ? call_user_func($options['can_add']) : (boolean)$options['can_add'] : true)
@php($actions = isset($options['actions']) ? is_callable($options['actions']) ? call_user_func($options['actions']) : (boolean)$options['actions'] : true)
@section('scripts')
    @parent
    @if($can_add)
        <script data-role="template" data-resource="{{ $options['resource'] }}" type="text/html">
            @include('dashboard::forms._relation-form-row', [
                'is_template' => true,
                'exclude' => ['id'],
                'can_select' => true,
                'can_edit' => true,
                'can_remove' => true,
                'actions' => $actions
            ])
        </script>
    @endif
@stop

@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif

            <h4>
                {{ $options['form_title'] }}
                @if($can_add)
                    @include('dashboard::forms.buttons.add')
                @endif
            </h4>
            <table class="{{ str_plural(str_replace('.', '-', $options['resource'])) }}-table relation-form-table table js-relation-form" data-resource="{{ $options['resource'] }}">
                <thead>
                <tr>
                    @foreach($fields as $field)
                        @php($type = $field->getType())
                        @if ($type !== 'hidden' && !in_array($field->getRealName(), $exclude))
                            @php($th = 'th-' . $field->getRealName() . ' th-' . $type)
                            <th class="{{ $th }}">{{ $field->getOption('label') }}</th>
                        @endif
                    @endforeach
                    @if($actions)
                        <th>{{ trans('forms.labels.actions') }}</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @include('dashboard::forms._relation-form-rows', [
                    'actions' => $actions
                ])
                </tbody>
            </table>

            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif
