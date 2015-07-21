<?php

namespace Screeenly\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use File;
use Storage;
use Screeenly\ApiLog;

class RemoveImagesCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'screeenly:clear:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove images older than 1 hours.';

    /**
     * Create a new command instance.
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
        $date = Carbon::now()->subHours(1);
        $logs = ApiLog::where('created_at', '<', $date)->get();

        foreach ($logs as $log) {
            $path = $log->images;
            File::delete($path);

            $log->delete();
        }

        $this->info('Removed '.count($logs).' Images.');

        // Removed images from try service
        $files = Storage::allFiles("images/try");
        Storage::delete($files);
    }
}
