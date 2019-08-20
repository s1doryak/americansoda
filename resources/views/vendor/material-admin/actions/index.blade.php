@extends(is_ajax() ? 'material-admin::modal' : 'material-admin::master')

@section('title', $title)

@section('content')
    @include('material-admin::master.sections.datatable')
    @include('material-admin::master.sections.notifications')
@stop
