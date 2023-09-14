<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class EhApostador
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
        if(Auth::check() && Auth::user()->role == 'player'){
            return $next($request);
        }else{
            if(Auth::check() && Auth::user()->role == 'admin'){
                return redirect('/admin/user/index');
            }
            return response()->json(["Você não tem permisão para acessa esta página"], 403);
        }
    }
}
