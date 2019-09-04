<div class="fg-line">

    <div class="daterangepicker-container" data-filter-container="{{ $filter->name }}">
        <input type="hidden" name="filters[{{ $idx }}][name]" value="{{ $filter->name }}">
        <input type="text" name="filters[{{ $idx }}][value]" value="{{ $filter->default }}" data-filter-name="{{ $filter->name }}" class="form-control input-sm">
    </div>

    @section('scripts')
        @parent
        <script type="text/javascript">
            jQuery(document).ready(function () {

                var selector = '[data-filter-name="{{ $filter->name }}"]';
                var parentSelector = '[data-filter-container="{{ $filter->name }}"]';
                var start = moment().startOf('year');
                var end = moment().endOf('year');

                $(selector).daterangepicker({
                    parentEl: parentSelector,
                    startDate: start,
                    endDate: end,
                    locale: {
                        format: 'DD/MM/YYYY',
                        applyLabel: '{{ trans('material-admin::daterangepicker.labels.apply') }}',
                        cancelLabel: '{{ trans('material-admin::daterangepicker.labels.cancel') }}',
                        weekLabel: '{{ trans('material-admin::daterangepicker.labels.week') }}',
                        customRangeLabel: '{{ trans('material-admin::daterangepicker.labels.custom_range') }}',
                    },
                    ranges: {
                        '{{ trans('material-admin::daterangepicker.ranges.today') }}': [moment(), moment()],
                        '{{ trans('material-admin::daterangepicker.ranges.yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '{{ trans('material-admin::daterangepicker.ranges.this_week') }}': [moment().startOf('week'), moment().endOf('week')],
                        '{{ trans('material-admin::daterangepicker.ranges.last_week') }}': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
                        '{{ trans('material-admin::daterangepicker.ranges.this_month') }}': [moment().startOf('month'), moment().endOf('month')],
                        '{{ trans('material-admin::daterangepicker.ranges.last_month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        '{{ trans('material-admin::daterangepicker.ranges.this_year') }}': [moment().startOf('year'), moment().endOf('year')],
                        '{{ trans('material-admin::daterangepicker.ranges.last_year') }}': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                    }
                });

            });
        </script>
    @stop
</div>
