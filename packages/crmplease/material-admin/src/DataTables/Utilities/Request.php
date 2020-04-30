<?php

namespace Crmplease\MaterialAdmin\DataTables\Utilities;

use Illuminate\Support\Arr;

class Request extends \Yajra\DataTables\Utilities\Request
{
    /**
     * Get all filters request input.
     *
     * @return array
     */
    public function filters()
    {
        return Arr::wrap($this->request->input('filters'));
    }

    /**
     * Get filter value.
     *
     * @param integer $index
     * @param mixed|null $default
     * @return string
     */
    public function filterValue($index, $default = null)
    {
        return $this->request->input("filters.$index.value", $default);
    }

    /**
     * Get filter value by filter name.
     *
     * @param string $name
     * @param mixed|null $default
     * @return array|string|null
     */
    public function filterValueByName($name, $default = null)
    {
        $filter = collect($this->filters())->first(
            function ($filter) use ($name) {
                return Arr::get($filter, 'name') === $name;
            }
        );

        return $filter ? Arr::get($filter, 'value', $default) : $default;
    }
}
