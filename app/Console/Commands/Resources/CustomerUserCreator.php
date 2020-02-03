<?php

namespace App\Console\Commands\Resources;

use App\CustomerUser;
use App\Repositories\Contracts\CustomerUserRepository;
use App\Repositories\Contracts\CustomerRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerUser resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerUserCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_user';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_user';

    /**
     * @var string
     */
    protected $action = 'store';

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * @var array
     */
    protected $findOrCreateData = [
        'customers' => 'name',
    ];

    public function __construct(
        CustomerUser $customerUser,
        CustomerUserRepository $customerUserRepository,
        CustomerRepository $customerRepository
    )
    {
        $this->model = $customerUser;
        $this->repository = $customerUserRepository;
        $this->customers = $customerRepository;

        parent::__construct();
    }

    /**
     * @param CustomerUser $customerUser
     * @return array
     */
    public function getEventAttributes($customerUser)
    {
        return $customerUser->getAttributes();
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return [];
    }
}
