<div class="modal-header">
    <button class="close" data-dismiss="modal"><i class="zmdi zmdi-close zmdi-hc-lg"></i></button>
    @hasSection('title')
        <h4 class="modal-title">
            @yield('title')
        </h4>
    @endif
</div>

<div class="modal-body">
    @hasSection('card-body')
        @yield('card-body')
    @else
        @isset($form)
            <div class="form-container">
                {!! form($form) !!}
            </div>
        @endisset
    @endif
</div>

<div class="modal-footer">
    @hasSection('modal-buttons')
        @yield('modal-buttons')
    @else
        <button class="btn btn-link" data-dismiss="modal">{{ trans('material-admin::forms.buttons.close') }}</button>
    @endif
</div>

@hasSection('scripts')
    @yield('scripts')
@endif
