<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\ProductTagRepository;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\BrandRepository;
use App\Repositories\Contracts\PackageTypeRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Product controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class ProductsController extends ResourceController
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
	protected $resource = 'product';

	/**
	 * @var BrandRepository
	 */
	protected $brands;

	/**
	 * @var PackageTypeRepository
	 */
	protected $packageTypes;

	/**
	 * @var ProductGroupRepository
	 */
	protected $productGroups;

	/**
	 * @var ProductTagRepository
	 */
	protected $productTags;

	/**
	 * @var array
	 */
	protected $editActionFormData = [
		'brands' => 'name',
		'packageTypes' => 'name',
		'productGroups' => 'name',
		'productTags' => [
			'lists' => 'name',
			'extra' => 'content'
		],
	];

	/**
	 * ProductsController constructor.
	 * @param Gate $gate
	 * @param ProductRepository $productRepository
	 * @param BrandRepository $brandRepository
	 * @param PackageTypeRepository $packageTypeRepository
	 * @param ProductGroupRepository $productGroupRepository
	 * @param ProductTagRepository $productTagRepository
	 */
	public function __construct(
		Gate $gate,
		ProductRepository $productRepository,
		BrandRepository $brandRepository,
		PackageTypeRepository $packageTypeRepository,
		ProductGroupRepository $productGroupRepository,
		ProductTagRepository $productTagRepository
	)
	{
		$this->gate = $gate;
		$this->repository = $productRepository;
		$this->brands = $brandRepository;
		$this->packageTypes = $packageTypeRepository;
		$this->productGroups = $productGroupRepository;
		$this->productTags = $productTagRepository;

		$this->middleware('auth:dashboard');
		$this->shareSidebar();
	}
}
