<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Customer;
use App\CustomerOrderItem;
use App\Repositories\Contracts\CompanyRepository;
use PDF;
use App\CustomerShipment;
use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\PackageTypeRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * CustomerShipment controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class CustomerShipmentsController extends ResourceController
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
	protected $resource = 'customer_shipment';

	/**
	 * @var PackageTypeRepository
	 */
	protected $packageTypes;

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
	 * @var CompanyRepository
	 */
	private $companies;

	/**
	 * @var array
	 */
	protected $editActionFormData = [
		'customers' => [
			'lists' => 'name',
			'prepend_empty' => true
		],
		'packageTypes' => [
			'lists' => 'name',
			'prepend_empty' => true
		],
		'users' => 'name',
		'products' => 'name',
	];

	/**
	 * CustomerShipmentsController constructor.
	 * @param Gate $gate
	 * @param CustomerShipmentRepository $customerShipmentRepository
	 * @param PackageTypeRepository $packageTypeRepository
	 * @param CustomerRepository $customerRepository
	 * @param UserRepository $userRepository
	 */
	public function __construct(
		Gate $gate,
		CustomerShipmentRepository $customerShipmentRepository,
		PackageTypeRepository $packageTypeRepository,
		CustomerRepository $customerRepository,
		UserRepository $userRepository,
		ProductRepository $productRepository,
		CustomerOrderItemRepository $customerOrderItemRepository,
		CompanyRepository $companyRepository
	)
	{
		$this->gate = $gate;
		$this->repository = $customerShipmentRepository;
		$this->packageTypes = $packageTypeRepository;
		$this->customers = $customerRepository;
		$this->users = $userRepository;
		$this->products = $productRepository;
		$this->customerOrderItems = $customerOrderItemRepository;
		$this->companies = $companyRepository;

		$this->middleware('dashboard');
		$this->shareSidebar();
	}

	/**
	 * Generate a package list.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function packageList(Request $request)
	{
		/** @var CustomerShipment $shipment */
		$shipment = $this->repository->with('customer')->find($this->getResourceId());

		$filename = preg_replace('/\s+/mui', '_', sprintf('%s_%s_%s_%s.pdf', $shipment->id, $shipment->number, $shipment->customer->name, mb_strtoupper('Lähetysluettelo')));

		return PDF::loadView('dashboard::documents.package-list', $this->getDocumentData($request))->inline($filename);
	}

	/**
	 * Generate a waybill.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function waybill(Request $request)
	{
		/** @var CustomerShipment $shipment */
		$shipment = $this->repository->with('customer')->find($this->getResourceId());

		$filename = preg_replace('/\s+/mui', '_', sprintf('%s_%s_%s_%s.pdf', $shipment->id, $shipment->number, $shipment->customer->name, mb_strtoupper('Rahtikirja')));

		return PDF::loadView('dashboard::documents.waybill', $this->getDocumentData($request))->inline($filename);
	}

	/**
	 * Return common document data.
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	private function getDocumentData(Request $request, $hideBackOrder = true, $hideCancelled = true)
	{
		/** @var CustomerShipment $shipment */
		$shipment = $this->repository->with(['packageType', 'customer', 'customer.billingRegion', 'customer.shippingRegion', 'customer.user', 'customer.stock', 'customer.stock.region'])->find($this->getResourceId());

		$customerOrderItemIds = $shipment->customerOrderItems->pluck('id')->toArray();

		/** @var Company $company */
		$company = $this->companies->with('region')->first();

		/** @var Customer $customer */
		$customer = $shipment->customer;

		$orderItemsConditions = [
			[
				function ($query) use ($customerOrderItemIds) {
					/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
					$query->whereIn('id', $customerOrderItemIds);
				},
				null,
				null
			]

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

		/** @var \Illuminate\Database\Eloquent\Collection $shipmentItems */
		$shipmentItems = $this->customerOrderItems->with(['product', 'product.productGroup', 'product.packageType', 'customerOrder', 'customerShipment'])->findWhere($orderItemsConditions);

		/** @var \Illuminate\Database\Eloquent\Collection $orderDepositItems */
		$orderDepositItems = $shipmentItems->filter(function (CustomerOrderItem $shipmentItem) {
			return $shipmentItem->deposit_enabled;
		});

		$totalVats = get_total_vats($shipmentItems);
		$totalDeposits = get_total_deposits($shipmentItems);
		$totalPrice = $shipmentItems->sum('total_price') + $orderDepositItems->sum('deposit_total_price');
		$totalVatPrice = $shipmentItems->sum('total_vat_price') + $orderDepositItems->sum('deposit_total_vat_price');

		return compact(
			'company',
			'customer',
			'shipment',
			'shipmentItems',
			'totalVats',
			'totalDeposits',
			'totalPrice',
			'totalVatPrice'
		);
	}
}
