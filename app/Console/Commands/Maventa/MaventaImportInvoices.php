<?php

namespace App\Console\Commands\Maventa;

use Crmplease\Maventa\Exceptions\Exception;
use Crmplease\Maventa\Maventa;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class MaventaImportInvoices
 * @package App\Console\Commands\Maventa
 */
class MaventaImportInvoices extends Command
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'maventa:import:invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Maventa invoices between dates.';

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
     * @throws Exception
     */
    public function handle()
    {
        $force = $this->option('force');
        $tiff = $this->option('tiff');

        /** @var \Illuminate\Support\Collection $invoices */
        $invoices = collect(
            $this->maventa->invoice_list_between_dates($this->argument('start'), $this->argument('end'), 2)
        );

        if ($force) {

            foreach ($invoices as $invoice) {

                if ($invoice->status !== 'OK') {
                    throw new Exception($invoice->status);
                }

                \App\Jobs\MaventaImportInvoice::dispatchNow($invoice->id, $tiff);
            }

            $this->info(sprintf('%d invoices imported.', $invoices->count()));

        } else {

            foreach ($invoices as $invoice) {

                if ($invoice->status !== 'OK') {
                    throw new Exception($invoice->status);
                }

                \App\Jobs\MaventaImportInvoice::dispatch($invoice->id, $tiff);
            }

            $this->info(sprintf('%d invoices scheduled to import.', $invoices->count()));

        }

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
            ['start', InputArgument::OPTIONAL, 'Start time for search, format YYYYMMDDHHMMSS.', now()->startOfDay()->format('YmdHis')],

            ['end', InputArgument::OPTIONAL, 'End time for search, format YYYYMMDDHHMMSS.', now()->endOfDay()->format('YmdHis')]
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
