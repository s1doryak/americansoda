@if($failedJob)
    <a data-toggle="collapse" href="#failed_job{{ $failedJob->getKey() }}--payload" title="{{ trans('models/failed_job.columns.payload') }}">
        <i class="zmdi zmdi-code zmdi-hc-lg zmdi-hc-fw c-blue"></i>
    </a>
    {{ class_basename($failedJob->payload->displayName) }}
    <div id="failed_job{{ $failedJob->getKey() }}--payload" class="collapse m-t-20">
        <pre>{!! json_encode($failedJob->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</pre>
    </div>
@else
    @include('datatables::columns.default')
@endif
