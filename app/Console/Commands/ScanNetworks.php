<?php

namespace App\Console\Commands;

use App\Http\Controllers\ScanController;
use Illuminate\Console\Command;

class ScanNetworks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:networks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scannt alle Netzwerke die in der Datenbank registriert sind.';

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
        $instance = new ScanController();
        $instance->scanNetworks();
        return 0;
    }
}
