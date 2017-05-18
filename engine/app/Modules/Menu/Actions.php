<?php

namespace App\Modules\Menu;

use App\Modules\Menu\Models\Menu;
use App\Modules\Admin\Http\Controllers\AdminController;

class Actions extends AdminController{

    public function show(){
        $menus = Menu::where(['parent_id' => 0])->orderBy('sort')->get();
        $data = [
            'menus' => $menus
        ];
        return view('menu::sidebar.sidebar', $data);
    }
}