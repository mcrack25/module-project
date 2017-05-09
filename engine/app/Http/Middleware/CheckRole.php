<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() === null){
            return redirect()->route('login');
        }

        $actions = $request->route()->getAction();
        $access = isset($actions['roles']) ? $actions['roles'] : null;

        if($request->user()->role()->first() || !$access){

            if($request->user()->role()->first()->hasAnyAccess($access) || !$access){
                return $next($request);
            } else {
                abort(403);
            }

        } else {
            abort(403);
        }

        abort(403);
    }
}
