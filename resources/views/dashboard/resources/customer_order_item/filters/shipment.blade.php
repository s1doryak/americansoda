<div class="form-group col-sm-6">
    <input type="hidden" name="filters[{{ $idx }}][name]" value="{{ $filter->name }}">
    <input type="hidden" name="filters[{{ $idx }}][data]" value="{{ $filter->data }}">
    <label class="col-sm-4 control-label">{{ $filter->title }}</label>
    <div class="col-sm-4">
        <div class="fg-line">
            <select name="filters[{{ $idx }}][value][types][]"
                    class="form-control input-sm selectpicker"
                    multiple
                    title="Any type"
                    data-filter-name="{{ $filter->name }}"
                    data-live-search="true"
                    data-actions-box="true"
                    data-selected-text-format="count > 3">
                @foreach((array)$filter->types as $type)
                    <option value="{{ $type['key'] }}">{{ $type['value'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="fg-line">
            <select name="filters[{{ $idx }}][value][months][]"
                    class="form-control input-sm selectpicker"
                    multiple
                    title="Any month"
                    data-live-search="true"
                    data-selected-text-format="count > 3">
                @foreach((array)$filter->months as $month)
                    <option value="{{ $month['key'] }}">{{ $month['value'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>