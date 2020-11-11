<?php

namespace App\Listeners\Dashboard;

use App\Repositories\Contracts\CustomerRepository;
use App\Support\ZendeskHttpClient;
use Crmplease\MaterialAdmin\Events\Interfaces\ResourceEventInterface;
use Crmplease\MaterialAdmin\Events\ResourceStored;
use Crmplease\MaterialAdmin\Events\ResourceUpdated;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesNamespace;
use Crmplease\MaterialAdmin\Events\Traits\ValidatesResource;

class CreateUpdateZendeskOrganization
{
    use ValidatesResource, ValidatesNamespace;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var ZendeskHttpClient
     */
    protected $zendeskHttpClient;

    /**
     * CreateUpdateZendeskOrganization constructor.
     * @param CustomerRepository $customerRepository
     * @param ZendeskHttpClient $zendeskHttpClient
     */
    public function __construct(
        CustomerRepository $customerRepository,
        ZendeskHttpClient $zendeskHttpClient)
    {
        $this->customerRepository = $customerRepository;
        $this->zendeskHttpClient = $zendeskHttpClient;
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

        if ($e instanceof ResourceStored) {
            $this->zendeskHttpClient->createOrganization($attributes['name']);
        }

        if ($e instanceof ResourceUpdated && $attributes['zendesk_id']) {
            $this->zendeskHttpClient->updateOrganization($attributes['zendesk_id'], [
                'name' => $attributes['name']
            ]);
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
            'customer',
        ];
    }
}
