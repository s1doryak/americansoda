<?php

namespace App\Console\Commands\Zendesk;

use App\Support\ZendeskHttpClient;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class ShowOrganizations extends Command
{
    protected $signature = 'zendesk:show:organizations';
    protected $description = 'Show list of all organization';

    protected $zendeskHttpClient;

    /**
     * ShowOrganizations constructor.
     * @param ZendeskHttpClient $zendeskHttpClient
     */
    public function __construct(ZendeskHttpClient $zendeskHttpClient)
    {
        parent::__construct();

        $this->zendeskHttpClient = $zendeskHttpClient;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $response = $this->zendeskHttpClient->getOrganizations();

        if (Arr::has($response, 'code')) {
            $this->warn($response['message']);
        } else {
            $this->showOrganizations($response);
        }
    }

    protected function showOrganizations(array $response)
    {
        $this->info('Existing organizations:'. PHP_EOL);

        foreach ($response['organizations'] as $organization) {
            $this->info("name = {$organization['name']}, id = {$organization['id']}");
        }
    }
}
