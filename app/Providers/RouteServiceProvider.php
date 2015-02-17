<?php namespace Screeenly\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'Screeenly\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		// Check if API Key is valid and exists
		$router->filter('api.auth', function() {

			if( !\User::getUserByKey( \Input::get('key') ) ) {
		        return \App::abort(401, 'Access denied.');
		    }

		});

		// RateLimit handling
		$router->filter('api.throttle', function() {

		    $key             = \Input::get('key');
		    $expiresAt       = Carbon\Carbon::now()->addMinutes(60);
		    $requestsPerHour = \Config::get('api.rateLimit');

		    if (\Cache::has($key)) {

		        $current = \Cache::get($key, 0);

		        if ($current >= $requestsPerHour) {
		            return \App::abort(429, 'Rate Limit reached');
		        }

		        return \Cache::put($key, $current + 1, $expiresAt);

		    }

		    return \Cache::put($key, 1, $expiresAt);

		});
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
