<?php

namespace App\Services\Dashboard;

use App\Customer;
use App\PriceGroup;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Eloquent\CustomerRepositoryEloquent;
use Crmplease\MaterialAdmin\Services\ResourceService;

class CustomerService extends ResourceService
{
    /**
     * @var CustomerRepositoryEloquent
     */
    protected $repository;

    /**
     * @param CustomerRepository $companyRepository
     */
    public function __construct(
        CustomerRepository $companyRepository
    )
    {
        $this->repository = $companyRepository;
    }

    /**
     * @param Customer $customer
     * @param PriceGroup $priceGroup
     */
    public function applyPriceGroupToCustomer(Customer $customer, PriceGroup $priceGroup)
    {

    }
}
