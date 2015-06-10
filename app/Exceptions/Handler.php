<?php

namespace Screeenly\Exceptions;

use Exception;
use Slack;
use App;
use Log;
use Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
        'Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException',
        'Screeenly\Exceptions\HostNotFoundException',
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

        if (!App::environment('testing') && $code >= 500) {
            $this->sendSlackNotification($request, $e, $code);
        }

        /*
         * Handle API Errors
         */
        if ($request->is('api/*') && $request->isMethod('post')) {
            $headers['Access-Control-Allow-Origin'] = '*';

            $returnMessage = [
                'title' => 'An error accoured',
                'message' => $e->getMessage(),
            ];

            return Response::json($returnMessage, $code, $headers);
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
