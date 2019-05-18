<!doctype html>
<!--[if lt IE 7]>
<html lang="{{ config('app.locale') }}" class="ie6" data-ma-theme="{{ config('app.theme') }}"> <![endif]-->
<!--[if IE 7]>
<html lang="{{ config('app.locale') }}" class="ie7" data-ma-theme="{{ config('app.theme') }}"> <![endif]-->
<!--[if IE 8]>
<html lang="{{ config('app.locale') }}" class="ie8" data-ma-theme="{{ config('app.theme') }}"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ config('app.locale') }}" class="ie9" data-ma-theme="{{ config('app.theme') }}"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="{{ config('app.locale') }}" data-ma-theme="{{ config('app.theme') }}">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="{{ asset('vendor/material-admin/css/material-admin.css') }}">

    @hasSection('head')
        @yield('head')
    @endif

    <title>{{ config('app.name') }}</title>

</head>
<body>
<div class="login-content">
    @yield('content')
</div>

@include('material-admin::master.ie-warning')
@include('material-admin::master.scripts')

</body>
</html>