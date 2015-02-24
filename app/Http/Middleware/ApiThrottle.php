<?php namespace Screeenly\Http\Middleware;

use Closure;
use GrahamCampbell\Throttle\Throttle;
use Illuminate\Config\Repository as Config;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class ApiThrottle {


	/**
	 * The config instance
	 *
	 * @var Illuminate\Config\Repository
	 */
	protected $config;

    /**
     * The throttle instance.
     *
     * @var \GrahamCampbell\Throttle\Throttle
     */
    protected $throttle;


	/**
	 * Create a new filter instance.
	 * @param Application $app
	 * @return void
	 */
	public function __construct(Config $config, Throttle $throttle)
	{
		$this->config = $config;

		$this->throttle = $throttle;
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
		$limit = $this->config->get('api.rateLimit'); // request limit
		$time  = 60; // ban time in minutes

        if (false === $this->throttle->attempt($request, $limit, $time)) {
            throw new TooManyRequestsHttpException($time * 60, 'Rate limit exceed.');
        }

        return $next($request);
	}

}
