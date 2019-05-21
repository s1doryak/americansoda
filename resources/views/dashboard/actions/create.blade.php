@extends(is_ajax() ? 'dashboard::modal' : 'dashboard::master')

@section('title', $title)

@section('buttons')
    @include('material-admin::master.sections.buttons')
@stop

@section('modal-buttons')
    @include('material-admin::master.sections.modal-buttons')
@stop

@section('card-body')

    @hasSection('modal-content')
        @yield('modal-content')
    @else
        @include('material-admin::master.sections.form')
    @endif

    @include('material-admin::master.sections.notifications')
@stop