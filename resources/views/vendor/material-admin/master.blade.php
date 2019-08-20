<!doctype html>
<!--[if lt IE 7]>
<html lang="{{ config('app.locale') }}" class="ie6" data-locale="{{ config('app.locale') }}" data-ma-theme="{{ config('app.theme') }}"> <![endif]-->
<!--[if IE 7]>
<html lang="{{ config('app.locale') }}" class="ie7" data-locale="{{ config('app.locale') }}" data-ma-theme="{{ config('app.theme') }}"> <![endif]-->
<!--[if IE 8]>
<html lang="{{ config('app.locale') }}" class="ie8" data-locale="{{ config('app.locale') }}" data-ma-theme="{{ config('app.theme') }}"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ config('app.locale') }}" class="ie9" data-locale="{{ config('app.locale') }}" data-ma-theme="{{ config('app.theme') }}"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="{{ config('app.locale') }}" data-locale="{{ config('app.locale') }}" data-locale-name="{{ config('app.locale_name') }}" data-ma-theme="{{ config('app.theme') }}">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="{{ asset('vendor/material-admin/css/material-admin.css') }}?ver={{ config('app.version') }}">

    @hasSection('head')
        @yield('head')
    @endif

    <title>
        @hasSection('page-title')
            @yield('page-title')
        @else
            @if(resource_name() && resource_action())
                {{ config('app.name') }} &ndash; {{ trans(sprintf('models/%s.%s.title', resource_name(), resource_action())) }}
            @else
                {{ config('app.name') }}
            @endif
        @endif
    </title>
</head>
<body>

@include('material-admin::master.header')

<section id="main">

    @include('material-admin::master.sections.sidebar')

    <section class="{{ isset($content_classes) && $content_classes ? $content_classes : 'content-alt' }}" id="content">

        <div class="{{ isset($container_classes) && $container_classes ? $container_classes : 'container' }}">

            @hasSection('before-card')
                @yield('before-card')
            @endif

            @hasSection('content')
                @yield('content')
            @else
                <div class="card">

                    @hasSection('card-title')
                        <div class="card-header">
                            <h2>@yield('card-title')
                                @hasSection('card-subtitle')
                                    <small>@yield('card-subtitle')</small>
                                @endif
                            </h2>
                        </div>
                    @endif

                    @hasSection('card-body')
                        <div class="card-body card-padding">
                            @yield('card-body')
                        </div>
                    @endif

                    @hasSection('card-content')
                        @yield('card-content')
                    @endif

                </div>
            @endif

            @hasSection('after-card')
                @yield('after-card')
            @endif

        </div>

    </section>

    @include('material-admin::master.footer')

</section>

@include('material-admin::master.page-loader')
@include('material-admin::master.ie-warning')
@include('material-admin::master.scripts')

</body>
</html>
