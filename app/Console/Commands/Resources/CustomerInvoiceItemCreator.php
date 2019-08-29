<?php

namespace App\Console\Commands\Resources;

use App\CustomerInvoiceItem;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use App\Repositories\Contracts\ProductRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerInvoiceItem resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerInvoiceItemCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_invoice_item';

    /**
     * @var CustomerInvoiceRepository
     */
    protected $invoices;

    /**
     * @var CustomerOrderItemRepository
     */
    protected $orderItems;

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @var array
     */
    protected $findOrCreateData = [
        'invoices' => 'name',
        'orderItems' => 'name',
        'products' => 'name',

    ];

    public function __construct(
        CustomerInvoiceItem $customerInvoiceItem,
        CustomerInvoiceItemRepository $customerInvoiceItemRepository,
        CustomerInvoiceRepository $customerInvoiceRepository,
        CustomerOrderItemRepository $customerOrderItemRepository,
        ProductRepository $productRepository
    )
    {
        $this->resource = $customerInvoiceItem;
        $this->repository = $customerInvoiceItemRepository;
        $this->invoices = $customerInvoiceRepository;
        $this->orderItems = $customerOrderItemRepository;
        $this->products = $productRepository;

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
        return 'customer_invoice_item';
    }

    /**
     * @param CustomerInvoiceItem $customerInvoiceItem
     * @return array
     */
    public function getEventAttributes($customerInvoiceItem)
    {
        return $customerInvoiceItem->getAttributes();
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return [];
    }
}
