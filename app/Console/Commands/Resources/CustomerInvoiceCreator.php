<?php

namespace App\Console\Commands\Resources;

use App\CustomerInvoice;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerShipmentRepository;
use App\Repositories\Contracts\CompanyBankAccountRepository;
use App\Repositories\Contracts\CustomerInvoiceItemRepository;
use App\Repositories\Contracts\CustomerInvoiceActionRepository;
use App\Repositories\Contracts\CustomerInvoiceAttachmentRepository;
use App\Repositories\Contracts\CustomerOrderItemRepository;
use Crmplease\MaterialAdmin\Console\Commands\Resources\ResourceCreator;

/**
 * CustomerInvoice resource creator.
 *
 * @package App\Console\Commands\Resources
 */
class CustomerInvoiceCreator extends ResourceCreator
{
    protected $name = 'resource:create:customer_invoice';

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * @var CustomerShipmentRepository
     */
    protected $customerShipments;

    /**
     * @var CompanyBankAccountRepository
     */
    protected $companyBankAccounts;

    /**
     * @var CustomerInvoiceItemRepository
     */
    protected $customerInvoiceItems;

    /**
     * @var CustomerInvoiceActionRepository
     */
    protected $customerInvoiceActions;

    /**
     * @var CustomerInvoiceAttachmentRepository
     */
    protected $customerInvoiceAttachments;

    /**
     * @var CustomerOrderItemRepository
     */
    protected $customerOrderItems;

    /**
     * @var array
     */
    protected $findOrCreateData = [
        'companyBankAccounts' => 'iban',
        'customers' => 'name',
        'customerShipments' => 'number',
        'customerInvoiceItems' => 'item_code',
        'customerInvoiceActions' => 'action',
        'customerInvoiceAttachments' => 'filename',
        'customerOrderItems' => 'product_name',
    ];

    public function __construct(
        CustomerInvoice $customerInvoice,
        CustomerInvoiceRepository $customerInvoiceRepository,
        CustomerRepository $customerRepository,
        CustomerShipmentRepository $customerShipmentRepository,
        CompanyBankAccountRepository $companyBankAccountRepository,
        CustomerInvoiceItemRepository $customerInvoiceItemRepository,
        CustomerInvoiceActionRepository $customerInvoiceActionRepository,
        CustomerInvoiceAttachmentRepository $customerInvoiceAttachmentRepository,
        CustomerOrderItemRepository $customerOrderItemRepository
    )
    {
        $this->resource = $customerInvoice;
        $this->repository = $customerInvoiceRepository;
        $this->customers = $customerRepository;
        $this->customerShipments = $customerShipmentRepository;
        $this->companyBankAccounts = $companyBankAccountRepository;
        $this->customerInvoiceItems = $customerInvoiceItemRepository;
        $this->customerInvoiceActions = $customerInvoiceActionRepository;
        $this->customerInvoiceAttachments = $customerInvoiceAttachmentRepository;
        $this->customerOrderItems = $customerOrderItemRepository;

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
        return 'customer_invoice';
    }

    /**
     * @param CustomerInvoice $customerInvoice
     * @return array
     */
    public function getEventAttributes($customerInvoice)
    {
        return $customerInvoice->getAttributes();
    }

    /**
     * @return array
     */
    public function getEventParams()
    {
        return [];
    }
}
