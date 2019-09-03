@extends('material-admin::master')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/dashboard.css') }}?ver={{ config('app.version') }}">
@stop

@section('header-menu')

    <li class="hidden-xs">
        <a href="{{ route('dashboard.calendar') }}"><span class="him-label"><i class="zmdi zmdi-calendar zmdi-hc-lg m-r-5"></i> {{ trans('calendar.index.title') }}</span></a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer_invoice.index') }}"><span class="him-label"><i class="zmdi zmdi-file-text zmdi-hc-lg m-r-5"></i> {{ trans('models/customer_invoice.labels.plural') }}</span></a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer.index') }}"><span class="him-label"><i class="zmdi zmdi-accounts-add zmdi-hc-lg m-r-5"></i> {{ trans('models/customer.labels.plural') }}</span></a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer_order.index') }}"><span class="him-label"><i class="zmdi zmdi-shopping-cart-plus zmdi-hc-lg m-r-5"></i> {{ trans('models/customer_order.labels.plural') }}</span></a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer_order_item.index') }}"><span class="him-label"><i class="zmdi zmdi-tune zmdi-hc-lg m-r-5"></i> {{ trans('models/customer_order_item.labels.plural') }}</span></a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.customer_shipment.index') }}"><span class="him-label"><i class="zmdi zmdi-local-shipping zmdi-hc-lg m-r-5"></i> {{ trans('models/customer_shipment.labels.plural') }}</span></a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.assembly.index') }}"><span class="him-label"><i class="zmdi zmdi-dropbox zmdi-hc-lg m-r-5"></i> {{ trans('models/assembly.labels.plural') }}</span></a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.stock_movement_product.index') }}"><span class="him-label"><i class="zmdi zmdi-swap zmdi-hc-lg m-r-5"></i> {{ trans('models/stock_movement_product.labels.plural') }}</span></a>
    </li>
    <li class="hidden-xs">
        <a href="{{ route('dashboard.stock_product.index') }}"><span class="him-label"><i class="zmdi zmdi-chart zmdi-hc-lg m-r-5"></i> {{ trans('models/stock_product.labels.plural') }}</span></a>
    </li>

    <li class="dropdown">
        <a data-toggle="dropdown" href=""><i class="him-icon zmdi zmdi-more-vert"></i></a>
        <ul class="dropdown-menu dm-icon pull-right">
            <li class="skin-switch">
                <span class="ss-skin bgm-red" data-ma-action="change-skin" data-ma-skin="red"></span>
                <span class="ss-skin bgm-bluegray" data-ma-action="change-skin" data-ma-skin="bluegray"></span>
                <span class="ss-skin bgm-teal" data-ma-action="change-skin" data-ma-skin="teal"></span>
                <span class="ss-skin bgm-orange" data-ma-action="change-skin" data-ma-skin="orange"></span>
                <span class="ss-skin bgm-blue" data-ma-action="change-skin" data-ma-skin="blue"></span>
            </li>
            <li class="divider hidden-xs"></li>
            <li class="hidden-xs">
                <a data-ma-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> {{ trans('header.actions.toggle_fullscreen') }}</a>
            </li>
            <li>
                <a data-ma-action="clear-localstorage" href=""><i class="zmdi zmdi-delete"></i> {{ trans('header.actions.clear_localstorage') }}</a>
            </li>
        </ul>
    </li>
@stop

@section('scripts')
    @parent
    <script src="{{ asset('assets/dashboard/js/dashboard.js') }}?ver={{ config('app.version') }}"></script>
@stop
