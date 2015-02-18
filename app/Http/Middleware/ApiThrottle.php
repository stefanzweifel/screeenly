<?php namespace Screeenly\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Config\Repository as Config;

use Cache;

class ApiThrottle {

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
	public function __construct(Application $app, Cache $cache, Config $config)
	{
		$this->app = $app;
		$this->cache = $cache;
		$this->config = $config;
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
	    $key             = $request->get('key');
	    $expiresAt       = Carbon::now()->addMinutes(60);
	    $requestsPerHour = $this->config->get('api.rateLimit');



	    if (Cache::has($key)) {

	        $current = Cache::get($key, 0);

	        if ($current >= $requestsPerHour) {
	            return $this->app->abort(429, 'Rate Limit reached');
	        }

	        Cache::put($key, $current + 1, $expiresAt);
	        return $next($request);

	    }

	    Cache::put($key, 1, $expiresAt);
		return $next($request);
	}

}
