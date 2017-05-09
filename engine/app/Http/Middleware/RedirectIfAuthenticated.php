<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null){

        if (Auth::guard($guard)->check()) {

            /*  Проверяем указан ли у пользователя редирект.
                Есди пользователь указал 0 то отправим его на главную
                Иначе отправим его по тому редиректу который указан
                Если ничего не указано, то всёравно отправляем его на главную

                Тоже самое проделываем с ролью пользователя
            */
            $route_user = Auth::user()->routes;
            if(!empty($route_user)){

                if($route_user === 0){
                    return redirect()->route('index');
                }

                return redirect()->route($route_user->route);
            }

            $user_role = Auth::user()->role;
            if(!empty($user_role)){

                if(!empty($user_role->routes)){

                    if($user_role === 0){
                        return redirect()->route('index');
                    }

                    return redirect()->route($user_role->routes->route);
                }
            }

            return redirect()->route('index');
        }

        return $next($request);
    }
}
