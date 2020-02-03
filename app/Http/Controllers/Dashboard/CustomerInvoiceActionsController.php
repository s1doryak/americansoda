<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerInvoiceAction controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerInvoiceActionsController extends ResourceController
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
    protected $resource = 'customer_invoice_action';

    /**
     * @var array
     */
    protected $with = [
        'customerInvoice',
    ];

    /**
     * @var CustomerInvoiceRepository
     */
    protected $customerInvoices;

    /**
     * @var array
     */
    protected $editActionFormData = [
        'customerInvoices' => 'name',
    ];

    /**
     * CustomerInvoiceActionsController constructor.
     * @param Gate $gate
     * @param CustomerInvoiceActionRepository $customerInvoiceActionRepository
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     */
    public function __construct(
        Gate $gate,
        CustomerInvoiceActionRepository $customerInvoiceActionRepository,
        CustomerInvoiceRepository $customerInvoiceRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $customerInvoiceActionRepository;
        $this->customerInvoices = $customerInvoiceRepository;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }
}
