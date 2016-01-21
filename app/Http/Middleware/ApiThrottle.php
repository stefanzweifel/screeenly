<?php

namespace Screeenly\Http\Middleware;

use Closure;
use Illuminate\Config\Repository as Config;
use Illuminate\Contracts\Cache\Repository as Cache;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class ApiThrottle
{
    /**
     * The config instance.
     *
     * @var Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Cache Implementation.
     *
     * @var Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * Create a new filter instance.
     *
     * @param Application $app
     */
    public function __construct(Config $config, Cache $cache)
    {
        $this->config = $config;
        $this->cache = $cache;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */

    /**
     * Source: http://fideloper.com/laravel-http-middleware.
     */
    public function handle($request, Closure $next)
    {
        $limit = $this->config->get('api.ratelimit.requests');
        $time = $this->config->get('api.ratelimit.time');

        // Rate limit by IP address
        $key = sprintf('api:%s', $request->get('key'));

        // Add if doesn't exist
        $this->cache->add($key, 0, $time);

        // Add to count
        $count = $this->cache->increment($key);

        if ($count > $limit) {
            throw new TooManyRequestsHttpException($time * 60, 'Rate limit exceed.');
        }

        return $next($request);
    }
}
