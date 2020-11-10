<?php

namespace App\Console\Commands\Zendesk\Traits;

use App\Customer;
use App\Repositories\Contracts\CustomerRepository;
use App\Support\ZendeskHttpClient;
use Illuminate\Support\Arr;

trait CreateCustomerOrganizationTrait
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var ZendeskHttpClient
     */
    protected $zendeskHttpClient;

    /**
     * @param Customer $customer
     */
    protected function createOrganizationByCustomer(Customer $customer)
    {
        $response = $this->zendeskHttpClient->createOrganization($customer->name);

        if (Arr::has($response, 'code')) {
            $this->warn($this->getErrorMessage($customer, $response));
        } else {
            $this->customerRepository->updateWhere(
                ['name' => $customer->name],
                ['zendesk_id' => $response['organization']['id']]
            );
            $this->info("Zendesk id = {$response['organization']['id']} stored for {$customer->name}");
        }
    }

    /**
     * @param Customer $customer
     * @param array $response
     * @return string
     */
    protected function getErrorMessage(Customer $customer, array $response)
    {
        return sprintf(
            "Cannot create organization with name = %s. Status = %s. Message:\n%s",
            $customer->name,
            $response['code'],
            $response['message']
        );
    }
}
