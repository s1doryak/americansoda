<?php

namespace App\Console\Commands\Resources;

use App\User;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\CompanyRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;
use Illuminate\Support\Carbon;

/**
 * User resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class UserCreator extends ResourceCreator
{
    protected $name = 'resource:create:user';

	/**
	 * @var RoleRepository
	 */
	protected $roles;

	/**
	 * @var CompanyRepository
	 */
	protected $companies;


	/**
	 * @var array
	 */
	protected $findOrCreateData = [
		'roles' => 'name',
		'companies' => 'name',
	];

	public function __construct(
	    User $user,
		UserRepository $userRepository,
		RoleRepository $roleRepository,
		CompanyRepository $companyRepository
	)
	{
	    $this->resource = $user;
		$this->repository = $userRepository;
		$this->roles = $roleRepository;
		$this->companies = $companyRepository;

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
		return 'user';
	}

    /**
     * @return string
     */
    public function getEventAction()
    {
        return 'store';
    }

	/**
	 * @param User $user
	 * @return array
	 */
	public function getEventAttributes($user)
	{
		return $user->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}

    /**
     * @param string $value
     * @return \Illuminate\Support\Carbon
     * @throws \Exception
     */
    public function parseEmailVerifiedAtOption($value)
    {
        switch ($value) {
            case 'now':
            case 'now()':
                return now();
            default:
                return new Carbon($value);
        }
    }
}
