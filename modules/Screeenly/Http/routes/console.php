<?php

use Carbon\Carbon;
use Screeenly\Models\ApiLog;


Artisan::command('screeenly:cleanup', function () {

    ApiLog::where('created_at', '<', Carbon::now()->subHours(1))->get()->each(function ($log) {
        try {
            $log->screenshot()->delete();
            $log->delete();
        } catch (Exception $e) {
            $log->delete();
        }
    });

})->describe('Delete Screenshot Files older than 1 hour.');
