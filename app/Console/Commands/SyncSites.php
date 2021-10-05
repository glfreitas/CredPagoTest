<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SitesController;

class SyncSites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Sync:Sites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronizar sites';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitesController = new SitesController();
        $sitesController->testSites();

        $this->info('Sites sincronizados.');
    }
}