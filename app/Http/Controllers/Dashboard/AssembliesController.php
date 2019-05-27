<?php

namespace App\Http\Controllers\Dashboard;

use PDF;
use App\Assembly;
use App\Company;
use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\PackageTypeRepository;
use App\Repositories\Contracts\PaymentTypeRepository;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\UserRepository;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use App\Repositories\Contracts\AssemblyRepository;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Assembly controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class AssembliesController extends ResourceController
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
    protected $resource = 'assembly';

	/**
	 * @var CompanyRepository
	 */
	protected $companies;

	/**
	 * @var CustomerRepository
	 */
	protected $customers;

	/**
	 * @var UserRepository
	 */
	protected $users;

	/**
	 * @var PaymentTypeRepository
	 */
	protected $paymentTypes;

	/**
	 * @var PackageTypeRepository
	 */
	protected $packageTypes;

	/**
	 * @var ProductRepository
	 */
	protected $products;

	/**
	 * @var CustomerOrderItemRepository
	 */
	protected $customerOrderItems;

	/**
	 * @var CustomerShipmentRepository
	 */
	protected $shipments;

	/**
	 * @var array
	 */
	protected $editActionFormData = [
		'customers'    => [
			'lists'         => 'name',
			'prepend_empty' => true,
		],
		'packageTypes' => [
			'lists'         => 'name',
			'prepend_empty' => true,
		],
		'users'        => 'name',
		'products'     => 'name',
	];

    /**
     * AssembliesController constructor.
     * @param Gate $gate
	 * @param AssemblyRepository $assemblyRepository
     */
	public function __construct(
	    Gate $gate,
		AssemblyRepository $repository,
		CustomerOrderItemRepository $customerOrderItemRepository,
		CustomerShipmentRepository $customerShipmentRepository,
		CustomerRepository $customerRepository,
		UserRepository $userRepository,
		ProductRepository $productRepository,
		CompanyRepository $companyRepository,
		PackageTypeRepository $packageTypeRepository
	)
	{
	    $this->gate = $gate;
		$this->repository         = $repository;
		$this->customerOrderItems = $customerOrderItemRepository;
		$this->shipments          = $customerShipmentRepository;
		$this->customers          = $customerRepository;
		$this->users              = $userRepository;
		$this->products           = $productRepository;
		$this->companies          = $companyRepository;
		$this->packageTypes       = $packageTypeRepository;

	    $this->middleware('dashboard');
	    $this->shareSidebar();
	}

	/**
	 * Generate an assembly list.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function assemblyList(Request $request, $inline = true)
	{
		/** @var Assembly $assembly */
		$assembly = $this->repository->find($this->getResourceId());

		$pdf = PDF::loadView('dashboard::documents.assembly-list', $this->getDocumentData())
			->setPaper('a4')
			->setOrientation('landscape')
			->setOption('footer-center', sprintf('%s - Page [page]/[toPage]', $assembly->number))
			->setOption('footer-font-size', 10);

		if ($inline) {

			$filename = sprintf('%s.pdf', $assembly->getAssemblyListFileName());

			return $pdf->inline($filename);

		} else {

			$filename = sprintf('%s/assemblies/%s.pdf', storage_path('app'), $assembly->getAssemblyListFileName());

			if (file_exists($filename)) {
				unlink($filename);
			}

			$pdf->save($filename);

			return $filename;
		}
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
		/** @var Assembly $assembly */
		$assembly = $this->repository->find($this->getResourceId());

		$customerShipmentIds = $this->shipments->findWhere(
			[
				'assembly_number' => $assembly->number,
			]
		)->pluck('id')->toArray();

		/** @var Company $company */
		$company = $this->companies->first();

		$orderItemsConditions = [
			[
				function ($query) use ($customerShipmentIds) {
					/** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
					$query->whereIn('customer_shipment_id', $customerShipmentIds);
				},
				null,
				null,
			],

		];

		if ($hideBackOrder) {
			$orderItemsConditions['back_order'] = 0;
		}

		if ($hideCancelled) {
			$orderItemsConditions['cancelled'] = 0;
		}

		/** @var \Illuminate\Database\Eloquent\Collection $assemblyItems */
		$assemblyItems = $this->customerOrderItems->with(
			[
				'product',
				'customer',
				'customerShipment',
				'customerShipment.packageType',
				'customerOrder',
				'customerOrder.customer',
			]
		)->findWhere($orderItemsConditions);

		return compact(
			'company',
			'assembly',
			'assemblyItems'
		);
	}
}
