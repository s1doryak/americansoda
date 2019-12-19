@php($attr = $filter->attr ?? [])
<div class="fg-line">
    <input type="hidden" name="filters[{{ $idx }}][name]" value="{{ $filter->name }}">
    <input type="hidden" name="filters[{{ $idx }}][value]" value="">
    <div class="toggle-switch" data-ts-color="{{ isset($attr['ts-color']) ? $attr['ts-color'] : 'green' }}">
        {!! Form::checkbox(sprintf('filters[%d][value]', $idx), $filter->default, $filter->default) !!}
        <label for="filters[{{ $idx }}][value]" class="ts-helper"></label>
        @isset($attr['ts-label'])
            <label for="filters[{{ $idx }}][value]" class="ts-label">{!! $attr['ts-label'] !!}</label>
        @endisset
    </div>
</div>
