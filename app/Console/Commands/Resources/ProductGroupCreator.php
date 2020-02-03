<?php

namespace App\Console\Commands\Resources;

use App\ProductGroup;
use App\Repositories\Contracts\ProductGroupRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;
use App\Repositories\Contracts\ProductTypeRepository;

/**
 * ProductGroup resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class ProductGroupCreator extends ResourceCreator
{
    /**
     * @var string
     */
    protected $name = 'resource:create:product_group';

    /**
     * @var string
     */
    protected $namespace = 'cli';

    /**
     * @var string
     */
    protected $resource = 'product_group';

    /**
     * @var string
     */
    protected $action = 'store';

    /**
     * @var ProductTypeRepository
     */
    protected $productTypes;

    /**
     * @var array
     */
    protected $findOrCreateData = [
        'productTypes' => 'name',
    ];

    public function __construct(
        ProductGroup $productGroup,
        ProductGroupRepository $productGroupRepository,
        ProductTypeRepository $productTypeRepository
    )
    {
        $this->model = $productGroup;
        $this->repository = $productGroupRepository;
        $this->productTypes = $productTypeRepository;

        parent::__construct();
    }

    /**
     * @param ProductGroup $product_group
     * @return array
     */
    public function getEventAttributes($product_group)
    {
        return $product_group->getAttributes();
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return [];
    }
}
