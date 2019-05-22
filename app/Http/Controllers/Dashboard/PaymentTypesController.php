<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\PaymentTypeRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * PaymentType controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class PaymentTypesController extends ResourceController
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
    protected $resource = 'payment_type';



    /**
     * @var array
     */
	protected $editActionFormData = [

	];

    /**
     * PaymentTypesController constructor.
     * @param Gate $gate
	 * @param PaymentTypeRepository $paymentTypeRepository
     */
	public function __construct(
	    Gate $gate,
		PaymentTypeRepository $paymentTypeRepository
	)
	{
	    $this->gate = $gate;
		$this->repository = $paymentTypeRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}
}
