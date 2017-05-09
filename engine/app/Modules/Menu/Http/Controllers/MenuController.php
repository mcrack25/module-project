<?php

namespace App\Modules\Menu\Http\Controllers;

use Caffeinated\Modules\Facades\Module;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index(){
        $module = Module::action('menu::show');
        dd($module);
    }
}
