<?php namespace Screeenly\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use \Carbon\Carbon;
use APILog, Config;

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
	public function fire()
	{
		$date   = Carbon::now()->subHours(12);
		$images = APILog::where('created_at', '<', $date)->get();

        foreach($images as $image) {

            $path = public_path(Config::get('api.storage_path').$image->images);
            File::delete($path);

            $image->delete();
        }

        $this->info('Removed ' . count($images) . ' Images.');

	}

}
