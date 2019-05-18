<div class="fg-line">
    <input type="hidden" name="filters[{{ $idx }}][name]" value="{{ $filter->name }}">
    <input type="hidden" name="filters[{{ $idx }}][data]" value="{{ $filter->data }}">
    <input type="hidden" name="filters[{{ $idx }}][type]" value="{{ $filter->type }}">
    <input type="hidden" name="filters[{{ $idx }}][operator]" value="{{ $filter->operator }}">
    <input type="hidden" name="filters[{{ $idx }}][multiple]" value="{{ $filter->multiple ? 'true' : 'false' }}">
    <input type="hidden" name="filters[{{ $idx }}][filterable]" value="{{ $filter->filterable ? 'true' : 'false' }}">
    @if($filter->multiple)
        <select name="filters[{{ $idx }}][value][]"
                class="form-control input-sm selectpicker"
                multiple
                data-filter-name="{{ $filter->name }}"
                data-live-search="true"
                data-actions-box="true"
                data-selected-text-format="count > 3">
        </select>
    @else
        <select name="filters[{{ $idx }}][value]" class="form-control input-sm selectpicker" data-filter-name="{{ $filter->name }}" data-live-search="true"></select>
    @endif
</div>