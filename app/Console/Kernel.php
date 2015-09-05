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
        Commands\RemoveImagesCommand::class,
        Commands\ClearApiLogs::class
    ];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
        $url = env('SCHEDULER_PING_URL');

		$schedule->command('screeenly:clear:images')->hourly()->thenPing($url);
        $schedule->command('screeenly:clear:logs')->daily()->thenPing($url);
	}

}
