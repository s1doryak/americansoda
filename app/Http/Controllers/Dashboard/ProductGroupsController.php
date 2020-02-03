<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\ProductGroupRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Repositories\Contracts\ProductTypeRepository;

/**
 * ProductGroup controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class ProductGroupsController extends ResourceController
{
	use DashboardSidebar;
	
	/**
	 * @var ProductTypeRepository
	 */
	protected $productTypes;

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
    protected $resource = 'product_group';



    /**
     * @var array
     */
	protected $editActionFormData = [
		'productTypes' => 'name',
	];

    /**
     * ProductGroupsController constructor.
     * @param Gate $gate
	 * @param ProductGroupRepository $productGroupRepository
     * @param ProductTypeRepository $productTypeRepository
	 */
	public function __construct(
	    Gate $gate,
		ProductGroupRepository $productGroupRepository,
		ProductTypeRepository $productTypeRepository
	)
	{
	    $this->productTypes = $productTypeRepository;
		$this->gate = $gate;
		$this->repository = $productGroupRepository;

	    $this->middleware('auth:dashboard');
	    $this->shareSidebar();
	}
}
