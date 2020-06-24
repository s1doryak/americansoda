@extends('dashboard::master', ['block_header_classes' => 'block-header block-header-calendar'])
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="calendar-update" content="{{ route('dashboard.calendar.update') }}">
    <link rel="stylesheet"
          href="{{ asset('vendor/material-admin/css/fullcalendar.css') }}?ver={{ config('app.version') }}">
    @parent
    @stop
    @section('page-title')
    {{ config('app.name') }} &ndash; {{ trans('calendar.index.title') }}
@stop
@section('content')
    <div class="block-header block-header-calendar">
        <h2>
            <span>{{ trans('models/customer_order.calendar.title') }}</span>
        </h2>
        <ul class="actions actions-calendar">
            <li><a class="calendar-reload" href=""><i class="zmdi zmdi-refresh"></i></a></li>
            <li><a class="calendar-prev" href=""><i class="zmdi zmdi-chevron-left"></i></a></li>
            <li><a class="calendar-next" href=""><i class="zmdi zmdi-chevron-right"></i></a></li>
            <li class="dropdown">
                <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                <ul class="dropdown-menu dm-icon pull-right">

                    <li>
                        <a data-calendar-view="listWeek">
                            <i class="zmdi zmdi-view-day"></i> {{ trans('calendar.view.list') }}
                        </a>
                    </li>
                    <li>
                        <a data-calendar-view="dayGridMonth">
                            <i class="zmdi zmdi-view-comfy active"></i> {{ trans('calendar.view.month') }}
                        </a>
                    </li>
                    <li>
                        <a href="" data-calendar-view="dayGridWeek">
                            <i class="zmdi zmdi-view-week"></i> {{ trans('calendar.view.week') }}
                        </a>
                    </li>
                    <li>
                        <a href="" data-calendar-view="dayGridDay">
                            <i class="zmdi zmdi-view-day"></i> {{ trans('calendar.view.day') }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="card">
        <div id="calendar"></div>
    </div>
@stop

<!-- Edit event -->
<div class="modal fade" id="modal-edit-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" data-name="event-title"></h4>
            </div>

            <div class="modal-body">
                <form class="form-event">

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-link" data-calendar="update">{{ trans('calendar.event.button.update') }}</button>
                <button class="btn btn-link" data-dismiss="modal">{{ trans('calendar.event.button.close') }}</button>
            </div>
        </div>
    </div>
</div>
@section('scripts')

    @parent
@stop
