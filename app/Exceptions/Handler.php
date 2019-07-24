<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\Process\Exception\ProcessTimedOutException::class,
        \Symfony\Component\Process\Exception\ProcessFailedException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            // app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->is('api/*')
            && (app()->environment('production')) || app()->environment('testing')
            && ! is_a($exception, AuthenticationException::class)
            && ! is_a($exception, ValidationException::class)
        ) {
            if ($request->is('api/v1/*')) {
                return response()->json([
                    'title' => 'An error accoured',
                    'message' => 'An internal error accoured.',
                ], 400);
            }

            return response()->json([
                'errors' => [
                    $exception->getMessage(),
                ],
            ], 400);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->is('api/v1/*')) {
            return response()->json([
                'title' => 'An error accoured',
                'message' => 'No API Key specified.',
            ], 401);
        } elseif ($request->is('api/v2/*')) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Exception  $e
     * @return mixed
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        if (config('app.debug')) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

            return response()->make(
                $whoops->handleException($e),
                method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
                method_exists($e, 'getHeaders') ? $e->getHeaders() : []
            );
        }

        return parent::convertExceptionToResponse($e);
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        // Override JSON Error Response for API v1
        // It's a terrible format but I don't want to break the API ¯\_(ツ)_/¯
        if ($request->is('api/v1/*')) {
            $json = [
                'title'   => 'An error accoured',
                'message' => 'Validation Error: '.collect($exception->errors())->flatten()->first(),
            ];
        } else {
            $json = $exception->errors();
        }

        return response()->json($json, $exception->status);
    }
}
