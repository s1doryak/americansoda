@if($job)
    {{ class_basename($job->payload->displayName) }}
    <a data-toggle="collapse" href="#job{{ $job->getKey() }}" title="{{ trans('models/job.columns.payload') }}">
        <i class="zmdi zmdi-code zmdi-hc-lg zmdi-hc-fw c-blue"></i>
    </a>
    <div id="job{{ $job->getKey() }}" class="collapse m-t-20">
        <pre>{!! json_encode($job->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</pre>
    </div>
@else
    @include('datatables::columns.default')
@endif
