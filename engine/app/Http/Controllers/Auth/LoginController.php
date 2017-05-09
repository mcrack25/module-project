<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'getLogout']);
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    protected function redirectTo(){

        /*  Проверяем указан ли у пользователя редирект.
            Есди пользователь указал 0 то отправим его на главную
            Иначе отправим его по тому редиректу который указан
            Если ничего не указано, то всёравно отправляем его на главную

            Тоже самое проделываем с ролью пользователя
        */

        $route_user = Auth::user()->routes;
        if(!empty($route_user)){

            if($route_user === 0){
                return route('index');
            }

            return route($route_user->route);
        }

        $user_role = Auth::user()->role;
        if(!empty($user_role)){

            if(!empty($user_role->routes)){

                if($user_role === 0){
                    return route('index');
                }

                return route($user_role->routes->route);
            }
        }

        return route('index');
    }

    public function getLogout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('index');
    }
}
