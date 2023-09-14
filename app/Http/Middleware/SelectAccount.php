<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SelectAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $account_id = session()->get('account_id');
        if(!empty($account_id) && is_numeric($account_id)){
            return $next($request);
        }else{
            session()->flash('message', __('auth.selectAccount'));
            return redirect()->route('player.accounts');
        }


    }
}
