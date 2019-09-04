<?php

namespace App\Http\Controllers\Dashboard;

use Auth;
use PDF;
use App\Company;
use App\Customer;
use App\CustomerOrderItem;
use App\CustomerOrder;
use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerOrderRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerOrder controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerOrdersController extends ResourceController
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
    protected $resource = 'customer_order';

    /**
     * @var CompanyRepository
     */
    private $companies;

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @var CustomerOrderItemRepository
     */
    protected $customerOrderItems;

    /**
     * @var array
     */
    protected $editActionFormData = [
        'customers' => [
            'lists' => 'name',
            'prepend_empty' => true
        ],
        'users' => 'name',
        'products' => 'name',
    ];

    /**
     * CustomerOrdersController constructor.
     * @param Gate $gate
     * @param CustomerOrderRepository $repository
     * @param CustomerOrderItemRepository $customerOrderItemRepository
     * @param CompanyRepository $companyRepository
     * @param CustomerRepository $customerRepository
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        Gate $gate,
        CustomerOrderRepository $repository,
        CustomerOrderItemRepository $customerOrderItemRepository,
        CompanyRepository $companyRepository,
        CustomerRepository $customerRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $repository;
        $this->customerOrderItems = $customerOrderItemRepository;
        $this->companies = $companyRepository;
        $this->customers = $customerRepository;
        $this->users = $userRepository;
        $this->products = $productRepository;

        $this->createActionFormData = [
            'customers' => [
                'lists' => 'name',
                'prepend_empty' => true
            ],
            'users' => [
                'lists' => 'name',
                'selected' => Auth::user()
            ],
            'products' => [
                'lists' => 'name',
                'query' => $this->getProductsQueryScope()
            ]
        ];

        $this->editActionFormData = [
            'customers' => [
                'lists' => 'name',
                'prepend_empty' => true
            ],
            'users' => 'name',
            'products' => [
                'lists' => 'name',
                'query' => $this->getProductsQueryScope()
            ]
        ];

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }

    /**
     * Returns a part of products query.
     *
     * @return \Closure
     */
    protected function getProductsQueryScope()
    {
        return function ($customerOrder) {
            return function ($query) use ($customerOrder) {
                if (is_object($customerOrder)) {
                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    return $query
                        ->distinct()
                        ->select('products.*')
                        ->join(
                            'customer_pricing_policies',
                            'customer_pricing_policies.product_group_id',
                            '=',
                            'products.product_group_id'
                        )->where('customer_pricing_policies.customer_id', '=', $customerOrder->customer_id)
                        ->whereNull('customer_pricing_policies.deleted_at');
                }

                return $query;
            };
        };
    }

    /**
     * @param CustomerOrder $customerOrder
     * @return array
     */
    protected function getEditViewData($customerOrder)
    {
        $attributes = $customerOrder->toArray();

        return [
            'customer' => $attributes['customer_id'],
            'order' => $attributes['id']
        ];
    }

    /**
     * Build redirect URL to point user after successful store.
     *
     * @param string $action
     * @param CustomerOrder $customerOrder
     * @return string
     */
    protected function getRedirectUrl($action, $customerOrder = null)
    {
        if ($customerOrder) {
            return route(sprintf('%s.%s.edit', $this->getPrefix(), $this->getResource()), ['id' => $customerOrder->getKey()]);
        } else {
            return parent::getRedirectUrl($action, $customerOrder);
        }
    }

    /**
     * Generate an order review.
     *
     * @param Request $request
     * @param bool $inline
     * @return \Illuminate\Http\Response|string
     */
    public function orderReview(Request $request, $inline = true)
    {
        /** @var CustomerOrder $order */
        $order = $this->repository->with('customer')->find($this->getResourceId());

        $pdf = PDF::loadView('dashboard::documents.order-review', $this->getDocumentData(false, false));

        if ($inline) {

            $filename = sprintf('%s.pdf', $order->getOrderReviewFileName());

            return $pdf->inline($filename);

        } else {

            $filename = sprintf('%s/customer_orders/%s.pdf', storage_path('app'), $order->getOrderReviewStorageFileName());

            if (file_exists($filename)) {
                unlink($filename);
            }

            $pdf->save($filename);

            return $filename;
        }
    }

    /**
     * Generate an order review.
     *
     * @param Request $request
     * @param bool $inline
     * @return \Illuminate\Http\Response|string
     */
    public function orderReviewPlain(Request $request, $inline = true)
    {
        return view('dashboard::documents.order-review', $this->getDocumentData(false, false));
    }

    /**
     * Return common document data.
     *
     * @param Request $request
     *
     * @return array
     */
    private function getDocumentData($hideBackOrder = true, $hideCancelled = true)
    {
        /** @var CustomerOrder $order */
        $order = $this->repository->with(['customer', 'user', 'customer.billingRegion', 'customer.shippingRegion', 'customer.user', 'customer.stock', 'customer.stock.region'])->find($this->getResourceId());

        /** @var Company $company */
        $company = $this->companies->with('region')->first();

        /** @var Customer $customer */
        $customer = $order->customer;

        $orderItemsConditions = [
            'customer_order_id' => $order->getKey(),

        ];

        if ($hideBackOrder) {
            $orderItemsConditions['back_order'] = 0;
            /*$orderItemsConditions[] = [
                function($query) {
                    $query->where('expected_date', '=', 'NULL');
                },
                null,
                null
            ];*/
        }

        if ($hideCancelled) {
            $orderItemsConditions['cancelled'] = 0;
        }

        /** @var \Illuminate\Database\Eloquent\Collection $orderItems */
        $orderItems = $this->customerOrderItems->with(['product', 'product.productGroup', 'product.packageType'])->findWhere($orderItemsConditions);

        /** @var boolean $hasNegativeItems */
        $hasNegativeItems = $orderItems->filter(function (CustomerOrderItem $orderItem) {
            return $orderItem->total_price < 0;
        })->isNotEmpty();

        /** @var \Illuminate\Database\Eloquent\Collection $orderDepositItems */
        $orderDepositItems = $orderItems->filter(function (CustomerOrderItem $orderItem) {
            return $orderItem->deposit_enabled;
        });

        $totalVats = get_total_vats($orderItems);
        $totalDeposits = get_total_deposits($orderItems);
        $totalPrice = $orderItems->sum('total_price') + $orderDepositItems->sum('deposit_total_price');
        $totalVatPrice = $orderItems->sum('total_vat_price') + $orderDepositItems->sum('deposit_total_vat_price');

        return compact(
            'company',
            'customer',
            'order',
            'orderItems',
            'totalVats',
            'totalDeposits',
            'totalPrice',
            'totalVatPrice',
            'hasNegativeItems'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request)
    {
        $id = $this->getResourceId();

        /** @var CustomerOrder $order */
        $order = $this->repository->with('customer')->find($id);

        $order->sendEmail($this->orderReview($request, false));

        $customerOrder = $this->repository->update(
            [
                'sent_at' => Carbon::now()
            ],
            $id
        );

        return response(format_date($customerOrder->sent_at));
    }
}
