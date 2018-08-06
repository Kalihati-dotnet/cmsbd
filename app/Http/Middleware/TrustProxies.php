<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Fideloper\Proxy\TrustProxies as Middleware;
// extends Middleware
class TrustProxies 
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    // protected $headers = Request::HEADER_X_FORWARDED_ALL;
    protected $headers = [
        Request::HEADER_FORWARDED => 'FORWARDED',
        Request::HEADER_X_FORWARDED_FOR => 'X_FORWARDED_FOR',
        Request::HEADER_X_FORWARDED_HOST => 'X_FORWARDED_HOST',
        Request::HEADER_X_FORWARDED_PORT => 'X_FORWARDED_PORT',
        Request::HEADER_X_FORWARDED_PROTO => 'X_FORWARDED_PROTO',
        Request::HEADER_X_FORWARDED_ALL,
    ];

    public function handle(Request $request, Closure $next)
    {
       // $request::setTrustedProxies([], $this->headers); // Reset trusted proxies between requests
        //dd($this->headers);
        $this->setTrustedProxyIpAddresses($request);

        return $next($request);
    }

    /**
     * Sets the trusted proxies on the request to the value of proxies
     *
     * @param \Illuminate\Http\Request $request
     */
    protected function setTrustedProxyIpAddresses(Request $request)
    {
        $trustedIps = $this->proxies;

        // Only trust specific IP addresses
        if (is_array($trustedIps)) {
            return $request->setTrustedProxies((array) $trustedIps, $this->headers);
        }

        // Trust any IP address that calls us
        // `**` for backwards compatibility, but is depreciated
        if ($trustedIps === '*' || $trustedIps === '**') {
            return $request->setTrustedProxies([$request->server->get('REMOTE_ADDR')], $this->headers);
        }
    }
   
   
}