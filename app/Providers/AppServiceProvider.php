<?php

namespace Screeenly\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Validator::extend('available_url', 'Screeenly\Core\Validators\AvailableUrlValidator@validate');
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     */
    public function register()
    {
        $this->app->bind(
            Illuminate\Contracts\Auth\Registrar::class,
            Screeenly\Services\Registrar::class
        );

    }
}
