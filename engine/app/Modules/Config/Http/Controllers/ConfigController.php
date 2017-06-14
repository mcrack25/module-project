<?php

namespace App\Modules\Config\Http\Controllers;

use Caffeinated\Modules\Facades\Module;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function show(){
        $all = Module::action('config::getAll');

        $data = [
            'configs'=> $all
        ];

        return view('config::show',$data);
    }

    public function post_save(Request $request){
        $request_all = $request->all();
        if(isset($request_all['_token'])){
            unset($request_all['_token']);
        }

        Module::action('config::set', ['items' => $request_all]);

        return redirect()->back()->with('message', 'Конфигурация системы успешно сохранена');
    }
}
