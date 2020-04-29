<!doctype html>
<html lang="{{ config('app.locale') }}" data-locale="{{ config('locales.' . config('app.locale')) }}" data-ma-theme="{{ config('app.theme') }}" data-env="{{ config('app.env') }}">
<head>
    @include('material-admin::master.meta')
    <title>
        @include('material-admin::master.title')
    </title>
</head>
<body>
<div class="login-content">
    @yield('content')
</div>

@include('material-admin::master.scripts')

</body>
</html>
