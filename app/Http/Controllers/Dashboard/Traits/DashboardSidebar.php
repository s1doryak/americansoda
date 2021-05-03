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
                'customer_user_subscribe',
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
                'ltp_transfer',
                'ltp_message',
            ],
		],
		[
			'title' => 'sidebar.administration',
			'resources' => [
				'user',
				'role',
				'company',
				'company_bank_account',
                'setting',
                'auth_log',
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
