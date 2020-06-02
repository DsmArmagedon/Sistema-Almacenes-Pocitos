<?php

namespace App\Http\Middleware;

use Closure;

class HeaderLogoutMiddleware
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
        $response = $next($request);
            $response->headers->set("Cache-Control","no-cache,no-store, must-revalidate");
            $response->headers->set("Pragma", "no-cache"); //HTTP 1.0
            // $response->headers->set("Expires"," Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        return $response;
    }
}
