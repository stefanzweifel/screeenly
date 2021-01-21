<?php

use Carbon\Carbon;
use Screeenly\Models\ApiLog;

Artisan::command('screeenly:cleanup', function () {
    ApiLog::query()
        ->get()
        ->each(function (ApiLog $log) {

            $this->info("Delete Log #{$log->id}");

            try {
                $log->screenshot()->delete();
                $log->delete();
            } catch (Exception $e) {
                // $log->delete();
            }
        });
})->describe('Delete Screenshot Files older than 1 hour.');
