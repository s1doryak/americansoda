<?php

namespace App\Console\Commands\Resources;

use App\CustomerType;
use App\Repositories\Contracts\CustomerTypeRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerType resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerTypeCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_type';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_type';

    /**
     * @var string
     */
    protected $action = 'store';

    /**
     * @var CustomerTypeRepository
     */
    protected $customerTypes;

    /**
     * @var array
     */
    protected $findOrCreateData = [
        'customerTypes' => 'name',
    ];

    public function __construct(
        CustomerType $customerType,
        CustomerTypeRepository $customerTypeRepository
    )
    {
        $this->model = $customerType;
        $this->repository = $customerTypeRepository;
        $this->customerTypes = $customerTypeRepository;

        parent::__construct();
    }

    /**
     * @param CustomerType $customer_type
     * @return array
     */
    public function getEventAttributes($customer_type)
    {
        return $customer_type->getAttributes();
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return [];
    }
}
