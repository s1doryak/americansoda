{!! Form::button(
    trans('forms.buttons.remove'),
    [
        'class' => 'btn btn-danger js-remove-row',
        'data-text' => trans('forms.buttons.undo'),
        'disabled' => $can_remove ?? false
    ]
) !!}
