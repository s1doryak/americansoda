<li class="sub-menu{{ ($active ? ' toggled' : '') }}">
    <a href="#">{!! $title !!}</a>
    <ul style="{{ ($active ? 'display: block' : '') }}">
        @foreach($resources as $url => $label)
            <li>{!! link_to($url, $label, [], []) !!}</li>
        @endforeach
    </ul>
</li>
