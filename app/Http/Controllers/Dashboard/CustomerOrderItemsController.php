<?php

namespace App\Http\Controllers\Dashboard;

use App\CustomerOrder;
use App\CustomerOrderItem;
use App\CustomerShipment;
use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\MaterialAdmin\Events\ResourceUpdated;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerOrderItem controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerOrderItemsController extends ResourceController
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
    protected $resource = 'customer_order_item';

    /**
     * @var array
     */
    protected $with = [
        'customerOrder',
        'customerOrder.customer',
        'customerOrder.customer.user',
        'customerShipment',
        'product',
        'product.productGroup',
        'customer',
        'customer.user',
    ];

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * @var CustomerOrderRepository
     */
    protected $customerOrders;

    /**
     * @var CustomerShipmentRepository
     */
    protected $customerShipments;

    /**
     * @var CustomerInvoiceRepository
     */
    protected $customerInvoices;

    /**
     * @var array
     */
    protected $editActionFormData = [
        'products' => 'name',
        'customers' => 'name',
        'customerOrders' => 'name',
        'customerShipments' => 'name',
        'customerInvoices' => 'name',
    ];

    /**
     * CustomerOrderItemsController constructor.
     * @param Gate $gate
     * @param CustomerOrderItemRepository $customerOrderItemRepository
     * @param ProductRepository $productRepository
     * @param CustomerRepository $customerRepository
     * @param CustomerOrderRepository $customerOrderRepository
     * @param CustomerShipmentRepository $customerShipmentRepository
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     */
    public function __construct(
        Gate $gate,
        CustomerOrderItemRepository $customerOrderItemRepository,
        ProductRepository $productRepository,
        CustomerRepository $customerRepository,
        CustomerOrderRepository $customerOrderRepository,
        CustomerShipmentRepository $customerShipmentRepository,
        CustomerInvoiceRepository $customerInvoiceRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $customerOrderItemRepository;
        $this->products = $productRepository;
        $this->customers = $customerRepository;
        $this->customerOrders = $customerOrderRepository;
        $this->customerShipments = $customerShipmentRepository;
        $this->customerInvoices = $customerInvoiceRepository;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function shipmentAssign(Request $request)
    {
        $needShipping = $request->get('need_shipping') != 'false' ? true : false;

        $assemblyNumber = CustomerShipment::getDefaultAssemblyNumber();

        $customerOrderItemId = resource_id('customer_order_item');

        /** @var CustomerOrderItem $customerOrderItem */
        $customerOrderItem = $this->repository->find($customerOrderItemId);

        /** @var CustomerShipment|null $customerShipment */
        $customerShipment = $this->customerShipments->firstWhere(
            [
                'customer_id' => $customerOrderItem->customer_id,
                'status' => config('stock.status.open'),
            ]
        );

        if ($needShipping) {

            if (!$customerShipment) {

                /** @var \App\User|null $user */
                $user = $this->guard()->user();

                $customerShipment = $this->customerShipments->create(
                    [
                        'user_id' => $user ? $user->getKey() : null,
                        'customer_id' => $customerOrderItem->customer_id,
                        'assembly_number' => $assemblyNumber,
                        'status' => config('stock.status.open'),
                        'number' => CustomerShipment::getDefaultNumber(),
                    ]
                );

            }

            if ($customerShipment) {

                $customerOrderItem->update(
                    [
                        'customer_shipment_id' => $customerShipment->getKey(),
                        'status' => config('stock.status.assembly'),
                    ]
                );

                $customerShipment->touch();

                event(new ResourceUpdated(resource_name(), $customerShipment->getAttributes(), [], []));
            }

        } else {

            $customerOrderItem->update(
                [
                    'customer_shipment_id' => null,
                    'assembly_number' => null,
                ]
            );

            $customerShipment = $this->customerShipments->firstWhere(
                [
                    'customer_id' => $customerOrderItem->customer_id,
                    'status' => config('stock.status.open'),
                ]
            );

            if ($customerShipment) {

                if ($customerShipment->customerOrderItems->count() == 0) {

                    $this->customerShipments->destroy($customerShipment->getKey());

                } else {

                    $customerShipment->touch();

                }

                event(new ResourceUpdated(resource_name(), $customerShipment->getAttributes(), [], []));

            }
        }

        return response((string)$needShipping);
    }

    /**
     * @param CustomerOrder $customerOrder
     * @return array
     */
    protected function getSplitViewData($customerOrder)
    {
        return [];
    }

    /**
     * @return string
     */
    protected function getSplitViewName()
    {
        return 'customer_order_items.split';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function getSplitForm()
    {
        $title = trans(sprintf('%s.split.title', $this->getTranslationPrefix()));
        $model = $this->repository->find($this->getResourceId());
        $formData = array_merge($model->transform(), $this->getEditActionFormData($model));
        $form = $this->getResourceProvider()
            ->setModel($model)
            ->getForm(
                'edit',
                [
                    'url' => route('customer_order_item.split', $model),
                    'method' => 'post',
                    'data-update' => 1,
                ],
                $formData
            );

        $data = array_merge(compact('title', 'model', 'form'), $this->getSplitViewData($model));

        return view($this->getSplitViewName(), $data);
    }

    public function split(Request $request)
    {
        $model = $this->repository->find($this->getResourceId());

        return response('OK!');
    }
}
