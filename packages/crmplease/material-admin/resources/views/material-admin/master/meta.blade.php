<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}?ver={{ config('app.version') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('favicon.ico') }}?ver={{ config('app.version') }}" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('vendor/material-admin/css/material-admin.css') }}?ver={{ config('app.version') }}">

@hasSection('head')
    @yield('head')
@endif
