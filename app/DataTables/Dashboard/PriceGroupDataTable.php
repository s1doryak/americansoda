<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\PriceGroup;

/**
 * PriceGroup datatable.
 *
 * @package App\DataTables\Dashboard
 */
class PriceGroupDataTable extends DataTable
{
    protected $responsive = false;

    /**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'name',
			'manual',
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'name',
			'manual',
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
			'customers.name' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'customers.id',
				'lists' => 'customers.name',
			],
			'priceGroupBreakpoints.breakpoint' => [
				'type' => 'choice',
				'multiple' => true,
				'data' => 'priceGroupBreakpoints.id',
				'lists' => 'priceGroupBreakpoints.breakpoint',
			],
		];
	}

	/**
	 * @param PriceGroup $priceGroup
	 * @return array
	 */
	protected function getActions($priceGroup)
	{
		return parent::getActions($priceGroup);
	}

	/**
	 * @return array
	 */
	protected function getButtons()
	{
		return parent::getButtons();
	}

	/**
	 * @param PriceGroup $priceGroup
	 * @return string
	 */
    public function renderManualColumn($priceGroup)
	{
		if ($this->isDataTableRequest()) {
			return $this->renderView('dashboard::resources.price_group.columns.manual', compact('priceGroup'));
		}

		return $priceGroup->manual ?? null;
	}
}
