<?php

namespace App\Listeners\Dashboard;

use App\CustomerInvoice;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\StockProductRepository;
use App\Repositories\Eloquent\CustomerInvoiceRepositoryEloquent;
use App\Repositories\Eloquent\StockProductRepositoryEloquent;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;

class RemoveStockProductAfterInvoice
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var StockProductRepositoryEloquent
     */
    protected $stockProductRepository;

    /**
     * @var CustomerInvoiceRepositoryEloquent
     */
    protected $customerInvoiceRepository;

    public function __construct(
        StockProductRepository $stockProductRepository,
        CustomerInvoiceRepository $customerInvoiceRepository
    )
    {
        $this->stockProductRepository = $stockProductRepository;
        $this->customerInvoiceRepository = $customerInvoiceRepository;
    }

    /**
     * @param ResourceEventInterface $e
     * @return void
     */
    public function handle(ResourceEventInterface $e)
    {
        if (!$this->isValidNamespace($e->getNamespace())) {
            return;
        }

        if (!$this->isValidResource($e->getResource())) {
            return;
        }

        $attributes = $e->getAttributes();
        $params = $e->getParams();

        /** @var CustomerInvoice $customerInvoice */
        $customerInvoice = $this->customerInvoiceRepository
            ->scopeQuery(
                function ($query) {
                    /** @var \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query */
                    return $query->withTrashed();
                }
            )
            ->with('customerInvoiceItems')
            ->find($attributes['id']);
        $customerOrderItemIds = $customerInvoice
            ->customerInvoiceItems
            ->pluck('customer_order_item_id')
            ->toArray();

        if ($customerOrderItemIds) {
            $this->stockProductRepository->destroyWhereIn('customer_order_item_id', $customerOrderItemIds);
        }
    }

    /**
     * @return array
     */
    protected function getValidNamespaces()
    {
        return [
            'dashboard',
        ];
    }

    /**
     * @return array
     */
    protected function getValidResources()
    {
        return [
            'customer_invoice',
        ];
    }
}
