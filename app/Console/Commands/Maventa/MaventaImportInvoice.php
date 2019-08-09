<?php

namespace App\Console\Commands\Maventa;

use Crmplease\Maventa\Maventa;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MaventaImportInvoice extends Command
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'maventa:import:invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Maventa invoice.';

    /**
     * @var Maventa
     */
    protected $maventa;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Maventa $maventa)
    {
        $this->maventa = $maventa;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $method = 'dispatch';

        if ($this->option('force')) {
            $method = 'dispatchNow';
        }

        call_user_func_array([\App\Jobs\MaventaImportInvoice::class, $method], [$this->argument('id'), $this->option('tiff')]);

        $this->info('Invoice scheduled to import.');

        return true;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['id', InputArgument::REQUIRED, 'Start time for search, format YYYYMMDDHHMMSS.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Force import without scheduling.'],

            ['tiff', 't', InputOption::VALUE_NONE, 'Import TIFF invoice image.'],
        ];
    }
}
