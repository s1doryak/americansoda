(function ($) {

    /**
     * Показать всплывающее окно.
     */
    $.showLoader = function () {

        $('#header .hi-spinner > div').show();
    };

    /**
     * Скрыть всплывающее окно.
     */
    $.hideLoader = function () {

        /**
         * Если в настоящий момент не выполняются AJAX-запросы.
         */
        if ($.active === 0) {
            $('#header .hi-spinner > div').hide();
        }
    };

    /**
     * Показать всплывающее окно.
     * @param params
     * @param template
     */
    $.showActionPopup = function (params, template) {

        var rendered = false;

        if (params.modal.el && params.modal.el.length) {

            if (typeof template === 'string') {
                params.modal.el.find('.modal-content').html(function () {
                    rendered = true;
                    return template;
                });
            } else if (params.type === 'loaded' && params.modal.template) {
                params.modal.el.find('.modal-content').html(function () {
                    rendered = true;
                    return params.modal.template;
                });
            }

            if (rendered && params.modal.el.find('form').length) {
                params.modal.el.find('form')
                    .data('params', params)
                    .trigger('reanimate');
            }

            params.modal.el.modal('show');
        }
    };

    /**
     * Скрыть всплывающее окно.
     * @param params
     * @param template
     */
    $.hideActionPopup = function (params, template) {

        if (params.modal.el && params.modal.el.length) {

            if (typeof template === 'string') {
                params.modal.el.find('.modal-content').html(function () {
                    return template;
                });
            }

            params.modal.el.modal('hide');
        }
    };

    /**
     * Заблокировать объект, который инициировал действие.
     * @param params
     */
    $.lockActionTarget = function (params) {

        if (params.target.el.length) {
            params.target.el.attr('disabled', true);
        }

        if (params.target.icon.el.length) {

            if (params.target.icon.class) {
                params.target.icon.el.removeClass(params.target.icon.class);
            }

            if (params.target.icon.color) {
                params.target.icon.el.removeClass(params.target.icon.color);
            }

            if (params.target.icon.progressClass) {
                params.target.icon.el.addClass(params.target.icon.progressClass);
            }

            if (params.target.icon.progressColors) {
                params.target.icon.el.addClass(params.progressColor);
            }
        }
    };

    /**
     * Разблокировать объект, который инициировал действие.
     * @param params
     */
    $.unlockActionTarget = function (params) {

        if (params.target.el.length) {
            params.target.el.attr('disabled', false);
        }

        if (params.target.icon.el.length) {

            if (params.target.icon.class) {
                params.target.icon.el.addClass(params.target.icon.class);
            }

            if (params.target.icon.color) {
                params.target.icon.el.addClass(params.target.icon.color);
            }

            if (params.target.icon.progressClass) {
                params.target.icon.el.removeClass(params.target.icon.progressClass);
            }

            if (params.target.icon.progressColors) {
                params.target.icon.el.removeClass(eventData.progressColor);
            }
        }
    };

    /**
     * Показать уведомления.
     * @param response
     * @param params
     */
    $.showActionNotifications = function (response, params) {

        if (response) {

            if (response.success) {
                notify(response.success, 'success');
            }

            if (response.errors) {

                if (response.message) {
                    notify(response.message, 'danger');
                }

                if (params.form.el.length) {
                    params.form.el.errors(response.errors);
                }

            } else {

                if (response.message) {
                    notify(response.message, 'info');
                }
            }
        }
    };

    /**
     * Показать ошибки валидации полей.
     * @param response
     * @param params
     */
    $.showFormErrors = function (response, params) {

        if (response) {

            if (response.errors) {

                if (params.form.el.length) {
                    params.form.el.errors(response.errors);
                }

            }
        }
    };

    /**
     * Сбросить ошибки валидации полей.
     * @param response
     * @param params
     */
    $.hideFormErrors = function (params) {

        if (params.form.el.length) {
            params.form.el.errors();
        }
    };

    /**
     * Обновить таблицу.
     * @param response
     * @param params
     */
    $.updateActionDataTable = function (response, params) {

        /**
         * Было ли произведено удаление ресурса. По-умолчанию: нет.
         * @type {boolean}
         */
        var wasTrashed = false,
            wasForced = false,
            wasRestored = false;

        /**
         * Если была отправлена форма удаления ресурса.
         */
        switch (params.resource.action) {
            case 'trash':
                wasTrashed = true;
                break;
            case 'restore':
                wasRestored = true;
                break;
            case 'destroy':
                wasTrashed = true;
                wasForced = true;
                break;
        }

        if (params.table.el.length) {

            if (params.table.row.length) {

                /**
                 * Пометим строку как удаленную.
                 */
                if (wasTrashed) {
                    params.table.row.attr('data-trashed', 'true');
                }

                if (wasRestored) {
                    params.table.row.attr('data-trashed', 'false');
                }
            }

            if (params.table.dt) {

                if (wasTrashed || wasRestored) {

                    /**
                     * Если ресурс был удален окончательно, то удалим строку из таблицы.
                     */
                    if (wasForced) {

                        /**
                         * Если конечно удалось определить строку.
                         */
                        if (params.table.row.length) {
                            params.table.dt.row(params.table.row).remove().draw(false);
                        } else {
                            params.table.dt.draw(false);
                        }
                    }
                } else {

                    /**
                     * Если ресурс был обновлен, а не удален, то обновим таблицу.
                     */
                    params.table.dt.draw(false);
                }
            }
        }
    };

    /**
     * Включить отладку
     */
    $.actionDebug = false;

    /**
     * Функции извлечения атрибутов выполняемых действий.
     */
    $.actionCrawler = {

        /**
         * Тип действия: всплывающее окно или отправка формы.
         */
        type: function () {
            var modal = $.actionCrawler.modal.el.call(this);

            if (modal && modal.length) {
                return 'loaded';
            }

            return 'submitted';
        },

        /**
         * Информация о ресурсе.
         */
        resource: {

            /**
             * Название ресурса.
             */
            name: function () {
                return this.data('resource');
            },

            /**
             * Выполняемое действие.
             */
            action: function () {
                return this.data('action');
            },
        },

        /**
         * Параметры запроса, который необходимо выполнить.
         */
        request: {

            /**
             * URL-адрес действия
             */
            url: function () {
                return this.data('url') || this.attr('href');
            },

            /**
             * CSRF-токен
             */
            token: function () {
                return this.data('token') || $('meta[name="csrf-token"]').attr('content');
            },

            /**
             * Метод запроса
             */
            method: function () {
                var method = this.data('method');

                if (method) {
                    return method.toLowerCase();
                }

                return 'get';
            },

            /**
             * Данные
             */
            data: function () {
                var type = $.actionCrawler.type.call(this),
                    form = $.actionCrawler.form.el.call(this),
                    token = $.actionCrawler.request.token.call(this),
                    method = $.actionCrawler.request.method.call(this),
                    postParams = {_method: method, _token: token},
                    params = this.data('params') || {};

                if (type === 'submitted') {
                    if (form && form.length) {
                        switch (method) {
                            case 'get':
                                return form.serialize();
                            default:
                                return new window.FormData(form.get(0));
                        }
                    }
                }

                switch (method) {
                    case 'get':
                        return $.param($.extend({}, params));
                    default:
                        return $.extend({}, postParams, params);
                }
            },

            /**
             * Тип возвращаемых данных от сервера.
             */
            type: function () {
                var type = $.actionCrawler.type.call(this);

                return type === 'loaded' ? 'html' : 'json';
            },
        },

        /**
         * Объект, который инициировал действие.
         */
        target: {

            /**
             * Элемент DOM
             */
            el: function () {
                return this;
            },

            /**
             * Иконка объекта target (если присутствует)
             */
            icon: {

                /**
                 * Элемент DOM
                 */
                el: function () {
                    return this.find('i');
                },

                /**
                 * Название класса значка иконки, например "zmdi-time".
                 */
                class: function () {
                    return this.data('icon-class');
                },

                /**
                 * Название класса/ов цвета иконки, например "c-green" или "bgm-red c-white".
                 */
                color: function () {
                    return this.data('color-class');
                },

                /**
                 * Название класса/ов значка иконки в состоянии загрузки, например "zmdi-refresh zmdi-hc-spin".
                 */
                progressClass: function () {
                    return this.data('progress-icon-class');
                },

                /**
                 * Название класса/ов цвета иконки в состоянии загрузки, например "c-gray".
                 */
                progressColor: function () {
                    return this.data('progress-color-class');
                },
            },
        },

        /**
         * Всплывающее окно, которое необходимо будет отобразить (если присутствует).
         */
        modal: {

            /**
             * Элемент DOM
             */
            el: function () {
                var resource = $.actionCrawler.resource.name.call(this),
                    action = $.actionCrawler.resource.action.call(this);

                if (resource && action) {
                    return $('[data-role="modal"][data-action="' + action + '"][data-resource="' + resource + '"]');
                }

                return null;
            },

            /**
             * Шаблон содержимого для замены.
             */
            template: function () {
                var resource = $.actionCrawler.resource.name.call(this),
                    action = $.actionCrawler.resource.action.call(this);

                if (resource && action) {
                    return $('[data-role="template"][data-action="' + action + '"][data-resource="' + resource + '"]').html();
                }

                return null;
            },
        },

        /**
         * Форма, которую необходимо отправить (если присутствует).
         */
        form: {

            /**
             * Элемент DOM
             */
            el: function () {
                var modal = $.actionCrawler.modal.el.call(this);

                if (modal) {
                    return modal.find('form');
                }

                return this.closest('form');
            },
        },

        /**
         * Таблица, из которой было выполнено действие (если присутствует).
         */
        table: {

            /**
             * Элемент DOM
             */
            el: function () {
                return this.closest('.dataTables_wrapper').find('table');
            },

            /**
             * DataTable API
             */
            dt: function () {
                var table = $.actionCrawler.table.el.call(this);

                if (table.length) {
                    return table.DataTable();
                }

                return null;
            },

            /**
             * Строка, из которой было выполнено действие.
             */
            row: function () {
                var table = $.actionCrawler.table.el.call(this);

                if (table.length && table.hasClass('responsive') && table.hasClass('collapsed')) {
                    return this.closest('tr').prev('[role="row"]');
                }

                return this.closest('tr');
            },

            /**
             * Столбец, из которого было выполнено действие.
             */
            column: function () {
                return this.closest('td');
            }
        },

        /**
         * Дополнительные параметры
         */
        extra: function () {
            return {};
        },
    };

    /**
     * Функции извлечения атрибутов выполняемых действий.
     */
    $.actionFormCrawler = {

        /**
         * Тип действия: всплывающее окно или отправка формы.
         */
        type: function () {
            var method = $.actionFormCrawler.request.method.call(this);

            return method === 'get' ? 'loaded' : 'submitted';
        },

        /**
         * Информация о ресурсе.
         */
        resource: {

            /**
             * Название ресурса.
             */
            name: function () {
                return this.data('resource');
            },

            /**
             * Выполняемое действие.
             */
            action: function () {
                return this.data('action');
            },
        },

        /**
         * Параметры запроса, который необходимо выполнить.
         */
        request: {

            /**
             * URL-адрес действия
             */
            url: function () {
                return this.attr('action');
            },

            /**
             * CSRF-токен
             */
            token: function () {
                return this.find('[name="_token"]').val() || $('meta[name="csrf-token"]').attr('content');
            },

            /**
             * Метод запроса
             */
            method: function () {
                var method = this.find('[name="_method"]').val() || this.attr('method');

                if (method) {
                    return method.toLowerCase();
                }

                return 'get';
            },

            /**
             * Данные
             */
            data: function () {
                var method = $.actionFormCrawler.request.method.call(this);

                switch (method) {
                    case 'get':
                        return this.serialize();
                    default:
                        return new window.FormData(this.get(0));
                }
            },

            /**
             * Тип возвращаемых данных от сервера.
             */
            type: function () {
                var type = $.actionFormCrawler.type.call(this);

                return type === 'loaded' ? 'html' : 'json';
            },
        },

        /**
         * Объект, который инициировал действие.
         */
        target: {

            /**
             * Элемент DOM
             */
            el: function () {
                return this.find('[type="submit"]');
            },

            /**
             * Иконка объекта target (если присутствует)
             */
            icon: {

                /**
                 * Элемент DOM
                 */
                el: function () {
                    var target = $.actionFormCrawler.target.el.call(this);

                    return target.find('i');
                },

                /**
                 * Название класса значка иконки, например "zmdi-time".
                 */
                class: function () {
                    var target = $.actionFormCrawler.target.el.call(this);

                    return target.data('icon-class');
                },

                /**
                 * Название класса/ов цвета иконки, например "c-green" или "bgm-red c-white".
                 */
                color: function () {
                    var target = $.actionFormCrawler.target.el.call(this);

                    return target.data('color-class');
                },

                /**
                 * Название класса/ов значка иконки в состоянии загрузки, например "zmdi-refresh zmdi-hc-spin".
                 */
                progressClass: function () {
                    var target = $.actionFormCrawler.target.el.call(this);

                    return target.data('progress-icon-class');
                },

                /**
                 * Название класса/ов цвета иконки в состоянии загрузки, например "c-gray".
                 */
                progressColor: function () {
                    var target = $.actionFormCrawler.target.el.call(this);

                    return target.data('progress-color-class');
                },
            },
        },

        /**
         * Форма, которую необходимо отправить (если присутствует).
         */
        form: {

            /**
             * Элемент DOM
             */
            el: function () {
                return this;
            },
        },

        /**
         * Дополнительные параметры
         */
        extra: function () {
            return {};
        },
    };

    $.fn.prepareActionFormParams = function (params, crawler) {

        var actionCrawler = $.extend({}, $.actionFormCrawler, crawler || {}),
            formParams = this.data('params'),
            defaultParams = {

                /**
                 * Тип действия: всплывающее окно или отправка формы.
                 */
                type: actionCrawler.type.call(this),

                /**
                 * Информация о ресурсе.
                 */
                resource: {

                    /**
                     * Название ресурса.
                     */
                    name: actionCrawler.resource.name.call(this),

                    /**
                     * Выполняемое действие.
                     */
                    action: actionCrawler.resource.action.call(this),
                },

                /**
                 * Параметры запроса, который необходимо выполнить.
                 */
                request: {

                    /**
                     * URL-адрес действия
                     */
                    url: actionCrawler.request.url.call(this),

                    /**
                     * CSRF-токен
                     */
                    token: actionCrawler.request.token.call(this),

                    /**
                     * Метод запроса
                     */
                    method: actionCrawler.request.method.call(this),

                    /**
                     * Данные
                     */
                    data: actionCrawler.request.data.call(this),

                    /**
                     * Тип возвращаемых данных от сервера.
                     */
                    type: actionCrawler.request.type.call(this),
                },

                /**
                 * Объект, который инициировал действие.
                 */
                target: {

                    /**
                     * Элемент DOM
                     */
                    el: actionCrawler.target.el.call(this),

                    /**
                     * Иконка объекта target (если присутствует)
                     */
                    icon: {

                        /**
                         * Элемент DOM
                         */
                        el: actionCrawler.target.icon.el.call(this),

                        /**
                         * Название класса значка иконки, например "zmdi-time".
                         */
                        class: actionCrawler.target.icon.class.call(this),

                        /**
                         * Название класса/ов цвета иконки, например "c-green" или "bgm-red c-white".
                         */
                        color: actionCrawler.target.icon.color.call(this),

                        /**
                         * Название класса/ов значка иконки в состоянии загрузки, например "zmdi-refresh zmdi-hc-spin".
                         */
                        progressClass: actionCrawler.target.icon.progressClass.call(this),

                        /**
                         * Название класса/ов цвета иконки в состоянии загрузки, например "c-gray".
                         */
                        progressColor: actionCrawler.target.icon.progressColor.call(this),
                    },
                },

                /**
                 * Форма, которую необходимо отправить (если присутствует).
                 */
                form: {

                    /**
                     * Элемент DOM
                     */
                    el: actionCrawler.form.el.call(this),
                },

                /**
                 * Дополнительные параметры
                 */
                extra: actionCrawler.extra.call(this),
            };

        return $.extend({}, formParams, defaultParams, params || {});
    };

    $.fn.prepareActionParams = function (params, crawler) {

        var actionCrawler = $.extend({}, $.actionCrawler, crawler || {}),
            defaultParams = {

                /**
                 * Тип действия: всплывающее окно или отправка формы.
                 */
                type: actionCrawler.type.call(this),

                /**
                 * Информация о ресурсе.
                 */
                resource: {

                    /**
                     * Название ресурса.
                     */
                    name: actionCrawler.resource.name.call(this),

                    /**
                     * Выполняемое действие.
                     */
                    action: actionCrawler.resource.action.call(this),
                },

                /**
                 * Параметры запроса, который необходимо выполнить.
                 */
                request: {

                    /**
                     * URL-адрес действия
                     */
                    url: actionCrawler.request.url.call(this),

                    /**
                     * CSRF-токен
                     */
                    token: actionCrawler.request.token.call(this),

                    /**
                     * Метод запроса
                     */
                    method: actionCrawler.request.method.call(this),

                    /**
                     * Данные
                     */
                    data: actionCrawler.request.data.call(this),

                    /**
                     * Тип возвращаемых данных от сервера.
                     */
                    type: actionCrawler.request.type.call(this),
                },

                /**
                 * Объект, который инициировал действие.
                 */
                target: {

                    /**
                     * Элемент DOM
                     */
                    el: actionCrawler.target.el.call(this),

                    /**
                     * Иконка объекта target (если присутствует)
                     */
                    icon: {

                        /**
                         * Элемент DOM
                         */
                        el: actionCrawler.target.icon.el.call(this),

                        /**
                         * Название класса значка иконки, например "zmdi-time".
                         */
                        class: actionCrawler.target.icon.class.call(this),

                        /**
                         * Название класса/ов цвета иконки, например "c-green" или "bgm-red c-white".
                         */
                        color: actionCrawler.target.icon.color.call(this),

                        /**
                         * Название класса/ов значка иконки в состоянии загрузки, например "zmdi-refresh zmdi-hc-spin".
                         */
                        progressClass: actionCrawler.target.icon.progressClass.call(this),

                        /**
                         * Название класса/ов цвета иконки в состоянии загрузки, например "c-gray".
                         */
                        progressColor: actionCrawler.target.icon.progressColor.call(this),
                    },
                },

                /**
                 * Всплывающее окно, которое необходимо будет отобразить (если присутствует).
                 */
                modal: {

                    /**
                     * Элемент DOM
                     */
                    el: actionCrawler.modal.el.call(this),

                    /**
                     * Шаблон содержимого для замены.
                     */
                    template: actionCrawler.modal.template.call(this),
                },

                /**
                 * Форма, которую необходимо отправить (если присутствует).
                 */
                form: {

                    /**
                     * Элемент DOM
                     */
                    el: actionCrawler.form.el.call(this),
                },

                /**
                 * Таблица, из которой было выполнено действие (если присутствует).
                 */
                table: {

                    /**
                     * Элемент DOM
                     */
                    el: actionCrawler.table.el.call(this),

                    /**
                     * DataTable API
                     */
                    dt: actionCrawler.table.dt.call(this),

                    /**
                     * Строка, из которой было выполнено действие.
                     */
                    row: actionCrawler.table.row.call(this),

                    /**
                     * Столбец, из которого было выполнено действие.
                     */
                    column: actionCrawler.table.column.call(this),
                },

                /**
                 * Дополнительные параметры
                 */
                extra: actionCrawler.extra.call(this),
            };

        return $.extend({}, defaultParams, params || {});
    };

    /**
     * Запустить обработчики действий в зависимости от состояния.
     * @param state
     * @param type
     * @param params
     * @param response
     */
    $.fn.triggerActionHandlers = function (state, type, params, response) {

        var action = 'modal.' + type + '.' + state,
            data;

        switch (state) {
            case 'success':
            case 'error':
                data = [response, params];
                break;
            default:
                data = [params];
                break;
        }

        if ($.actionDebug) {
            console.log(action, data);
        }

        $(document).trigger(action, data);
    };

    /**
     * Отобразить ошибки валидации на форме.
     * @param errors
     */
    $.fn.errors = function (errors) {

        /**
         * Для всех форм
         */
        this.each(function () {

            /**
             * Для всех секций
             */
            $(this).find('.form-group').each(function () {
                var $group = $(this),
                    hasError = false;

                /**
                 * Для всех полей
                 */
                $group.find('.form-control[name]').each(function () {
                    var $field = $(this),
                        name = this.name.replace(/\[[^\]]*]/, '');

                    $field.find('+ .text-danger').remove();

                    if (errors) {

                        if (errors.hasOwnProperty(name)) {
                            hasError = true;

                            $field.after(
                                $('<div/>').addClass('text-danger').text(errors[name])
                            );
                        }

                    }
                });

                if (hasError === true) {
                    $group.addClass('has-error');
                } else {
                    $group.removeClass('has-error');
                }
            });
        });
    };

    /**
     * Обработка вызова действия.
     */
    $.fn.processAction = function (params, type, crawler) {
        var initiator = this,
            actionParams,
            actionType,
            isFormData;

        if (initiator.is('form')) {
            actionParams = initiator.prepareActionFormParams(params || {}, crawler || {});
        } else {
            actionParams = initiator.prepareActionParams(params || {}, crawler || {});
        }

        actionType = type || actionParams.type;
        isFormData = actionParams.request.data instanceof FormData;

        initiator.triggerActionHandlers('ajax', actionType, actionParams);

        $.ajax({
            method: actionParams.request.method === 'get' ? 'get' : 'post',
            url: actionParams.request.url,
            data: actionParams.request.data,
            dataType: actionParams.request.type,
            processData: !isFormData,
            contentType: isFormData ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
            cache: false,
            success: function (response, status, jqXHR) {
                initiator.triggerActionHandlers('success', actionType, actionParams, response);
            },
            error: function (response) {
                initiator.triggerActionHandlers('error', actionType, actionParams, response.responseJSON || response);
            },
            complete: function (jqXHR, status) {
                initiator.triggerActionHandlers('complete', actionType, actionParams);
            }
        });
    };

    /**
     * Показать загрузчик при выволнении ajax запросов.
     */
    $(document).ajaxStart(function () {
        $.showLoader();
    });

    /**
     * Скрыть загрузчик при завершении ajax запросов.
     */
    $(document).ajaxStop(function () {
        $.hideLoader();
    });

    /**
     * Обработчики событий результатов загрузки форм модальных окон.
     */
    $(document).on('modal.loaded.ajax', function (e, params) {

        if (e.isPropagationStopped() === false) {

            $.showActionPopup(params);

            $.lockActionTarget(params);
        }
    });

    $(document).on('modal.loaded.success', function (e, response, params) {

        if (e.isPropagationStopped() === false) {

            $.showActionPopup(params, response);

            $.showActionNotifications(response, params);
        }
    });

    $(document).on('modal.loaded.error', function (e, response, params) {

        if (e.isPropagationStopped() === false) {

            $.hideActionPopup(params);

            $.hideFormErrors(params);

            $.showActionNotifications(response, params);
        }
    });

    $(document).on('modal.loaded.complete', function (e, params) {

        if (e.isPropagationStopped() === false) {

            $.unlockActionTarget(params);
        }
    });

    /**
     * Обработчики событий результатов отправки форм модальных окон.
     */
    $(document).on('modal.submitted.ajax', function (e, params) {

        if (e.isPropagationStopped() === false) {

            $.hideActionPopup(params);

            $.hideFormErrors(params);

            $.lockActionTarget(params);
        }
    });

    $(document).on('modal.submitted.success', function (e, response, params) {

        if (e.isPropagationStopped() === false) {

            $.hideActionPopup(params, '');

            $.updateActionDataTable(response, params);

            $.showActionNotifications(response, params);
        }
    });

    $(document).on('modal.submitted.error', function (e, response, params) {

        if (e.isPropagationStopped() === false) {

            $.showActionPopup(params);

            $.showActionNotifications(response, params);

            $.showFormErrors(response, params);
        }
    });

    $(document).on('modal.submitted.complete', function (e, params) {

        if (e.isPropagationStopped() === false) {

            $.unlockActionTarget(params)
        }

    });

    /**
     * Обработчик отправки форм из модальных окон.
     */
    $(document).on('submit', '[data-role="modal"] form', function (e) {

        e.preventDefault();

        $(this).processAction();
    });

    $(document).on('click', '[data-role="modal"] [type="submit"][data-action]', function (e) {

        e.preventDefault();

        if (e.isPropagationStopped() === false) {

            $(this).closest('[data-role="modal"]').find('.form-container form').trigger('submit');
        }
    });

    $(document).on('click', '[data-role="action"][data-action="create"]', function (e) {

        e.preventDefault();

        $(this).processAction();
    });

    $(document).on('click', '[data-role="action"][data-action="show"]', function (e) {

        e.preventDefault();

        $(this).processAction();
    });

    $(document).on('click', '[data-role="action"][data-action="edit"]', function (e) {

        e.preventDefault();

        $(this).processAction();
    });

    $(document).on('click', '[data-role="action"][data-action="trash"]', function (e) {

        e.preventDefault();

        $(this).processAction();
    });

    $(document).on('click', '[data-role="action"][data-action="restore"]', function (e) {

        e.preventDefault();

        $(this).processAction();
    });

    $(document).on('click', '[data-role="action"][data-action="destroy"]', function (e) {

        e.preventDefault();

        $(this).processAction();
    });

})(jQuery);
