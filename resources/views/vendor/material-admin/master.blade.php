<!doctype html>
<html lang="{{ config('app.locale') }}" data-locale="{{ config('locales.' . config('app.locale')) }}" data-ma-theme="{{ config('app.theme') }}" data-env="{{ config('app.env') }}">
<head>
    @include('material-admin::master.meta')
    <title>
        @include('material-admin::master.title')
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
@include('material-admin::master.modals')
@include('material-admin::master.scripts')

</body>
</html>
