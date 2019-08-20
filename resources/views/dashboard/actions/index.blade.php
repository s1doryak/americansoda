@extends(is_ajax() ? 'dashboard::modal' : 'dashboard::master')

@section('title', $title)

@section('content')
    @include('material-admin::master.sections.datatable')
    @include('material-admin::master.sections.notifications')
@stop
