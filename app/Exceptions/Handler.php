<?php

namespace Screeenly\Exceptions;

use Exception;
use Log;
use Mallinus\Exceptions\ExceptionHandler;
use Screeenly\Core\Exception\ScreeenlyException;
use Screeenly\Exceptions\Listeners\ScreeenlyExceptionListener;
use Slack;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        Symfony\Component\HttpKernel\Exception\HttpException::class,
        Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException::class,
        Screeenly\Exceptions\HostNotFoundException::class
    ];


    /**
     * A list of Exception Listeners and their corresponding Exception
     * This list is used by "mallinus/exceptions"
     *
     * @var array
     */
    protected $listen = [

        ScreeenlyExceptionListener::class => [
            ScreeenlyException::class
        ],

    ];


    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if (method_exists($e, 'getHeaders')) {
            $headers = $e->getHeaders();
        }

        $code = $this->getCode($e);

        if (!app()->environment('testing') && $code >= 500) {
            $this->sendSlackNotification($request, $e, $code);
        }

        /*
         * Handle API Errors
         */
        if ($request->is('api/v1/*') && $request->isMethod('post')) {
            $headers['Access-Control-Allow-Origin'] = '*';

            $returnMessage = [
                'title' => 'An error accoured',
                'message' => $e->getMessage(),
            ];

            if ($code < 100) {
                $code = 400;
            }

            return response()->json($returnMessage, $code, $headers);
        }

        /**
         * Global Exception Handler for API v2. If everything fails, respond
         * with a simple message.
         */
        if ($request->is("api/v2/*") && !$e instanceof ScreeenlyException) {

            $code = 500;
            if ($e->getCode() >= 400) {
                $code = $e->getCode();
            }

            $message = $e->getMessage();
            if (empty($message)) {
                $message = "Oops. An internal server error accoured";
            }

            return response()->json(
                [
                    "error" =>
                    [
                        [
                            "title" => "Application Error",
                            "detail" => $message,
                            "code" => $e->getCode(),
                            "meta" => [
                                "type"    => (new \ReflectionClass($e))->getShortName(),
                            ]
                        ]
                    ]
                ],
                $code,
                []
            );
        }

        return parent::render($request, $e);
    }

    /**
     * Return HTTP Status Code from given Exception.
     *
     * @param mixed $e
     *
     * @return itn
     */
    private function getCode($e)
    {
        if (method_exists($e, 'getStatusCode')) {
            return $e->getStatusCode();
        } elseif (method_exists($e, 'getCode')) {
            return $e->getCode();
        }

        return 400;
    }

    /**
     * Send a Slack Error Notification.
     *
     * @param Request   $request
     * @param Exception $e
     * @param int       $code
     */
    private function sendSlackNotification($request, $e, $code)
    {
        $attachment = [
            'fallback' => 'An error accoured on Screeenly',
            'text' => 'An error accoured on Screeenly',
            'color' => '#c0392b',
            'fields' => [
                [
                    'title' => 'Requested URL',
                    'value' => $request->url(),
                    'short' => true,
                ],
                [
                    'title' => 'HTTP Code',
                    'value' => $code,
                    'short' => true,
                ],
                [
                    'title' => 'Exception',
                    'value' => $e->getMessage(),
                    'short' => true,
                ],
                [
                    'title' => 'Input',
                    'value' => json_encode($request->all()),
                    'short' => true,
                ],
            ],
        ];

        Slack::attach($attachment)->send('Screeenly Error');
    }
}
