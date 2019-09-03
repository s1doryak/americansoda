<?php

namespace App\Listeners\Dashboard;

use App\Customer;
use App\CustomerInvoice;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\MaterialAdmin\Events\ResourceDestroyed;
use Crmplease\MaterialAdmin\Events\ResourceRestored;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\ResourceTrashed;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Jenssegers\Date\Date;

/**
 * SetupCustomerInvoiceAttributes listener.
 *
 * @package App\Listeners\Dashboard
 */
class SetupCustomerInvoiceAttributes
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var CustomerRepository
     */
    protected $customers;

    /**
     * @var CustomerInvoiceRepository
     */
    protected $customerInvoices;

    /**
     * SetupCustomerInvoiceAttributes constructor.
     * @param CustomerRepository $customerRepository
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     */
    public function __construct(
        CustomerRepository $customerRepository,
        CustomerInvoiceRepository $customerInvoiceRepository
    )
    {
        $this->customers = $customerRepository;
        $this->customerInvoices = $customerInvoiceRepository;
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
        $customerInvoice = $this->customerInvoices
            ->with(['customer', 'customerOrderItems', 'customerOrderItems.customerOrder'])
            ->scopeQuery(
                function ($query) {
                    return $query->withTrashed();
                }
            )
            ->find($attributes['id']);

        /** @var Customer $customer */
        $customer = $this->customers->scopeQuery(
            function ($query) {
                return $query->withTrashed();
            }
        )->find($params['customer']);

        $payment_days = (integer)preg_replace('/[^\d-]/', '', $customer->payment_conditions);

        $date = Date::parse($customerInvoice->date);
        $date_due = Date::parse($customerInvoice->date)->addDays($payment_days);

        $customerInvoice->update([
            'maventa_initiated' => false,

            'currency' => 'EUR',
            'data' => null,
            'date' => $date->format('Ymd'),
            'date_due' => $date_due->format('Ymd'),
            'delivery_date' => null,
            'delivery_type' => null,
            'error_message' => null,
            'invoice_delivery_address' => null,
            'invoice_nr' => $customerInvoice->invoice_nr,
            'invoice_seller_information' => null,
            'lang' => 'FI',
            'notes' => $customerInvoice->notes,
            'order_nr' => $customerInvoice->customerShipment ? $customerInvoice->customerShipment->order_numebrs : $customerInvoice->order_nr,
            'payment_terms' => $customer->payment_conditions,
            'reference_nr' => $customerInvoice->generateReferenceNumber(),
            'state' => null,
            'status' => null,
            // 'sum' => 0.00,
            // 'sum_tax' => 0.00,
            'work_order_nr' => null,

            'company_interest' => 8.0,
            'company_paper_fee' => 0.0,
            'company_reminder' => 0.0,
            'company_comment' => $customerInvoice->company_comment,
            'company_reference' => $customerInvoice->customerShipment ? $customerInvoice->customerShipment->number : $customerInvoice->company_reference,

            'customer_nr' => $customer->nr,
            'customer_email' => $customer->email,
            'customer_name' => $customer->name,
            'customer_country' => $customer->country,
            'customer_state' => $customer->state,
            'customer_post_code' => $customer->post_code,
            'customer_post_office' => $customer->post_office,
            'customer_address1' => $customer->address1,
            'customer_address2' => $customer->address2,
            'customer_contact_p' => $customer->contact_p,
            'customer_bid' => $customer->bid,
            'customer_ovt' => $customer->ovt,
        ]);

        if ($e instanceof ResourceTrashed) {

            // ..
        }

        if ($e instanceof ResourceDestroyed) {

            // ...
        }

        if ($e instanceof ResourceRestored) {

            // ...
        }

        if ($e instanceof ResourceStored) {

            // ...
        }

        return;
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
