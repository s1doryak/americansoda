<?php

namespace Crmplease\MaterialAdmin\DataTables\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \Crmplease\MaterialAdmin\DataTables\DataTables
 * @method static \Crmplease\MaterialAdmin\DataTables\EloquentDatatable eloquent($builder)
 * @method static \Crmplease\MaterialAdmin\DataTables\QueryDataTable query($builder)
 * @method static \Crmplease\MaterialAdmin\DataTables\CollectionDataTable collection($collection)
 *
 * @see \Yajra\DataTables\DataTables
 */
class DataTables extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'datatables';
    }
}
