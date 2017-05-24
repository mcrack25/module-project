<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Core\Models\User;
use Caffeinated\Modules\Facades\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller{

    public function index(){

        $user = Auth::user();

        $data = [
            'user' => $user
        ];

        return view('admin::index', $data);
    }

}
