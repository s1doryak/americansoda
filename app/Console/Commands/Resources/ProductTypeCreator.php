<?php

namespace App\Console\Commands\Resources;

use App\ProductType;
use App\Repositories\Contracts\ProductTypeRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * ProductType resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class ProductTypeCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:product_type';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'product_type';

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
        ProductType $productType,
        ProductTypeRepository $productTypeRepository
    )
    {
        $this->model = $productType;
        $this->repository = $productTypeRepository;

        parent::__construct();
    }

    /**
     * @param ProductType $productType
     * @return array
     */
    public function getEventAttributes($productType)
    {
        return $productType->getAttributes();
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return [];
    }
}
