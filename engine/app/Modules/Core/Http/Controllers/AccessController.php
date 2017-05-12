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
use Illuminate\Support\Facades\DB;

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

        $accesses = Access::OnDates($date_type, $date_s, $date_po)->Search(['name', 'ru_name'], $search_text)->orderBy($sort_name, $sort_arrow)->paginate($count_on_page);

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
    
    public function add(){
        return view('core::admin.accesses.add');
    }

    public function edit($id){
        $access = Access::findOrFail($id);
        $data = [
            'access' => $access
        ];
        return view('core::admin.accesses.edit', $data);
    }

    public function delete($id){
        $access = Access::findOrFail($id);
        $data = [
            'access' => $access,
        ];
        return view('core::admin.accesses.delete', $data);
    }

    /* POST запросы */
    public function post_add(AddRequest $request){
        $request_all = $request->all();
        Access::create($request_all);
        return redirect()->route('admin.access.all')->with('message', trans('core::accesses.message_add'));
    }

    public function post_edit(EditRequest $request, $id){
        $request_all = $request->all();

        $find_access = Access::findOrFail($id);
        $find_access->name = $request_all['name'];
        $find_access->ru_name = $request_all['ru_name'];
        $find_access->save();

        return redirect()->route('admin.access.edit', $id)->with('message', trans('core::accesses.message_edit'));
    }

    public function post_delete(DeleteRequest $request){
        $request_all = $request->all();
        $access_ids = $request_all['access_ids'];

        DB::transaction(function() use ($access_ids) {
            $roles = Role::all();
            foreach ($roles as $role) {
                foreach ($access_ids as $access_id) {
                    $role->access()->wherePivot('access_id', '=', $access_id)->detach();
                }
            }

            Access::whereIn('id', $access_ids)->delete();
        });

        return redirect()->route('admin.access.all')->with('message', trans('core::accesses.message_delete'));
    }
}
