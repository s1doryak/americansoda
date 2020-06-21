<?php

namespace App\Listeners\Dashboard;

use App\CustomerInvoice;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesAction;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;

/**
 * Class SetCustomerShipmentInvoiceStatus
 *
 * @package App\Listeners\Dashboard
 */
class SetCustomerShipmentInvoiceStatus
{
    use ValidatesResource, ValidatesNamespace, ValidatesAction;

    /**
     * @var CustomerShipmentRepository
     */
    protected $customerShipmentRepository;

    /**
     * @var CustomerInvoiceRepository
     */
    protected $customerInvoiceRepository;

    /**
     * UpdateCustomerShipmentStatus constructor.
     * @param CustomerShipmentRepository $customerShipmentRepository
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     */
    public function __construct(
        CustomerShipmentRepository $customerShipmentRepository,
        CustomerInvoiceRepository $customerInvoiceRepository
    )
    {
        $this->customerShipmentRepository = $customerShipmentRepository;
        $this->customerInvoiceRepository = $customerInvoiceRepository;
    }

    /**
     * @param ResourceEventInterface $e
     * @return void
     */
    public function handle(ResourceEventInterface $e)
    {
        if (!$this->isValidResource($e->getResource())) {
            return;
        }

        if (!$this->isValidNamespace($e->getNamespace())) {
            return;
        }

        if (!$this->isValidAction($e->getAction())) {
            return;
        }

        $attributes = $e->getAttributes();

        /** @var CustomerInvoice $customerInvoice */
        $customerInvoice = $this->customerInvoiceRepository
            ->scopeQuery(
                function ($query) {
                    return $query->withTrashed();
                }
            )
            ->find($attributes['id']);

        if ($customerInvoice->customer_shipment_id) {
            $this->customerShipmentRepository->update([
                'status' => 'invoice'
            ], $customerInvoice->customer_shipment_id);
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

    /**
     * @return array
     */
    protected function getValidActions()
    {
        return [
            'invoice',
            'customerInvoiceEmailSended'
        ];
    }
}
