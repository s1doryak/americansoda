@extends(is_ajax() ? 'dashboard::modal' : 'dashboard::master')

@section('title', $title)

@section('content')
    @include('material-admin::master.sections.datatable')
    @include('material-admin::master.sections.notifications')
@stop

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('vendor/material-admin/css/datatables.css') }}?ver={{ config('app.version') }}">
    {{-- <link rel="stylesheet" href="{{ asset('vendor/material-admin/css/fullcalendar.css') }}?ver={{ config('app.version') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/material-admin/css/charts.css') }}?ver={{ config('app.version') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/material-admin/css/demo.css') }}?ver={{ config('app.version') }}"> --}}
@stop

@section('scripts')
    @parent
    <script src="{{ asset('vendor/material-admin/js/datatables.js') }}?ver={{ config('app.version') }}"></script>
    {{-- <script src="{{ asset('vendor/material-admin/js/fullcalendar.js') }}?ver={{ config('app.version') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/material-admin/js/charts.js') }}?ver={{ config('app.version') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/material-admin/js/demo.js') }}?ver={{ config('app.version') }}"></script> --}}
@stop
