<?php namespace Screeenly\Http\Middleware;

use Closure;
use Screeenly\User;
use Illuminate\Foundation\Application;

class ApiAuth {

	/**
	 * Application implementation
	 * @var Illuminate\Foundation\Application
	 */
	protected $app;

	/**
	 * Create a new filter instance.
	 * @param Application $app
	 * @return void
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$key = $request->get('key');

		if ( !User::getUserByKey($key) ) {

			return $this->app->abort(401, 'Access denied.');

		}

		return $next($request);
	}

}
