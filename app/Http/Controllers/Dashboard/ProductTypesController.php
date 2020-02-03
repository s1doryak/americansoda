<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\ProductTypeRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * ProductType controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class ProductTypesController extends \Crmplease\MaterialAdmin\Routing\ResourceController
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
    protected $resource = 'product_type';



    /**
     * @var array
     */
	protected $editActionFormData = [

	];

    /**
     * ProductTypesController constructor.
     * @param Gate $gate
	 * @param ProductTypeRepository $productTypeRepository
     * @return void
     */
	public function __construct(
	    Gate $gate,
		ProductTypeRepository $productTypeRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $productTypeRepository;

	    $this->middleware('auth:dashboard');
        $this->shareSidebar();
	}
}
