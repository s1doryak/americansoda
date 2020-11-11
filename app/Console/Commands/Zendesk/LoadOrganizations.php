<?php

namespace App\Console\Commands\Zendesk;

use App\Console\Commands\Zendesk\Traits\CreateCustomerOrganizationTrait;
use App\Customer;
use App\Repositories\Eloquent\CustomerRepositoryEloquent;
use App\Support\ZendeskHttpClient;
use Illuminate\Console\Command;

class LoadOrganizations extends Command
{
    use CreateCustomerOrganizationTrait;

    protected $signature = 'zendesk:load:organizations';
    protected $description = 'Load all customers from db to zendesk organizations';

    /**
     * LoadOrganizations constructor.
     * @param CustomerRepositoryEloquent $customerRepository
     * @param ZendeskHttpClient $zendeskHttpClient
     */
    public function __construct(CustomerRepositoryEloquent $customerRepository, ZendeskHttpClient $zendeskHttpClient)
    {
        parent::__construct();

        $this->customerRepository = $customerRepository;
        $this->zendeskHttpClient = $zendeskHttpClient;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $customers = $this->customerRepository->findWhere([
            'zendesk_id' => null
        ], 'name');

        /** @var Customer $customer */
        foreach ($customers as $customer) {
          $this->createOrganizationByCustomer($customer);
        }
    }


}
