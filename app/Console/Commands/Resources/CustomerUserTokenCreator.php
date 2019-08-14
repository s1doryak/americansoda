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
    protected $name = 'resource:create:customer_user_token';


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
	    $this->resource = $customerUserToken;
		$this->repository = $customerUserTokenRepository;
		$this->customerUsers = $customerUserRepository;

        parent::__construct();
	}

	/**
	 * @return string
	 */
	public function getEventNamespace()
	{
		return 'cli';
	}

	/**
	 * @return string
	 */
	public function getEventResource()
	{
		return 'customer_user_token';
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
