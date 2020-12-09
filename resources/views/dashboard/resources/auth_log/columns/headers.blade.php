<div class="media m-t-5">
    <div class="media-body">
        <div class="lgi-text">
            <i class="zmdi zmdi-circle zmdi-hc-lg zmdi-hc-fw"
               style="color: {{ $model->version ? 'green' : 'gray' }}"></i> {{ $model->version ?: trans('models/auth_log.headers.unknown') }}
        </div>
    </div>
</div>

<div class="media m-t-5">
    <div class="media-body">
        <div class="lgi-text">
            <i class="zmdi zmdi-circle zmdi-hc-lg zmdi-hc-fw"
               style="color: {{ $model->user_agent ? 'green' : 'gray' }}"></i> {{ $model->user_agent ?: trans('models/auth_log.headers.user_agent') }}
        </div>
    </div>
</div>

<div class="media m-t-5">
    <div class="media-body">
        <div class="lgi-text">
            <i class="zmdi zmdi-circle zmdi-hc-lg zmdi-hc-fw"
               style="color: {{ $model->zendesk ? 'green' : 'gray' }}"></i> {{ trans('models/auth_log.headers.zendesk') }}
        </div>
    </div>
</div>

<div class="media m-t-5">
    <div class="media-body">
        <div class="lgi-text">
            <i class="zmdi zmdi-circle zmdi-hc-lg zmdi-hc-fw"
               style="color: {{ $model->sentry ? 'green' : 'gray' }}"></i> {{ trans('models/auth_log.headers.sentry') }}
        </div>
    </div>
</div>
