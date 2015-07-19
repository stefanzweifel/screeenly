<?php

namespace Screeenly\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'Screeenly\Console\Commands\Inspire',
        \Screeenly\Console\Commands\RemoveImagesCommand::class,
        \Screeenly\Console\Commands\MigrateApiKeys::class
    ];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('screeenly:clearImages')
				 ->hourly();
	}

}
