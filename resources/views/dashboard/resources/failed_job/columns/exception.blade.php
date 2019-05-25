@if($failedJob)
    <a data-toggle="collapse" href="#failed_job{{ $failedJob->getKey() }}--exception" title="{{ trans('models/failed_job.columns.exception') }}">
        <i class="zmdi zmdi-code zmdi-hc-lg zmdi-hc-fw c-blue"></i>
    </a>
    <span>{{ array_first(explode("\n", $failedJob->exception)) }}</span>
    <div id="failed_job{{ $failedJob->getKey() }}--exception" class="collapse m-t-20">
        <pre>{!! $failedJob->exception !!}</pre>
    </div>
@else
    @include('datatables::columns.default')
@endif
