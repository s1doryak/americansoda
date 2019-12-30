<?php

namespace App\Events\Dashboard;

use App\CustomerInvoice;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Illuminate\Support\Collection;

class CustomerInvoiceItemsAssigned implements ResourceEventInterface
{
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var CustomerInvoice
     */
    private $customerInvoice;

    /**
     * @var Collection
     */
    private $customerInvoiceItems;

    /**
     * CustomerInvoiceItemsAssigned constructor.
     * @param CustomerInvoice $customerInvoice
     * @param Collection $customerInvoiceItems
     * @param array $attributes
     * @param array $params
     */
    public function __construct(CustomerInvoice $customerInvoice, Collection $customerInvoiceItems, array $attributes, array $params)
    {
        $this->customerInvoice = $customerInvoice;
        $this->customerInvoiceItems = $customerInvoiceItems;
        $this->attributes = $attributes;
        $this->params = $params;
    }

    /**
     * @return CustomerInvoice
     */
    public function getCustomerInvoice()
    {
        return $this->customerInvoice;
    }

    /**
     * @return Collection
     */
    public function getCustomerInvoiceItems()
    {
        return $this->customerInvoiceItems;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return 'dashboard';
    }

    /**
     * @return string
     */
    public function getResource()
    {
        return 'customer_invoice_item';
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return 'customerInvoiceItemsAssigned';
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
