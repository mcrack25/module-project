<?php

namespace App\Modules\Core\Http\Controllers;

use App\Modules\Core\Http\Requests\Access\AddRequest;
use App\Modules\Core\Http\Requests\Access\AllRequest;
use App\Modules\Core\Http\Requests\Access\DeleteRequest;
use App\Modules\Core\Http\Requests\Access\EditRequest;
use App\Modules\Admin\Http\Controllers\AdminController;
use App\Modules\Core\Models\Access;
use App\Modules\Core\Models\Role;
use App\Modules\Core\Models\User;
use Caffeinated\Modules\Facades\Module;

class AccessController extends AdminController
{
    public function all(AllRequest $request){
        $request_all = $request->all();

        $count_on_page_config = Module::config('core', 'count_on_page');
        $count_on_page_mass = Module::config('core', 'count_on_page_mass');

        $count_on_page = (isset($request_all['count_on_page'])) ?  $request_all['count_on_page'] : $count_on_page_config;
        $search_text = (isset($request_all['search_text'])) ?  $request_all['search_text'] : '';
        $sort_arrow = (isset($request_all['sort_arrow'])) ?  $request_all['sort_arrow'] : 'asc';
        $sort_name = (isset($request_all['sort_name'])) ?  $request_all['sort_name'] : 'id';
        $date_type = (isset($request_all['date_type'])) ?  $request_all['date_type'] : null;
        $date_s = (isset($request_all['date_s'])) ?  $request_all['date_s'] : null;
        $date_po = (isset($request_all['date_po'])) ?  $request_all['date_po'] : null;

        $accesses = Access::OnDates($date_type, $date_s, $date_po)->Search(['ru_name'], $search_text)->orderBy($sort_name, $sort_arrow)->paginate($count_on_page);

        $data = [
            'accesses'=> $accesses,
            'count_on_page'=>$count_on_page,
            'sort_name'=>$sort_name,
            'sort_arrow'=>$sort_arrow,
            'search_text'=>$search_text,
            'date_type'=>$date_type,
            'date_s'=>$date_s,
            'date_po'=>$date_po,
            'count_list'=>$count_on_page_mass
        ];

        return view('core::admin.accesses.all', $data);
    }
}
