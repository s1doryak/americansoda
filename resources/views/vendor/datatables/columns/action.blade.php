<ul class="actions text-center">
    @foreach($actions as $action => $attributes)
        @if(isset($attributes['actions']))
            <li class="dropdown">
                <a href="{{ $attributes['url'] }}"  data-toggle="dropdown" aria-expanded="false" data-token="{{ csrf_token() }}" data-action="{{ $action }}" data-url="{{ $attributes['url'] }}" data-icon-class="zmdi-{{ $attributes['icon'] }}" data-color-class="c-{{ $attributes['color'] }}">
                    <i class="zmdi zmdi-{{ $attributes['icon'] }} c-{{ $attributes['color'] }}"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    @foreach($attributes['actions'] as $action => $attributes)
                    <li>
                        <a href="{{ $attributes['url'] }}">{{ $attributes['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="{{ sprintf('column-action column-action-%s', $action) }}">
                <a href="{{ $attributes['url'] }}" title="{{ $attributes['title'] }}" target="{{ isset($attributes['target']) ? $attributes['target'] : '_self' }}" data-token="{{ csrf_token() }}" data-action="{{ $action }}" data-url="{{ $attributes['url'] }}" data-icon-class="zmdi-{{ $attributes['icon'] }}" data-color-class="c-{{ $attributes['color'] }}">
                    <i class="zmdi zmdi-{{ $attributes['icon'] }} c-{{ $attributes['color'] }}"></i>
                </a>
            </li>
        @endif
    @endforeach
</ul>