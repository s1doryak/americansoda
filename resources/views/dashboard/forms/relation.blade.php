@set($exclude = (array)$options['exclude'])
@set($fields = (array)$options['children'])
@set($can_add = isset($options['can_add']) ? $options['can_add'] : true)
@set($actions = isset($options['actions']) ? $options['actions'] : true)

@section('scripts')
    @parent
    @if(isset($options['can_add']) ? $options['can_add'] : true)
        <script class="js-relation-form-row" data-resource="{{ $options['resource'] }}" type="text/x-handlebars-template">
            @include('dashboard::vendor.laravel-form-builder.custom.forms._relation-form-row', [
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
                    @include('dashboard::partials.forms.buttons.add')
                @endif
            </h4>
            <table class="{{ str_plural(str_replace('.', '-', $options['resource'])) }}-table relation-form-table table js-relation-form" data-resource="{{ $options['resource'] }}">
                <thead>
                <tr>
                    @foreach($fields as $field)
                        @set($type = $field->getType())
                        @if ($type !== 'hidden' && !in_array($field->getRealName(), $exclude))
                            @set($th = 'th-' . $field->getRealName() . ' th-' . $type)
                            <th class="{{ $th }}">{{ $field->getOption('label') }}</th>
                        @endif
                    @endforeach
                    @if($actions)
                        <th>{{ trans('forms.labels.actions') }}</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @include('dashboard::vendor.laravel-form-builder.custom.forms._relation-form-rows', [
                    'actions' => $actions
                ])
                </tbody>
            </table>

            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif