@if($color)
    @if(Str::startsWith($color, 'bgm-'))
        <i class="badge-circle {{ implode(' ', $classes) }} {{ $color }}"></i>
    @else
        <i class="badge-circle {{ implode(' ', $classes) }}" style="background-color: {{ $color }}"></i>
    @endif
@endif
{!! $title !!}
