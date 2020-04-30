<?php

namespace Crmplease\MaterialAdmin\DataTables;

class DataTables extends \Yajra\DataTables\DataTables
{
	/**
	 * DataTables using Eloquent Builder.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder|mixed $builder
	 * @return \Yajra\DataTables\DataTableAbstract|EloquentDataTable
	 */
	public function eloquent($builder)
	{
		return EloquentDataTable::create($builder);
	}
}
