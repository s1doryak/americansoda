<li class="sub-menu{{ ($active ? ' toggled' : '') }}">
    <a href="#">{!! trans($title) !!}</a>
    <ul style="{{ ($active ? 'display: block' : '') }}">
        @php($prefix = prefix_name())
        @foreach($resources as $resource)
            @if(has_route("{$prefix}.{$resource}.index"))
                <li>
                    {!! link_to_route("{$prefix}.{$resource}.index", trans("models/{$resource}.labels.plural"), [], ['class' => resource_name() === $resource ? 'active' : '']) !!}
                </li>
            @endif
        @endforeach
    </ul>
</li>
