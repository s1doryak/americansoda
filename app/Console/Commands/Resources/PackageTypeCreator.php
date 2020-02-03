<?php

namespace App\Console\Commands\Resources;

use App\PackageType;
use App\Repositories\Contracts\PackageTypeRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * PackageType resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class PackageTypeCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:package_type';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'package_type';

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
        PackageType $packageType,
        PackageTypeRepository $packageTypeRepository
    )
    {
        $this->model = $packageType;
        $this->repository = $packageTypeRepository;

        parent::__construct();
    }

    /**
     * @param PackageType $package_type
     * @return array
     */
    public function getEventAttributes($package_type)
    {
        return $package_type->getAttributes();
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return [];
    }
}
