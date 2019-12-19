<ul class="actions text-center">
    @foreach($actions as $action => $attributes)
        @php($resource = $attributes['resource'] ?? resource_name())
        @isset($attributes['actions'])
            <li class="dropdown">
                <a href="{{ $attributes['url'] ?? '#' }}" data-toggle="dropdown" aria-expanded="false"
                   data-role="action"
                   data-action="{{ $action }}"
                   data-resource="{{ $resource }}"
                   data-url="{{ $attributes['url'] ?? '#' . $action }}"
                   data-ajax="{{ $attributes['ajax'] ?? false ? 'true' : 'false' }}"
                   data-method="{{ $attributes['method'] ?? 'get'}}"
                   data-token="{{ csrf_token() }}"
                   data-icon-class="zmdi-{{ $attributes['icon'] ?? 'more-vert' }}"
                   data-color-class="c-{{ $attributes['color'] ?? 'gray' }}">
                    <i class="zmdi zmdi-{{ $attributes['icon'] ?? 'more-vert' }} c-{{ $attributes['color'] ?? 'gray' }}"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    @foreach($attributes['actions'] as $action => $attributes)
                        <li>
                            <a href="{{ $attributes['url'] ?? '#' . $action }}"
                               target="{{ $attributes['target'] ?? '_self' }}"
                               data-role="action"
                               data-action="{{ $action }}"
                               data-resource="{{ $resource }}"
                               data-url="{{ $attributes['url'] ?? '#' . $action }}"
                               data-ajax="{{ $attributes['ajax'] ?? false ? 'true' : 'false' }}"
                               data-method="{{ $attributes['method'] ?? 'get' }}"
                               data-token="{{ csrf_token() }}">
                                {{ $attributes['title'] ?? $action }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="{{ sprintf('column-action column-action-%s', $action) }}">
                <a href="{{ $attributes['url'] ?? '#' . $action }}" title="{{ $attributes['title'] }}"
                   target="{{ $attributes['target'] ?? '_self' }}"
                   data-role="action"
                   data-action="{{ $action }}"
                   data-resource="{{ $resource }}"
                   data-url="{{ $attributes['url'] ?? '#' . $action }}"
                   data-ajax="{{ $attributes['ajax'] ?? false ? 'true' : 'false' }}"
                   data-method="{{ $attributes['method'] ?? 'get' }}"
                   data-token="{{ csrf_token() }}"
                   data-icon-class="zmdi-{{ $attributes['icon'] ?? 'edit' }}"
                   data-color-class="c-{{ $attributes['color'] ?? 'primary' }}"
                   data-progress-icon-class="zmdi-{{ $attributes['progress-icon'] ?? 'spinner zmdi-hc-spin' }}"
                   data-progress-color-class="c-{{ $attributes['progress-color'] ?? 'gray'}}">
                    <i class="zmdi zmdi-{{ $attributes['icon'] ?? 'edit' }} c-{{ $attributes['color'] ?? 'primary' }}"></i>
                </a>
            </li>
        @endisset
    @endforeach
</ul>
