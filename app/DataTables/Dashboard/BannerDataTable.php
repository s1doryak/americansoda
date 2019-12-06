<?php

namespace App\DataTables\Dashboard;

use Crmplease\MaterialAdmin\DataTables\Services\DataTable;
use App\Banner;

/**
 * Banner datatable.
 *
 * @package App\DataTables\Dashboard
 */
class BannerDataTable extends DataTable
{
	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'name',
			'image',
			'url',
			'customerTypes.name' => [
				'data' => 'customerTypes.name'
			],
		];
	}

	/**
	 * @return array
	 */
	protected function getRawColumns()
	{
		return [
			'name',
			'image',
			'url',
			'customerTypes.name',
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
			'customerTypes.name' => [
				'type' => 'choice',
				'multiple' => true,
				'operator' => 'in',
				'data' => 'customerTypes.id',
				'lists' => 'customerTypes.name',
			],
        ];
    }

	/**
	 * @param Banner $banner
	 * @return array
	 */
	protected function getActions($banner)
	{
		return parent::getActions($banner);
	}

    /**
     * @return array
     */
    protected function getButtons()
    {
        return parent::getButtons();
    }
}
