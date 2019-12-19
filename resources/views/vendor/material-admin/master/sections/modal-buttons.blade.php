@if (is_edit_page() && can_delete_resource($model))
    {!! Form::open([
        'method' => 'post',
        'url' => resource_destroy_url(),
        'data-resource' => resource_name(),
        'data-action' => 'trash',
        'class' => 'pull-left',
    ]) !!}
    {!! Form::hidden('_method', 'delete') !!}
    {!! Form::button(trans('material-admin::forms.buttons.delete'), [
        'type' => 'submit',
        'class' => 'btn btn-danger'
    ]) !!}
    {!! Form::close() !!}
@endif
@if(is_create_page() && can_create_resource())
    <button type="submit" class="btn btn-primary" data-action="create">
        {{ trans('material-admin::forms.buttons.create') }}
    </button>
@endif
@if(is_edit_page() && can_edit_resource($model))
    <button type="submit" class="btn btn-primary" data-action="update">
        {{ trans('material-admin::forms.buttons.update') }}
    </button>
@endif
<button type="button" class="btn btn-link" data-dismiss="modal">
    {{ trans('material-admin::forms.buttons.close') }}
</button>