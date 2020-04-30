<?php

namespace Crmplease\MaterialAdmin\DataTables\Contracts;

interface FilterableContract
{
    /**
     * @return void
     */
    public function filterable();

    /**
     * @param array $columns
     *
     * @return $this
     */
    public function filterableColumns(array $columns = []);
}
