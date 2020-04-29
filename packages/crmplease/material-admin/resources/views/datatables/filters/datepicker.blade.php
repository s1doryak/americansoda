<div class="fg-line">

    <div class="datepicker-container">
        <input type="hidden" name="filters[{{ $idx }}][name]" value="{{ $filter->name }}">
        <input type="text" name="filters[{{ $idx }}][value]" value="{{ $filter->default }}" data-filter-name="{{ $filter->name }}" class="form-control input-sm">
    </div>

    @section('scripts')
        @parent
        <script type="text/javascript">
            jQuery(document).ready(function () {

                var selector = '[data-filter-name="{{ $filter->name }}"]',
                    $input = $(selector);

                $input.daterangepicker({
                    parentEl: $input.parent(),
                    locale: {
                        format: 'DD/MM/YYYY',
                        applyLabel: '{{ trans('material-admin::datepicker.labels.apply') }}',
                        cancelLabel: '{{ trans('material-admin::datepicker.labels.cancel') }}',
                        weekLabel: '{{ trans('material-admin::datepicker.labels.week') }}',
                        customRangeLabel: '{{ trans('material-admin::datepicker.labels.custom_range') }}',
                    },
                    ranges: {
                        '{{ trans('material-admin::datepicker.ranges.today') }}': [moment(), moment()],
                        '{{ trans('material-admin::datepicker.ranges.yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '{{ trans('material-admin::datepicker.ranges.this_week') }}': [moment().startOf('week'), moment().endOf('week')],
                        '{{ trans('material-admin::datepicker.ranges.last_week') }}': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
                        '{{ trans('material-admin::datepicker.ranges.this_month') }}': [moment().startOf('month'), moment().endOf('month')],
                        '{{ trans('material-admin::datepicker.ranges.last_month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        '{{ trans('material-admin::datepicker.ranges.this_year') }}': [moment().startOf('year'), moment().endOf('year')],
                        '{{ trans('material-admin::datepicker.ranges.last_year') }}': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                    }
                });

            });
        </script>
    @stop
</div>
