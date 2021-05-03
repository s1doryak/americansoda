@extends('material-admin::master')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/dashboard.css') }}?ver={{ config('app.version') }}">
@stop

@section('header-menu')
    <li class="hidden-xs">
        <a href="{{ route('dashboard.calendar') }}">
            <span class="him-label">
                <i class="zmdi zmdi-calendar zmdi-hc-lg"></i>
                <span class="hidden-xs hidden-md m-l-5">{{ trans('calendar.index.title') }}</span>
            </span>
        </a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer_invoice.index') }}">
            <span class="him-label">
                <i class="zmdi zmdi-file-text zmdi-hc-lg"></i>
                <span class="hidden-xs hidden-md m-l-5">{{ trans('models/customer_invoice.labels.plural') }}</span>
            </span>
        </a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer.index') }}">
            <span class="him-label">
                <i class="zmdi zmdi-accounts-add zmdi-hc-lg"></i>
                <span class="hidden-xs hidden-md m-l-5">{{ trans('models/customer.labels.plural') }}</span>
            </span>
        </a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer_order.index') }}">
            <span class="him-label">
                <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-lg"></i>
                <span class="hidden-xs hidden-md m-l-5">{{ trans('models/customer_order.labels.plural') }}</span>
            </span>
        </a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer_order_item.index') }}">
            <span class="him-label">
                <i class="zmdi zmdi-tune zmdi-hc-lg"></i>
                <span class="hidden-xs hidden-md m-l-5">{{ trans('models/customer_order_item.labels.plural') }}</span>
            </span>
        </a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer_shipment.index') }}">
            <span class="him-label">
                <i class="zmdi zmdi-local-shipping zmdi-hc-lg"></i>
                <span class="hidden-xs hidden-md m-l-5">{{ trans('models/customer_shipment.labels.plural') }}</span>
            </span>
        </a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.assembly.index') }}">
            <span class="him-label">
                <i class="zmdi zmdi-dropbox zmdi-hc-lg"></i>
                <span class="hidden-xs hidden-md m-l-5">{{ trans('models/assembly.labels.plural') }}</span>
            </span>
        </a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.stock_movement_product.index') }}">
            <span class="him-label">
                <i class="zmdi zmdi-swap zmdi-hc-lg"></i>
                <span class="hidden-xs hidden-md m-l-5">{{ trans('models/stock_movement_product.labels.plural') }}</span>
            </span>
        </a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.ltp_transfer.index') }}">
            <span class="him-label">
                <i class="zmdi zmdi-chart zmdi-hc-lg"></i>
                <span class="hidden-xs hidden-md m-l-5">{{ trans('models/ltp_transfer.labels.plural') }}</span>
            </span>
        </a>
    </li>
@stop

@section('scripts')
    @parent
    <script src="{{ asset('assets/dashboard/js/dashboard.js') }}?ver={{ config('app.version') }}"></script>
@stop
