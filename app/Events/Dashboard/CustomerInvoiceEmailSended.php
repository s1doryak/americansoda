<?php

namespace App\Events\Dashboard;

use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;

class CustomerInvoiceEmailSended implements ResourceEventInterface
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
     * CustomerInvoiceEmailSended constructor.
     * @param array $attributes
     * @param array $params
     */
    public function __construct(array $attributes, array $params)
    {
        $this->attributes = $attributes;
        $this->params = $params;
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
        return 'customer_invoice';
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return 'customerInvoiceEmailSended';
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
