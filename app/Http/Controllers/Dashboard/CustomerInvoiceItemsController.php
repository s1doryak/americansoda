<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerInvoiceItem controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerInvoiceItemsController extends ResourceController
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
    protected $resource = 'customer_invoice_item';

    /**
     * @var array
     */
    protected $with = [
        'customerInvoice',
        'customerOrderItem',
        'product',
    ];

    /**
     * @var CustomerInvoiceRepository
     */
    protected $invoices;

    /**
     * @var CustomerOrderItemRepository
     */
    protected $orderItems;

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @var array
     */
    protected $editActionFormData = [
        'invoices' => 'number',
        'orderItems' => 'name',
        'products' => 'name',
    ];

    /**
     * CustomerInvoiceItemsController constructor.
     * @param Gate $gate
     * @param CustomerInvoiceItemRepository $customerInvoiceItemRepository
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     * @param CustomerOrderItemRepository $customerOrderItemRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        Gate $gate,
        CustomerInvoiceItemRepository $customerInvoiceItemRepository,
        CustomerInvoiceRepository $customerInvoiceRepository,
        CustomerOrderItemRepository $customerOrderItemRepository,
        ProductRepository $productRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $customerInvoiceItemRepository;
        $this->invoices = $customerInvoiceRepository;
        $this->orderItems = $customerOrderItemRepository;
        $this->products = $productRepository;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }
}
