<li class="sub-menu{{ ($active ? ' toggled' : '') }}">
    <a href="#">{!! trans($title) !!}</a>
    <ul style="{{ ($active ? 'display: block' : '') }}">
        @foreach($resources as $resource)
            <li>
                {!! link_to_route(
                    sprintf('%s.%s.index', prefix_name(), $resource),
                    trans(sprintf('models/%s.labels.plural', $resource)),
                    [],
                    ['class' => resource_name() == $resource ? 'active' : '']
                ) !!}
            </li>
        @endforeach
    </ul>
</li>
