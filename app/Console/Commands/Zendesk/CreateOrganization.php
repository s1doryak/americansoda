<?php

namespace App\Console\Commands\Zendesk;

use App\Console\Commands\Zendesk\Traits\CreateCustomerOrganizationTrait;
use App\Repositories\Eloquent\CustomerRepositoryEloquent;
use App\Support\ZendeskHttpClient;
use Illuminate\Console\Command;
use Prettus\Repository\Exceptions\RepositoryException;

class CreateOrganization extends Command
{
    use CreateCustomerOrganizationTrait;

    protected $signature = 'zendesk:create:organization {name}';
    protected $description = 'Create organization by passed customer name';

    /**
     * CreateOrganization constructor.
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
     * @throws RepositoryException
     */
    public function handle()
    {
        $customer = $this->customerRepository->firstWhere([
            'name' => $this->argument('name')
        ]);

        if ($customer) {
            $this->createOrganizationByCustomer($customer);
        } else {
            $this->warn("Customer with name={$this->argument('name')} not exist in db");
        }
    }
}
