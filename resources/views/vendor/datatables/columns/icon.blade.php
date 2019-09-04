@if($icon)
    @if(Str::startsWith($color, 'c-'))
        <i class="zmdi zmdi-{{ Str::replaceFirst('zmdi-', '', $icon) }} {{ implode(' ', $classes) }} {{ $color }}"></i>
    @else
        <i class="zmdi zmdi-{{ Str::replaceFirst('zmdi-', '', $icon) }} {{ implode(' ', $classes) }}" style="color: {{ $color }}"></i>
    @endif
@endif
@if($title)
    {!! $title !!}
@endif