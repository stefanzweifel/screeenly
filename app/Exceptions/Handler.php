<?php namespace Screeenly\Exceptions;

use Exception, Slack, App, Log, Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException'
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $code = 0;

        if (method_exists($e, 'getHeaders')) {
            $headers = $e->getHeaders();
        }

        if (method_exists($e, 'getStatusCode')) {
            $code = $e->getStatusCode();
        }

        if ($code == 0) {
            $code = 400;
        }

        Log::error($e);

        $attachment = [
            'fallback' => 'An error accoured on Screeenly',
            'text'     => 'An error accoured on Screeenly',
            'color'    => '#c0392b',
            'fields' => [
                [
                    'title' => 'Requested URL',
                    'value' => $request->url(),
                    'short' => true
                ],
                [
                    'title' => 'HTTP Code',
                    'value' => $code,
                    'short' => true
                ],
                [
                    'title' => 'Exception',
                    'value' => $e->getMessage(),
                    'short' => true
                ],
                [
                    'title' => 'Input',
                    'value' => json_encode(\Input::all()),
                    'short' => true
                ]
            ]
        ];

        if (!App::environment('testing') && $code >= 500) {
            Slack::attach($attachment)->send('Screeenly Error');
        }

        /**
         * Handle API Errors
         */
        if ( $request->is('api/*') && $request->isMethod('post') ) {

            $headers['Access-Control-Allow-Origin'] = '*';

            $returnMessage = array(
                'title'   => 'An error accoured',
                'message' => $e->getMessage()
            );

            return Response::json($returnMessage, $code, $headers);

        }


        return parent::render($request, $e);

    }

}
