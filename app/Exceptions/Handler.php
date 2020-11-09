<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
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
