@extends('dashboard::actions.index')

@section('scripts')
    @parent

    <style type="text/css">
        #failedJobDatatable .column-exception span {
            max-width: 100%;
            text-overflow: ellipsis;
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
        }
    </style>
@stop
