<?php

namespace Screeenly\Providers;

use Illuminate\Support\ServiceProvider;
use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Guards\ScreeenlyTokenGuard;
use Screeenly\Services\AwsBrowser;
use Screeenly\Services\ChromeBrowser;

class ScreeenlyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['view']->addNamespace('screeenly', base_path().'/modules/Screeenly/Resources/views');

        if (config('screeenly.use_aws_lambda_browser') === true) {
            $this->app->bind(CanCaptureScreenshot::class, AwsBrowser::class);
        } else {
            $this->app->bind(CanCaptureScreenshot::class, ChromeBrowser::class);
        }

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
