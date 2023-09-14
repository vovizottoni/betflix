<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CHeckHypetechIp
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!inLocalEnvironment()) {
            $ip = request()->ip();
            $hypeIps = ['146.190.216.123'];
            if (!in_array($ip, $hypeIps)) {
                abort(403);
            }

        }
        return $next($request);


    }
}
