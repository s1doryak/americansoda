<?php

namespace App\Events\Dashboard;

use App\CustomerOrder;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Illuminate\Database\Eloquent\Collection;

class CustomerOrderItemsAssigned implements ResourceEventInterface
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
     * @var CustomerOrder
     */
    private $customerOrder;

    /**
     * @var Collection
     */
    private $customerOrderItems;

    public function __construct(CustomerOrder $customerOrder, Collection $customerOrderItems, array $attributes, array $params)
    {
        $this->customerOrder      = $customerOrder;
        $this->customerOrderItems = $customerOrderItems;
        $this->attributes         = $attributes;
        $this->params             = $params;
    }

    public function getCustomerOrder()
    {
        return $this->customerOrder;
    }

    public function getCustomerOrderItems()
    {
        return $this->customerOrderItems;
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
        return 'customer_order_item';
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
