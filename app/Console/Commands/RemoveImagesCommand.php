<?php namespace Screeenly\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Carbon\Carbon;
use Config, File;
use Screeenly\APILog;

class RemoveImagesCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'screeenly:clearImages';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove images older than 12 hours.';

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
		$date = Carbon::now()->subHours(12);
		$logs = APILog::where('created_at', '<', $date)->get();

        foreach ($logs as $log) {

            $path = $log->images;
            File::delete($path);

            $log->delete();
        }

        $this->info('Removed ' . count($logs) . ' Images.');

	}

}
