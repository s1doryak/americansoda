<?php

namespace App\Http\Controllers\Dashboard;

use Auth;
use App\Customer;
use App\Repositories\Contracts\CustomerRevisionRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\StockRepository;
use App\Repositories\Contracts\CustomerTypeRepository;
use App\Repositories\Contracts\PaymentTypeRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\RegionRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Repositories\Contracts\PriceGroupRepository;

/**
 * Customer controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomersController extends ResourceController
{
    use DashboardSidebar;

    /**
     * @var PriceGroupRepository
     */
    protected $priceGroups;

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
    protected $resource = 'customer';

    /**
     * @var array
     */
    protected $with = [
        'billingRegion',
        'shippingRegion',
        'customerType',
        'paymentType',
        'priceGroup',
        'user',
        'stock',
    ];

    /**
     * @var StockRepository
     */
    protected $stocks;

    /**
     * @var CustomerTypeRepository
     */
    protected $customerTypes;

    /**
     * @var PaymentTypeRepository
     */
    protected $paymentTypes;

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var RegionRepository
     */
    protected $regions;

    /**
     * @var CustomerRevisionRepository
     */
    protected $customerRevisionRepository;

    /**
     * @var ProductGroupRepository
     */
    protected $productGroups;

    /**
     * @var array
     */
    protected $editActionFormData = [
        'billingRegions' => [
            'repository' => 'regions',
            'lists' => 'name',
            'selected' => 'billing_region_id'
        ],
        'shippingRegions' => [
            'repository' => 'regions',
            'lists' => 'name',
            'selected' => 'shipping_region_id'
        ],
        'customerTypes' => 'name',
        'paymentTypes' => 'name',
        'users' => 'name',
        'productGroups' => 'name',
        'stocks' => 'name',
        'priceGroups' => 'name',
    ];

    /**
     * CustomersController constructor.
     *
     * @param Gate $gate
     * @param CustomerRepository $customerRepository
     * @param StockRepository $stockRepository
     * @param CustomerTypeRepository $customerTypeRepository
     * @param PaymentTypeRepository $paymentTypeRepository
     * @param UserRepository $userRepository
     * @param RegionRepository $regionRepository
     * @param CustomerRevisionRepository $customerRevisionRepository
     * @param ProductGroupRepository $productGroupRepository
     * @param PriceGroupRepository $priceGroupRepository
     */
    public function __construct(
        Gate $gate,
        CustomerRepository $customerRepository,
        StockRepository $stockRepository,
        CustomerTypeRepository $customerTypeRepository,
        PaymentTypeRepository $paymentTypeRepository,
        UserRepository $userRepository,
        RegionRepository $regionRepository,
        CustomerRevisionRepository $customerRevisionRepository,
        ProductGroupRepository $productGroupRepository,
        PriceGroupRepository $priceGroupRepository
    )
    {
        $this->gate = $gate;
        $this->repository = $customerRepository;
        $this->stocks = $stockRepository;
        $this->customerTypes = $customerTypeRepository;
        $this->paymentTypes = $paymentTypeRepository;
        $this->users = $userRepository;
        $this->regions = $regionRepository;
        $this->customerRevisionRepository = $customerRevisionRepository;
        $this->productGroups = $productGroupRepository;
        $this->priceGroups = $priceGroupRepository;

        $this->createActionFormData = [
            'billingRegions' => [
                'repository' => 'regions',
                'lists' => 'name',
                'selected' => 'billing_region_id'
            ],
            'shippingRegions' => [
                'repository' => 'regions',
                'lists' => 'name',
                'selected' => 'shipping_region_id'
            ],
            'customerTypes' => 'name',
            'paymentTypes' => 'name',
            'users' => [
                'lists' => 'name',
                'selected' => Auth::user()
            ],
            'productGroups' => 'name',
            'stocks' => 'name',
            'priceGroups' => 'name',
        ];

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
    }

    /**
     * @param Customer $customer
     * @return array
     */
    protected function getEditViewData($customer)
    {
        $id = $this->getResourceId();

        return [
            'productGroups' => $this->productGroups->getGroupsByCustomerId($id),
            'revisions' => $this->customerRevisionRepository->getLatestRevisions($id)
        ];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function map()
    {
        $title = trans(sprintf('%s.map.title', $this->getTranslationPrefix()));

        return view('customers.map', compact('title'));
    }
}
