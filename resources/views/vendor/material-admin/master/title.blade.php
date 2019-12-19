@hasSection('title')
    @yield('title') &ndash; {{ config('app.name') }}
@else
    @if(resource_name() && resource_action())
        {{ trans("models/{resource_name()}.{resource_action()}.title") }} &ndash; {{ config('app.name') }}
    @else
        {{ config('app.name') }}
    @endif
@endif
