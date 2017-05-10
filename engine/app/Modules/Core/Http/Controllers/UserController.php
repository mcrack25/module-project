<?php

namespace App\Modules\Core\Http\Controllers;

use App\Modules\Core\Models\Role;
use App\Modules\Core\Models\User;
use Caffeinated\Modules\Facades\Module;
use Illuminate\Http\Request;
use App\Modules\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function post_add(Request $request){
        $request_all = $request->all();

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|numeric',
        ]);

        if($request_all['role_id'] == 0){
            $request_all['role_id'] = null;
        }

        $request_all['password'] = bcrypt($request_all['password']);

        User::create($request_all);
        return redirect()->route('admin.users.all')->with('message', trans('core::users.message_add'));
    }

    public function post_edit(Request $request, $id){
        $request_all = $request->all();

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email' . ',' . $id,
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|numeric',
        ]);

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

    public function post_delete(Request $request){

        $user_id = Auth::user()->id;

        $this->validate($request, [
            'user_ids.*' => 'required|numeric',
        ]);

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
