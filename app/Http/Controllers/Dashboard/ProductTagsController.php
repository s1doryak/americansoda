<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\ProductTagRepository;
use App\Repositories\Contracts\ProductRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * ProductTag controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class ProductTagsController extends ResourceController
{
	use DashboardSidebar;

	/**
	 * @var Gate
	 */
	protected $gate;

	/**
	 * @var string
	 */
	protected $prefix = 'dashboard';

	/**
	 * @var string
	 */
	protected $resource = 'product_tag';

	/**
	 * @var ProductRepository
	 */
	protected $products;


	/**
	 * @var array
	 */
	protected $editActionFormData = [
		'products' => 'name',
	];

	/**
	 * ProductTagsController constructor.
	 * @param Gate $gate
	 * @param ProductTagRepository $productTagRepository
	 * @param ProductRepository $productRepository
	 */
	public function __construct(
		Gate $gate,
		ProductTagRepository $productTagRepository,
		ProductRepository $productRepository
	)
	{
		$this->gate = $gate;
		$this->repository = $productTagRepository;
		$this->products = $productRepository;

		$this->middleware('dashboard');
		$this->shareSidebar();
	}
}
