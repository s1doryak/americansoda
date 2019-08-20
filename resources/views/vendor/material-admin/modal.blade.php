<div class="modal-header">
    <button class="close" data-dismiss="modal"><i class="zmdi zmdi-close zmdi-hc-lg"></i></button>
    @hasSection('title')
        <h4 class="modal-title">
            @yield('title')
        </h4>
    @endif
</div>

<div class="modal-body">
    @hasSection('modal-content')
        @yield('modal-content')
    @else
        <div class="form-container">
            {!! form($form) !!}
        </div>
    @endif
</div>

<div class="modal-footer">
    @hasSection('modal-buttons')
        @yield('modal-buttons')
    @else
        <button class="btn btn-link" data-dismiss="modal">{{ trans('material-admin::forms.buttons.close') }}</button>
    @endif
</div>
