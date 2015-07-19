<?php

namespace Screeenly\Console\Commands;

use Illuminate\Console\Command;
use Screeenly\ApiLog;
use Carbon\Carbon;

class ClearApiLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'screeenly:clear:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove API logs older than 1 month';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Remove no longer used logs');

        $difference = Carbon::parse("-1 months");
        $logs       = ApiLog::onlyTrashed()->where('deleted_at', '<', $difference)->latest()->forceDelete();

        $this->info('Done!');
    }
}
