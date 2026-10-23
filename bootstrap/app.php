<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Exception\ProcessTimedOutException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../modules/Screeenly/Http/routes/console.php',
        then: function () {
            Route::middleware('web')
                ->group(base_path('modules/Screeenly/Http/routes/web.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('modules/Screeenly/Http/routes/api.php'));
        },
    )
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('screeenly:cleanup')->hourly();
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*', headers: Request::HEADER_X_FORWARDED_AWS_ELB);
        $middleware->throttleApi();
        $middleware->redirectUsersTo('/dashboard');

        $middleware->alias([
            'hasEmail' => \Screeenly\Http\Middleware\AccountHasEmailAddress::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontReport([
            ProcessTimedOutException::class,
            ProcessFailedException::class,
        ]);

        $exceptions->render(function (Throwable $e, Request $request) {
            // Keep the API's JSON error format: a generic 400 for everything
            // except authentication and validation errors.
            if (
                $request->is('api/*')
                && app()->environment('production', 'testing')
                && ! $e instanceof AuthenticationException
                && ! $e instanceof ValidationException
            ) {
                if ($request->is('api/v1/*')) {
                    return response()->json([
                        'title' => 'An error accoured',
                        'message' => 'An internal error accoured.',
                    ], 400);
                }

                return response()->json([
                    'errors' => [
                        $e->getMessage(),
                    ],
                ], 400);
            }
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/v1/*')) {
                return response()->json([
                    'title' => 'An error accoured',
                    'message' => 'No API Key specified.',
                ], 401);
            }

            if ($request->is('api/v2/*')) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            if (! $request->expectsJson()) {
                return null;
            }

            // The v1 error format is terrible, but changing it would break the API.
            if ($request->is('api/v1/*')) {
                return response()->json([
                    'title' => 'An error accoured',
                    'message' => 'Validation Error: '.collect($e->errors())->flatten()->first(),
                ], $e->status);
            }

            return response()->json($e->errors(), $e->status);
        });

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
