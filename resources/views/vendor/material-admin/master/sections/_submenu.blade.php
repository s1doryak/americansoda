@if ($admin === false || (Auth::check() && (Auth::user()->hasRole('master') || Auth::user()->hasRole('admin'))))
    <li class="sub-menu{{ ($active ? ' toggled' : '') }}">
        <a href="#">{!! trans($title) !!}</a>
        <ul style="{{ ($active ? 'display: block' : '') }}">
            @foreach($resources as $resource)
                @php($resource = (array) $resource)
                @if (!isset($resource[1]) || (Auth::check() && (Auth::user()->hasRole($resource[1]))))
                    <li>
                        {!! link_to_route(
                            sprintf('%s.%s.index', prefix_name(), $resource[0]),
                            trans(sprintf('models/%s.labels.plural', $resource[0])),
                            [],
                            ['class' => resource_name() == $resource[0] ? 'active' : '']
                        ) !!}
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
@endif