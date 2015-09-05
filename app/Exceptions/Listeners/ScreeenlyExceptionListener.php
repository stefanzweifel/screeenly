<?php

namespace Screeenly\Exceptions\Listeners;

use Exception;
use ReflectionClass;
use Mallinus\Exceptions\ExceptionListener;

class ScreeenlyExceptionListener implements ExceptionListener
{
    protected $headers = [

    ];

    public function handle(Exception $exception)
    {
        return response()->json(
            [
                "error" =>
                [
                    [
                        "title" => "Screeenly Error",
                        "detail" => $exception->getMessage(),
                        "status"    => $exception->getCode(),
                        "meta" => [
                            "type"    => $this->getType($exception),
                        ]
                    ]
                ]
            ],
            $this->getCode($exception),
            $this->headers
        );
    }

    /**
     * Return Class name without namespace
     * @param  Exception $exception
     * @return string
     */
    protected function getType(Exception $exception)
    {
        return (new ReflectionClass($exception))->getShortName();
    }

    /**
     * Always returns a HTTP client error
     * @param  Exception $exception
     * @return integer
     */
    protected function getCode(Exception $exception)
    {
        if ($exception->getCode() < 500) {
            return $exception->getCode();
        }

        return 400;
    }
}
