@foreach($popupActions ?? [] as $action => $params)
    <div class="modal" data-role="modal" data-action="{{ $action }}" data-resource="{{ $params['resource'] }}">
        <div class="modal-dialog {{ $params['class'] }}">
            <div class="modal-content">
                <!-- /text/html -->
            </div>
        </div>
    </div>
    <script data-role="template" data-resource="{{ $params['resource'] }}" data-action="{{ $action }}" type="text/html">
        <div class="modal-header">
            <button class="close" data-dismiss="modal"><i class="zmdi zmdi-close zmdi-hc-lg"></i></button>
            <h4 class="modal-title">{{ $params['title'] }}</h4>
        </div>

        <div class="modal-body">
            <div class="text-center m-t-30 m-b-30">
                <i class="zmdi zmdi-more zmdi-hc-5x zmdi-hc-fw animated infinite pulse"></i>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-link" data-dismiss="modal">{{ trans('material-admin::forms.buttons.close') }}</button>
        </div>
    </script>
@endforeach
