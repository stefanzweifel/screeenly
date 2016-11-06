<?php

namespace Screeenly\Providers;

use Illuminate\Support\ServiceProvider;
use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Guards\ScreeenlyTokenGuard;
use Screeenly\Services\PhantomsJsBrowser;


class ScreeenlyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CanCaptureScreenshot::class, PhantomsJsBrowser::class);

        auth()->extend('screeenly-token', function ($app, $name, array $config) {
            return new ScreeenlyTokenGuard(
                auth()->createUserProvider($config['provider']),
                $this->app['request']
            );
        });


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
