<div class="fg-line">
    <input type="hidden" name="filters[{{ $idx }}][name]" value="{{ $filter->name }}">
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
        <select name="filters[{{ $idx }}][value]"
                class="form-control input-sm selectpicker"
                data-filter-name="{{ $filter->name }}"
                data-live-search="true">
        </select>
    @endif
</div>
