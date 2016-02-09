<?php

namespace Screeenly\Exceptions\Catcher;

use Exception;
use Mallinus\Exceptions\Catcher;
use Mallinus\Exceptions\Contracts\ExceptionCatcher;

class ScreeenlyExceptionCatcher extends Catcher implements ExceptionCatcher
{
    /**
     * UnprocessableEntityCatcher constructor.
     */
    public function __construct()
    {
        parent::__construct(422);
    }

    public function handle(Exception $exception)
    {
        return response()->json([
            'error' => [
                [
                    'title'     => 'Screeenly Error',
                    'detail'    => $exception->getMessage(),
                    'status'    => $this->getHttpCode(),
                    'meta'      => [
                        'type'    => get_class($exception),
                    ],
                ],
            ],
        ], $this->getHttpCode(), $this->getHeaders());
    }
}
