@extends(is_ajax() ? 'app::modal' : 'app::master')

@section('title', $title)

@section('content')
    @include('material-admin::master.sections.datatable')
    @include('material-admin::master.sections.notifications')
@stop
