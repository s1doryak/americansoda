<?php

namespace Crmplease\MaterialAdmin\DataTables\Contracts;

interface AggregateContract
{
    /**
     * @return void
     */
    public function aggregate();

    /**
     * @param array $columns
     *
     * @return $this
     */
    public function aggregateColumns(array $columns = []);
}
