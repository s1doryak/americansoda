@php($selectedGroups = collect($options['selected'] ?? [])->pluck('pivot', 'id'))
@php($name = $options['parent_name'] ?? $options['real_name'])

@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif
            @if ($showLabel && $options['label'] !== false)
                {!! Form::label($name, $options['label'], $options['label_attr']) !!}
            @endif
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    @foreach($options['groups'] as $group)
                        @php($selectedGroup = (object)$selectedGroups->get($group->id))
                        <tr>
                            <td>
                                @php($name = sprintf('%s[%s][name]', $name, $group->id))
                                {!! Form::input('text', $name, $group->name, ['class' => 'form-control', 'disabled' => true]) !!}
                            </td>
                            <td>
                                @php($name = sprintf('%s[%s][price]', $name, $group->id))
                                @php($value = optional($selectedGroup)->price)
                                {!! Form::input('text', $name, old($name, $value), ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('laravel-form-builder::help_block')
            @include('laravel-form-builder::errors')
            @if ($showLabel && $showField)
                @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif
