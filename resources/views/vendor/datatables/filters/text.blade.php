<div class="fg-line">
    <input type="hidden" name="filters[{{ $idx }}][name]" value="{{ $filter->name }}">
    <input type="text" name="filters[{{ $idx }}][value]" value="{{ $filter->default }}" class="form-control input-sm" data-filter-name="{{ $filter->name }}">
</div>
