@if (is_edit_page() && can_delete_resource($model))
    {!! Form::open([
        'method' => 'DELETE',
        'url' => resource_destroy_url(),
        'class' => 'pull-left'
    ]) !!}
    {!! Form::button(trans('material-admin::forms.buttons.delete'), [
        'type' => 'submit',
        'class' => 'btn btn-danger waves-effect'
    ]) !!}
    {!! Form::close() !!}
@endif
@if(is_create_page())
    <button class="btn btn-primary waves-effect" data-action="create">{{ trans('material-admin::forms.buttons.create') }}</button>
@endif
@if(is_edit_page())
    <button class="btn btn-primary waves-effect" data-action="update">{{ trans('material-admin::forms.buttons.update') }}</button>
@endif
<button class="btn btn-link" data-dismiss="modal">{{ trans('material-admin::forms.buttons.close') }}</button>