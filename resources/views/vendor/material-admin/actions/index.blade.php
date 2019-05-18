@extends(is_ajax() ? 'material-admin::modal' : 'material-admin::master')

@section('title', $title)

@section('buttons')
    @include('material-admin::master.sections.buttons')
@stop

@section('content')
    @include('material-admin::master.sections.datatable')
    @include('material-admin::master.sections.notifications')
@stop