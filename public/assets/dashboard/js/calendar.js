
jQuery(document).ready(function () {
    var $calendar = $('#calendar'),
        $calendarNode = $calendar.get(0),
        isMobile = $('html').hasClass('ismobile'),
        calendar;

    if ($calendarNode && FullCalendar) {
        calendar = new FullCalendar.Calendar($calendarNode, {
            plugins: ['interaction', 'moment', 'dayGrid', 'list'],
            header: false,
            defaultView: isMobile ? 'listWeek' : 'dayGridMonth',
            firstDay: 1,
            weekNumbers: true,
            longPressDelay: 3000,
            themeSystem: 'standard',
            editable: true,
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },
            events: {
                url: '/dashboard/calendar.json',
            }
        });

        calendar.on('loading', function (isLoading) {
            if (isLoading) {
                $.showLoader();
            } else {
                $.hideLoader();
            }
        });

        calendar.on('eventClick', function (info) {
            var $modal = $('#modal-edit-event'),
                event = info.event,
                $form = $modal.find('.form-event');

            $form.html(
                event.extendedProps.calendarModal
            );

            $modal.find('[data-name="event-title"]').text(event.title);

            $form.find('input[name="event-id"]').val(event._id);
            $form.find('input[name="event-start"]').val(moment(event.start).toISOString());

            if (event.extendedProps.type === 'order') {
                $form.find('textarea[name="event-comment"]').val(event.extendedProps.comment);
                $modal.find('[data-calendar="update"]').hide();
            } else {
                $form.find('textarea[name="event-comment"]').val(event.extendedProps.future_comment);
                $modal.find('[data-calendar="update"]').show();
            }

            $form.trigger('reanimate');

            $modal.modal('show');
        });

        calendar.on('eventDrop', function (info) {
            var event = info.event;
                $.ajax({
                url: $('meta[name="calendar-update"]').attr('content'),
                method: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    event: {
                        type: event.type,
                        order: event.order,
                        start: moment(event.start).format('DD-MM-YYYY'),
                        comment: event.comment,
                        future_comment: event.future_comment
                    }
                },
                dataType: 'json',
                success: function (response) {

                    var overdue = response.overdue;

                    if (overdue >= 0) {

                        event.overdue = overdue;

                        calendar.FullCalendar('updateEvent', event);

                    } else {

                        revertFunc();

                        notify('You cannot move event rather then created!', 'danger');
                    }
                },
                error: function (response) {
                    notify('Fail to move to ' + moment(event.start).format('DD/MM/YYYY') + '!', 'danger');
                },
                complete: function () {
                }
            });
        });

        calendar.on('datesRender', function (info) {
            var view = info.view,
                calendarDate = calendar.getDate();

            $calendar.find('.fc-toolbar')
                .attr('data-calendar-month', calendarDate.getMonth());

            $('.block-header-calendar > h2 > span').html(view.title);
        });

        calendar.on('eventRender', function (info) {
            var event = info.event,
                $element = $(info.el);

            if (event.extendedProps.type === 'future' && event.extendedProps.overdue) {
                $element.append(
                    $('<div/>')
                        .attr('data-toggle', 'tooltip')
                        .attr('data-placement', 'top')
                        .attr('title', event.extendedProps.overdue + 'd overdue')
                        .addClass('fc-badge')
                        .text(event.extendedProps.overdue)
                );

                $element.find('[data-toggle=tooltip]').tooltip();
            }
        });

        calendar.render();
    }
    //Calendar views switch
    $('[data-calendar-view]').on('click', function (e) {
        e.preventDefault();

        var calendarView = $(this).attr('data-calendar-view');
        calendar.changeView(calendarView);
    });

    //Calendar Reload
    $(document).on('click', '.calendar-reload', function (e) {
        e.preventDefault();
        calendar.refetchEvents();
    });

    //Calendar Next
    $(document).on('click', '.calendar-next', function (e) {
        e.preventDefault();
        calendar.next();
    });

    //Calendar Prev
    $(document).on('click', '.calendar-prev', function (e) {
        e.preventDefault();
        calendar.prev();
    });

    //Update an Event
    $(document).on('click', '[data-calendar]', function () {
        var $this = $(this),
            $modal = $this.closest('.modal'),
            $form = $modal.find('.form-event'),
            eventId = $form.find('input[name="event-id"]').val(),
            eventComment = $form.find('textarea[name="event-comment"]').val(),
            eventStart = $form.find('input[name="event-start"]').val(),
            event = calendar.getEventById(eventId)[0],
            action = $this.data('calendar');

        if (action === 'update') {

            if (event.type === 'future') {
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
                        start: moment(event.start).format('DD-MM-YYYY'),
                        comment: event.comment,
                        future_comment: event.future_comment
                    }
                },
                dataType: 'json',
                success: function (response) {

                    var index;

                    if (event.type === 'future') {
                        if (response.has_comment) {
                            event.className.push('fc-order-has-future-comment');
                        } else {
                            index = event.className.indexOf('fc-order-has-future-comment');
                            if (index > -1) {
                                event.className.splice(index, 1);
                            }
                        }
                    } else {
                        if (response.has_comment) {
                            event.className.push('fc-order-has-comment');
                        } else {
                            index = event.className.indexOf('fc-order-has-comment');
                            if (index > -1) {
                                event.className.splice(index, 1);
                            }
                        }
                    }

                    $calendar.refetchEvents();

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