<?php

namespace App\Console\Commands\Resources;

use App\CustomerUserToken;
use App\Repositories\Contracts\CustomerUserTokenRepository;
use App\Repositories\Contracts\CustomerUserRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerUserToken resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerUserTokenCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:customer_user_token';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'customer_user_token';

    /**
     * @var string
     */
    protected $action = 'store';

	/**
	 * @var CustomerUserRepository
	 */
	protected $customerUsers;

	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'customerUsers' => 'name',
	];

	public function __construct(
	    CustomerUserToken $customerUserToken,
		CustomerUserTokenRepository $customerUserTokenRepository,
		CustomerUserRepository $customerUserRepository
	)
	{
	    $this->model = $customerUserToken;
		$this->repository = $customerUserTokenRepository;
		$this->customerUsers = $customerUserRepository;

        parent::__construct();
	}

	/**
	 * @param CustomerUserToken $customerUserToken
	 * @return array
	 */
	public function getEventAttributes($customerUserToken)
	{
		return $customerUserToken->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
