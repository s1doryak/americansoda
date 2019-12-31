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
    /**
     * @var string
     */
    protected $name = 'resource:create:role';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'role';

    /**
     * @var string
     */
    protected $action = 'store';

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
        $this->model = $role;
        $this->repository = $roleRepository;

        parent::__construct();
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
