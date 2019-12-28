<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\PriceGroupBreakpoint;

/**
 * PriceGroupBreakpoint datatable.
 *
 * @package App\DataTables\Dashboard
 */
class PriceGroupBreakpointDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'breakpoint',
			'priceGroup.name' => [
				'data' => 'priceGroup.name',
			],
			'productGroups.name' => [
				'data' => 'productGroups.name',
            ],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'breakpoint',
			'priceGroup.name',
			'productGroups.name',
			'action',
		];
	}

    /**
     * @return array
     */
    protected function getAggregateColumns()
    {
        return [
//			'breakpoint',
        ];
    }

    /**
     * @return array
     */
    protected function getFilterableColumns()
    {
        return [
//			'priceGroup.name' => [
//				'type' => 'choice',
//				'multiple' => true,
//				'data' => 'priceGroup.id',
//				'lists' => 'priceGroup.name',
//			],
//			'productGroups.name' => [
//				'type' => 'choice',
//				'multiple' => true,
//				'data' => 'productGroups.id',
//				'lists' => 'productGroups.name',
//			],
        ];
    }

	/**
	 * @param PriceGroupBreakpoint $priceGroupBreakpoint
	 * @return array
	 */
	protected function getActions($priceGroupBreakpoint)
	{
		return parent::getActions($priceGroupBreakpoint);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }

    /**
     * @param PriceGroupBreakpoint $priceGroupBreakpoint
     * @return string
     */
    public function renderPriceGroup__NameColumn($priceGroupBreakpoint)
    {
        if ($this->isDataTableRequest()) {
            return $priceGroupBreakpoint->priceGroup->name ?? $this->renderDefaultView();
        }

        return $priceGroupBreakpoint->priceGroup->name ?? null;
    }

    /**
     * @param PriceGroupBreakpoint $priceGroupBreakpoint
     * @return string
     */
    public function renderProductGroups__NameColumn($priceGroupBreakpoint)
    {
        if ($this->isDataTableRequest()) {
            return $priceGroupBreakpoint->productGroups->pluck('name')->implode('<br>') ?? $this->renderDefaultView();
        }

        return $priceGroupBreakpoint->productGroups->pluck('name')->implode(', ') ?? null;
    }
}
