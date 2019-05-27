@extends('dashboard::actions.create')

@section('card-body')

    @hasSection('modal-content')
        @yield('modal-content')
    @else
        @include('material-admin::master.sections.form')

        @if (!is_create_page())
            @include('dashboard::resources.customers._timeline')
        @endif
    @endif

    @include('material-admin::master.sections.notifications')
@stop