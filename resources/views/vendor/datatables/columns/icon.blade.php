@if($icon)
    @if(starts_with($color, 'c-'))
        <i class="zmdi zmdi-{{ str_replace_first('zmdi-', '', $icon) }} {{ implode(' ', $classes) }} {{ $color }}"></i>
    @else
        <i class="zmdi zmdi-{{ str_replace_first('zmdi-', '', $icon) }} {{ implode(' ', $classes) }}" style="color: {{ $color }}"></i>
    @endif
@endif
@if($title)
    {!! $title !!}
@endif