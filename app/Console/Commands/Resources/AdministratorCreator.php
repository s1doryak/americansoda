<?php

namespace App\Console\Commands\Resources;

use App\Administrator;
use App\Repositories\Contracts\AdministratorRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\CompanyRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;
use Illuminate\Support\Carbon;

/**
 * Administrator resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class AdministratorCreator extends ResourceCreator
{
    protected $name = 'resource:create:administrator';

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
        Administrator $administrator,
        AdministratorRepository $administratorRepository,
        RoleRepository $roleRepository,
        CompanyRepository $companyRepository
    )
    {
        $this->resource = $administrator;
        $this->repository = $administratorRepository;
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
        return 'administrator';
    }

    /**
     * @param Administrator $administrator
     * @return array
     */
    public function getEventAttributes($administrator)
    {
        return $administrator->getAttributes();
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
