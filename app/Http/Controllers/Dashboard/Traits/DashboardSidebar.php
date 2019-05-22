<?php

namespace App\Http\Controllers\Dashboard\Traits;

trait DashboardSidebar
{
	/**
	 * @var array
	 */
	protected $sidebar = [
		[
			'title' => 'sidebar.sales',
			'resources' => [
				// 'assembly',
				'customer',
				// 'customer_order',
				// 'customer_order_item',
				// 'customer_shipment',
				'customer_type',
				'payment_type',
				'region',
			],
		],
		[
			'title' => 'sidebar.nomenclature',
			'resources' => [
				'product',
				'product_group',
				'brand',
				'package_type',
			],
		],
		[
			'title' => 'sidebar.inventory',
			'resources' => [
				'stock',
				// 'stock_movement_product',
				// 'stock_product',
				// 'supplier',
				// 'supplier_order',
			],
		],
		[
			'title' => 'sidebar.administration',
			'resources' => [
				'administrator',
				'user',
				'role',
				'company',
				'job',
				'failed_job',
			],
		],
		// ...
	];

	/**
	 * @return void
	 */
	public function shareSidebar()
	{
		view()->share('sidebar', $this->sidebar);
	}
}
