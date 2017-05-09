<?php

namespace App\Modules\Core\Http\Controllers;

use App\Modules\Core\Models\User;
use Caffeinated\Modules\Facades\Module;
use Illuminate\Http\Request;
use App\Modules\Admin\Http\Controllers\AdminController;

class UserController extends AdminController
{
    public function all(Request $request){

        $request_all = $request->all();

        $count_on_page = Module::config('core', 'count_on_page');
        $count_on_page_mass = Module::config('core', 'count_on_page_mass');

        if(isset($request_all['count_on_page'])){
            $this->validate($request, [
                'count_on_page' => 'required|numeric',
            ]);
            $count_on_page = $request_all['count_on_page'];
        }

        $search_text = '';
        if(isset($request_all['search_text'])){
            $search_text = $request_all['search_text'];
        }

        $sort_arrow = 'asc';
        if((isset($request_all['sort_arrow'])) and (in_array($request_all['sort_arrow'], ['asc', 'desc']))){
            $sort_arrow = $request_all['sort_arrow'];
        }

        $sort_name = 'id';
        if((isset($request_all['sort_name'])) and (in_array($request_all['sort_name'], ['id', 'email', 'name']))){
            $sort_name = $request_all['sort_name'];
        }

        $date_type = null;
        if((isset($request_all['date_type'])) and (in_array($request_all['date_type'], ['created_at', 'updated_at']))){
            $date_type = $request_all['date_type'];
        }

        $date_s = null;
        if(isset($request_all['date_s'])){
            $this->validate($request, [
                'date_s' => 'required|date|date_format:d.m.Y',
            ]);

            $date_s = $request_all['date_s'];
        }

        $date_po = null;
        if(isset($request_all['date_po'])){
            $this->validate($request, [
                'date_po' => 'required|date|date_format:d.m.Y',
            ]);
            $date_po = $request_all['date_po'];
        }

        $items = User::with('role')->OnDates($date_type, $date_s, $date_po)->Search($search_text)->orderBy($sort_name, $sort_arrow)->paginate($count_on_page);

        $data = [
            'items'=> $items,

            'count_on_page'=>$count_on_page,

            'sort_name'=>$sort_name,
            'sort_arrow'=>$sort_arrow,
            'search_text'=>$search_text,
            'date_type'=>$date_type,
            'date_s'=>$date_s,
            'date_po'=>$date_po,

            'count_list'=>$count_on_page_mass
        ];

        return view('core::admin.users.all', $data);
    }

    public function add(){
        return view('admin.users.add');
    }

    public function edit($id){
        echo 'ok';
    }

    public function delete($id){
        echo 'ok';
    }

    /* POST запросы */
    public function post_add(){
        echo 'ok';
    }

    public function post_edit($id){
        echo 'ok';
    }

    public function post_delete($id){
        echo 'ok';
    }
}
