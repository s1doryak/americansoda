@if(config('app.logo'))
    <li class="hi-logo">
        @if(has_route(prefix_name()))
            <a href="{{ route(prefix_name()) }}">
                <div class="hidden-xs">
                    <img src="{{ asset(config('app.logo')) }}?ver={{ config('app.version') }}" alt="{{ config('app.name') }}">
                </div>
                <div class="visible-xs">
                    <img src="{{ asset(config('app.icon')) }}?ver={{ config('app.version') }}" alt="{{ config('app.name') }}">
                </div>
            </a>
        @else
            <div class="hidden-xs">
                <img src="{{ asset(config('app.logo')) }}?ver={{ config('app.version') }}" alt="{{ config('app.name') }}">
            </div>
            <div class="visible-xs">
                <img src="{{ asset(config('app.icon')) }}?ver={{ config('app.version') }}" alt="{{ config('app.name') }}">
            </div>
        @endif
    </li>
@endif
