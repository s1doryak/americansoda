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
				'assembly',
                'banner',
				'customer',
                'customer_type',
                'customer_user',
                'customer_pre_order',
				'customer_order',
				'customer_order_item',
				'customer_shipment',
                'customer_invoice',
				'payment_type',
				'price_group',
				'region',
			],
		],
		[
			'title' => 'sidebar.nomenclature',
			'resources' => [
				'product',
				'product_group',
                'product_type',
				'product_tag',
				'brand',
				'package_type',
			],
		],
		[
			'title' => 'sidebar.inventory',
			'resources' => [
				'stock',
				'stock_movement_product',
				'stock_product',
			],
		],
		[
			'title' => 'sidebar.administration',
			'resources' => [
				'user',
				'role',
				'company',
				'company_bank_account',
                'customer_user_subscribe',
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
