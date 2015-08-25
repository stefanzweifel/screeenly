<?php

namespace Screeenly\Exceptions\Listeners;

use Exception;
use Mallinus\Exceptions\ExceptionListener;

class ScreeenlyExceptionListener implements ExceptionListener
{
    public function handle(Exception $exception)
    {
        return response()->json([
            'errors' => $exception->getMessage()
        ]);
    }
}