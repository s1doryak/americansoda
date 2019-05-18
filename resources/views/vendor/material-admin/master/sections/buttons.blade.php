<div class="buttons">
    @if (is_edit_page() && can_delete_resource($model))
        {!! Form::open([
            'method' => 'DELETE',
            'url' => resource_destroy_url(),
            'class' => 'resource-destroy-form'
        ]) !!}
        {!! Form::button(trans('material-admin::forms.buttons.delete'), [
            'type' => 'submit',
            'class' => 'btn btn-link btn-danger btn-sm waves-effect'
        ]) !!}
        {!! Form::close() !!}
    @endif
    @if (is_index_page() && can_create_resource())
        {!! Form::open([
            'method' => 'GET',
            'url' => resource_create_url(),
        ]) !!}
        {!! Form::button(trans(sprintf('models/%s.labels.create', resource_name())), [
            'type' => 'submit',
            'class' => 'btn btn-link btn-primary btn-sm waves-effect'
        ]) !!}
        {!! Form::close() !!}
    @endif
</div>