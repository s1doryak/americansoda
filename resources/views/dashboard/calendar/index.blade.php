@extends('dashboard::master', ['block_header_classes' => 'block-header block-header-calendar'])
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="calendar-update" content="{{ route('dashboard.calendar.update') }}">
    @stop
    @section('page-title')
    {{ config('app.name') }} &ndash; {{ trans('calendar.index.title') }}
@stop
@section('block-header-title')
    <h2>
        <span>{{ $title }}</span>
    </h2>
@stop
@section('actions')
    <ul class="actions actions-calendar">
        <li><a class="calendar-reload" href=""><i class="zmdi zmdi-refresh"></i></a></li>
        <li><a class="calendar-prev" href=""><i class="zmdi zmdi-chevron-left"></i></a></li>
        <li><a class="calendar-next" href=""><i class="zmdi zmdi-chevron-right"></i></a></li>
        <li class="dropdown">
            <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
            <ul class="dropdown-menu dm-icon pull-right">
                <li><a href="" data-calendar-view="month"><i class="zmdi zmdi-view-comfy active"></i> {{ trans('calendar.view.month') }}</a></li>
                <li><a href="" data-calendar-view="basicWeek"><i class="zmdi zmdi-view-week"></i> {{ trans('calendar.view.week') }}</a></li>
                <li><a href="" data-calendar-view="basicDay"><i class="zmdi zmdi-view-day"></i> {{ trans('calendar.view.day') }}</a></li>
            </ul>
        </li>
    </ul>
@stop
@section('content')
    <div id="calendar" class="card"></div>

    <!-- Edit event -->
    <div class="modal fade" id="modal-edit-event">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" data-name="event-title"></h4>
                </div>

                <div class="modal-body">
                    <form class="form-event">
                        <div class="form-group">
                            <div class="fg-line">
                                <div data-name="event-description"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="fg-line">
                                <textarea class="form-control auto-size html-editor" name="event-comment"
                                          placeholder="{{ trans('calendar.placeholder.comment') }}" rows="6"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="event-id">
                        <input type="hidden" name="event-type">
                        <input type="hidden" name="event-start">
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-link" data-calendar="update">{{ trans('calendar.button.update') }}</button>
                    <button class="btn btn-link" data-dismiss="modal">{{ trans('calendar.button.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')

    @parent

    @include('dashboard::calendar.templates.event_description')

    <!-- Calendar Script -->
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var $calendar = $('#calendar');

            $calendar.fullCalendar({
                header: {
                    right: '',
                    center: '',
                    left: ''
                },
                firstDay: 1,
                weekNumbers: true,
                theme: false,
                selectable: true,
                selectHelper: true,
                editable: true,
                events: '/dashboard/calendar.json',

                eventClick: function (event, element) {

                    var $modal = $('#modal-edit-event'),
                        $form = $modal.find('.form-event');

                    $modal.find('[data-name="event-title"]').text(event.title);

                    $form.find('input[name="event-id"]').val(event._id);
                    $form.find('input[name="event-start"]').val(event.start.toISOString());

                    if (event.type === 'order') {
                        $form.find('textarea[name="event-comment"]').val(event.comment);
                        $modal.find('[data-calendar="update"]').hide();
                    } else {
                        $form.find('textarea[name="event-comment"]').val(event.future_comment);
                        $modal.find('[data-calendar="update"]').show();
                    }

                    $form.find('textarea[name="event-comment"]').destroy();
                    $form.find('textarea[name="event-comment"]').summernote({
                        lang: 'ru-RU',
                        focus: true,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol']]
                        ]
                    });

                    $form.find('[data-name="event-description"]').html(
                        Handlebars.compile(
                            $('[data-template="event-description"]').html()
                        )(event)
                    );

                    $modal.modal('show');
                },

                viewRender: function (view) {
                    var calendarDate = $("#calendar").fullCalendar('getDate');
                    var calendarMonth = calendarDate.month();

                    //Set data attribute for header. This is used to switch header images using css
                    $('#calendar .fc-toolbar').attr('data-calendar-month', calendarMonth);

                    //Set title in page header
                    $('.block-header-calendar > h2 > span').html(view.title);
                },

                eventRender: function (event, element, view) {

                    if (event.type === 'future' && event.overdue) {
                        element.append(
                            $('<div/>')
                                .attr('data-toggle', 'tooltip')
                                .attr('data-placement', 'top')
                                .attr('title', event.overdue + 'd overdue')
                                .addClass('fc-badge')
                                .text(event.overdue)
                        );

                        element.find('[data-toggle=tooltip]').tooltip();
                    }
                },

                eventDrop: function (event, delta, revertFunc) {

                    $.ajax({
                        url: $('meta[name="calendar-update"]').attr('content'),
                        method: 'post',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            event: {
                                type: event.type,
                                order: event.order,
                                start: event.start.format('DD-MM-YYYY'),
                                comment: event.comment,
                                future_comment: event.future_comment
                            }
                        },
                        dataType: 'json',
                        success: function (response) {

                            var overdue = response.overdue;

                            if(overdue >= 0) {

                                event.overdue = overdue;

                                $calendar.fullCalendar('updateEvent', event);

                            } else {

                                revertFunc();

                                notify('You cannot move event rather then created!', 'danger');
                            }
                        },
                        error: function (response) {
                            notify('Fail to move to ' + event.start.format('DD/MM/YYYY') + '!', 'danger');
                        },
                        complete: function () {
                        }
                    });

                    /*swal({
                        title: 'Are you sure to move event to ' + event.start.format() + '?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!'
                    }).then(
                        function () {

                        },
                        function (dismiss) {
                            if (dismiss === 'cancel') {
                                revertFunc();
                            }
                        }
                    );*/

                }
            });

            //Calendar views switch
            $('[data-calendar-view]').on('click', function (e) {
                e.preventDefault();

                var calendarView = $(this).attr('data-calendar-view');
                $calendar.fullCalendar('changeView', calendarView);
            });

            //Calendar Reload
            $(document).on('click', '.calendar-reload', function (e) {
                e.preventDefault();
                $calendar.fullCalendar('refetchEvents');
            });

            //Calendar Next
            $(document).on('click', '.calendar-next', function (e) {
                e.preventDefault();
                $calendar.fullCalendar('next');
            });

            //Calendar Prev
            $(document).on('click', '.calendar-prev', function (e) {
                e.preventDefault();
                $calendar.fullCalendar('prev');
            });

            //Update an Event
            $(document).on('click', '[data-calendar]', function () {
                var $this = $(this),
                    $modal = $this.closest('.modal'),
                    $form = $modal.find('.form-event'),
                    eventId = $form.find('input[name="event-id"]').val(),
                    eventComment = $form.find('textarea[name="event-comment"]').val(),
                    eventStart = $form.find('input[name="event-start"]').val(),
                    event = $calendar.fullCalendar('clientEvents', eventId)[0],
                    action = $this.data('calendar');

                if (action === 'update') {

                    if(event.type === 'future') {
                        event.future_comment = eventComment;
                    } else {
                        event.comment = eventComment;
                    }

                    event.start = moment(eventStart);

                    $.ajax({
                        url: $('meta[name="calendar-update"]').attr('content'),
                        method: 'post',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            event: {
                                type: event.type,
                                order: event.order,
                                start: event.start.format('DD-MM-YYYY'),
                                comment: event.comment,
                                future_comment: event.future_comment
                            }
                        },
                        dataType: 'json',
                        success: function (response) {

                            var index;

                            if(event.type === 'future') {
                                if(response.has_comment) {
                                    event.className.push('fc-order-has-future-comment');
                                } else {
                                    index = event.className.indexOf('fc-order-has-future-comment');
                                    if (index > -1) {
                                        event.className.splice(index, 1);
                                    }
                                }
                            } else {
                                if(response.has_comment) {
                                    event.className.push('fc-order-has-comment');
                                } else {
                                    index = event.className.indexOf('fc-order-has-comment');
                                    if (index > -1) {
                                        event.className.splice(index, 1);
                                    }
                                }
                            }

                            $calendar.fullCalendar('updateEvent', event);

                        },
                        error: function (response) {
                            notify('Fail to update event!', 'danger');
                        },
                        complete: function () {
                        }
                    });

                    $form.each(function () {
                        this.reset();
                    });

                    $modal.find('[data-name="event-title"]').text('');
                    $modal.modal('hide');

                }
            });
        });
    </script>
@stop