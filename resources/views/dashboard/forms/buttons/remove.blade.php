{!! Form::button(
    trans('forms.buttons.remove'),
    [
        'class' => 'btn btn-danger waves-effect js-remove-row',
        'data-text' => trans('forms.buttons.undo'),
        'disabled' => isset($can_remove) && $can_remove == false ? true : false
    ]
) !!}