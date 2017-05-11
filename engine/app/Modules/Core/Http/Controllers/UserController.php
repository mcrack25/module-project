<?php

namespace App\Modules\Core\Http\Controllers;

use App\Modules\Core\Http\Requests\User\AddRequest;
use App\Modules\Core\Http\Requests\User\AllRequest;
use App\Modules\Core\Http\Requests\User\DeleteRequest;
use App\Modules\Core\Http\Requests\User\EditRequest;
use App\Modules\Core\Models\Role;
use App\Modules\Core\Models\User;
use Caffeinated\Modules\Facades\Module;
use App\Modules\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends AdminController{

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

        $users = User::with('role')->OnDates($date_type, $date_s, $date_po)->Search(['name', 'email'], $search_text)->orderBy($sort_name, $sort_arrow)->paginate($count_on_page);

        $data = [
            'users'=> $users,
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
        $roles = Role::all();

        $new_role = new Role();
        $new_role->id = 0;
        $new_role->ru_name = 'Без роли';
        $roles[] = $new_role;

        $data = [
            'roles'=>$roles
        ];
        return view('core::admin.users.add', $data);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::All();

        $new_role = new Role();
        $new_role->id = 0;
        $new_role->ru_name = 'Без роли';
        $roles[] = $new_role;

        $data = [
            'user'=>$user,
            'roles'=>$roles
        ];
        return view('core::admin.users.edit', $data);
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $data = [
            'user'=>$user
        ];
        return view('core::admin.users.delete', $data);
    }

    /* POST запросы */
    public function post_add(AddRequest $request){

        $request_all = $request->all();

        if($request_all['role_id'] == 0){
            $request_all['role_id'] = null;
        }

        $request_all['password'] = bcrypt($request_all['password']);

        User::create($request_all);
        return redirect()->route('admin.users.all')->with('message', trans('core::users.message_add'));
    }

    public function post_edit(EditRequest $request, $id){
        $request_all = $request->all();

        $find_user = User::findOrFail($id);
        $find_user->name = $request_all['name'];
        $find_user->email = $request_all['email'];
        $find_user->password = bcrypt($request_all['password']);

        if($request_all['role_id'] == 0){
            $find_user->role_id = null;
        } else {
            $find_user->role_id = $request_all['role_id'];
        }

        $find_user->save();

        return redirect()->route('admin.users.edit', $id)->with('message', trans('core::users.message_edit'));
    }

    public function post_delete(DeleteRequest $request){

        $user_id = Auth::user()->id;

        $request_all = $request->all();

        $where_in = $request_all['user_ids'];

        if(empty($where_in)){
            return redirect()->route('admin.users.all')->withErrors([trans('core::users.error_delete_empty')]);
        }

        $user_in_deleted = false;
        foreach($where_in as $key => $value){
            if($user_id == $value){
                unset($where_in[$key]);
                $user_in_deleted = true;
            }
        }

        $delete_me = Validator::make([],[]);
        if($user_in_deleted){
            $delete_me->errors()->add('delete_me', trans('core::users.error_delete_me'));
        }

        User::whereIn('id', $where_in)->delete();

        if(empty($where_in)){
            return redirect()->route('admin.users.all')->withErrors($delete_me);
        } else {
            return redirect()->route('admin.users.all')->withErrors($delete_me)->with('message', trans('core::users.message_delete'));
        }
    }
}
