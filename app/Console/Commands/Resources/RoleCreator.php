<?php

namespace App\Console\Commands\Resources;

use App\Role;
use App\Repositories\Contracts\RoleRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * Role resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class RoleCreator extends ResourceCreator
{
    protected $name = 'resource:create:role';



	/**
	 * @var array
	 */
	protected $findOrCreateData = [

	];

	public function __construct(
	    Role $role,
		RoleRepository $roleRepository
	)
	{
	    $this->resource = $role;
		$this->repository = $roleRepository;

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
		return 'role';
	}

	/**
	 * @param Role $role
	 * @return array
	 */
	public function getEventAttributes($role)
	{
		return $role->getAttributes();
	}

	/**
	 * @return array
	 */
	public function getEventParams()
	{
		return [];
	}
}
