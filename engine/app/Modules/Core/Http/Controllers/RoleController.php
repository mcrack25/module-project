<?php

namespace App\Modules\Core\Http\Controllers;

use App\Modules\Core\Http\Requests\Role\AddRequest;
use App\Modules\Core\Http\Requests\Role\AllRequest;
use App\Modules\Core\Http\Requests\Role\DeleteRequest;
use App\Modules\Core\Http\Requests\Role\EditRequest;
use App\Modules\Admin\Http\Controllers\AdminController;
use App\Modules\Core\Models\Access;
use App\Modules\Core\Models\Role;
use App\Modules\Core\Models\User;
use Caffeinated\Modules\Facades\Module;
use Illuminate\Support\Facades\DB;

class RoleController extends AdminController
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

        $roles = Role::with('access')->OnDates($date_type, $date_s, $date_po)->Search(['ru_name'], $search_text)->orderBy($sort_name, $sort_arrow)->paginate($count_on_page);

        $data = [
            'roles'=> $roles,
            'count_on_page'=>$count_on_page,
            'sort_name'=>$sort_name,
            'sort_arrow'=>$sort_arrow,
            'search_text'=>$search_text,
            'date_type'=>$date_type,
            'date_s'=>$date_s,
            'date_po'=>$date_po,
            'count_list'=>$count_on_page_mass
        ];

        return view('core::admin.roles.all', $data);
    }

    public function add(){
        $access = Access::orderBy('ru_name')->get();
        $data = [
            'access' => $access
        ];
        return view('core::admin.roles.add', $data);
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        $access = Access::orderBy('ru_name')->get();
        $data = [
            'access' => $access,
            'role' => $role,
            'role_access' => $role->access,
        ];
        return view('core::admin.roles.edit', $data);
    }

    public function delete($id){

        $role = Role::findOrFail($id);
        $roles = Role::where('id', '<>', $id)->get();

        $new_role = new Role();
        $new_role->id = 0;
        $new_role->ru_name = 'Без роли';
        $roles[] = $new_role;

        $count_users = User::where('role_id', '=', $id)->count();

        $data = [
            'role' => $role,
            'roles' => $roles,
            'count_users' => $count_users,
        ];

        return view('core::admin.roles.delete', $data);
    }

    /* POST запросы */
    public function post_add(AddRequest $request){
        $request_all = $request->all();

        $role = new Role();
        $role->ru_name = $request_all['ru_name'];

        if($request_all['route_id'] == 0){
            $role->route_id = null;
        } else {
            $role->route_id = $request_all['route_id'];
        }

        $role->save();

        if(!empty($request_all['access'])) {
            foreach ($request_all['access'] as $key => $value) {
                $role->access()->attach(Access::where(['id' => $key])->first());
            }
        }

        return redirect()->route('admin.roles.all')->with('message', trans('core::roles.message_add'));
    }

    public function post_edit(EditRequest $request, $id){
        $request_all = $request->all();

        $roles = Role::findOrFail($id);
        $roles->ru_name = $request_all['ru_name'];
        if($request_all['route_id'] == 0){
            $roles->route_id = null;
        } else {
            $roles->route_id = $request_all['route_id'];
        }
        $roles->save();
        $roles->access()->detach();

        if(!empty($request_all['access'])){
            foreach($request_all['access'] as $key => $value){
                $roles->access()->attach(Access::where(['id'=> $key])->first());
            }
        }

        return redirect()->route('admin.roles.edit', $id)->with('message', trans('core::roles.message_edit'));
    }

    public function post_delete(DeleteRequest $request){
        $request_all = $request->all();
        $where_in = $request_all['role_ids'];

        if((!empty($request_all['role_id'])) and ($request_all['role_id'] != 0)){
            $role_id = $request_all['role_id'];
            DB::transaction(function() use ($where_in, $role_id) {
                User::whereIn('role_id', $where_in)->update(['role_id' => $role_id]);
                Role::whereIn('id', $where_in)->delete();
            });
            return redirect()->route('admin.roles.all')->with('message', trans('core::roles.message_delete_add_role'));
        } else {
            Role::whereIn('id', $where_in)->delete();
            return redirect()->route('admin.roles.all')->with('message', trans('core::roles.message_delete_simple'));
        }

    }
}
