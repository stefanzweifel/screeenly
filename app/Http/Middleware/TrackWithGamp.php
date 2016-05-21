<?php

namespace Screeenly\Http\Middleware;

use Closure;
use GAMP;
use Uuid;

class TrackWithGamp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Check if the current Request has a "Do not Track"-Header.
         * If there's no header or the value is 0, we track the request.
         */
        if ($request->header('DNT', 0) == 0) {
            $this->sendAnalytics($request);
        }

        return $next($request);
    }


    /**
     * Send Analytics Events to Google Analytics
     *
     * Client-ID is a UUID (generated from the Client IP)
     * UserAgent is overriden with data from current request
     * @return void
     */
    public function sendAnalytics($request)
    {
        $clientIp = $request->server('REMOTE_ADDR', 'no-remote_addr');

        $gamp = GAMP::setClientId( Uuid::generate(5, $clientIp, Uuid::NS_DNS)->string );
        $gamp->setDocumentPath( "/" . $request->path() );
        $gamp->setDocumentReferrer($request->server('HTTP_REFERER', 'no-referrer'));
        $gamp->setIpOverride($clientIp);
        $gamp->setUserAgentOverride($request->server('HTTP_USER_AGENT', 'no-user_agent'));
        $gamp->sendPageview();

        $gamp->setEventCategory('Screenshot');
        $gamp->setEventAction('Create');
        $gamp->sendEvent();
    }
}
