<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\ProductTag;

/**
 * ProductTag datatable.
 *
 * @package App\DataTables\Dashboard
 */
class ProductTagDataTable extends DataTable
{
    protected $responsive = false;

    /**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'name',
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'name',
			'action',
		];
	}

	/**
	 * @return array
	 */
	protected function getAggregateColumns()
	{
		return [

		];
	}

	/**
	 * @return array
	 */
	protected function getFilterableColumns()
	{
		return [

		];
	}

	/**
	 * @param ProductTag $productTag
	 * @return array
	 */
	protected function getActions($productTag)
	{
		return parent::getActions($productTag);
	}

	/**
	 * @return array
	 */
	protected function getButtons()
	{
		return parent::getButtons();
	}

	/**
	 * @param ProductTag $productTag
	 * @return string
	 */
    public function renderNameColumn($productTag)
	{
		if ($this->isDataTableRequest()) {
			return $this->renderIconView($productTag->name, $productTag->icon, $productTag->color);
		}

		return $productTag->name;
	}
}
