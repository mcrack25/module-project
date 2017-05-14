<?php

namespace App\Modules\Core\Http\Controllers;

use App\Modules\Core\Http\Requests\Route\AddRequest;
use App\Modules\Core\Http\Requests\Route\AllRequest;
use App\Modules\Core\Http\Requests\Route\DeleteRequest;
use App\Modules\Core\Http\Requests\Route\EditRequest;
use App\Modules\Admin\Http\Controllers\AdminController;
use App\Modules\Core\Models\Access;
use App\Modules\Core\Models\Role;
use App\Modules\Core\Models\Routes;
use App\Modules\Core\Models\User;
use Caffeinated\Modules\Facades\Module;
use Illuminate\Support\Facades\DB;

class RouteController extends AdminController
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

        $routes = Routes::with('access')->OnDates($date_type, $date_s, $date_po)->Search(['route', 'ru_name'], $search_text)->orderBy($sort_name, $sort_arrow)->paginate($count_on_page);

        $data = [
            'routes'=> $routes,
            'count_on_page'=>$count_on_page,
            'sort_name'=>$sort_name,
            'sort_arrow'=>$sort_arrow,
            'search_text'=>$search_text,
            'date_type'=>$date_type,
            'date_s'=>$date_s,
            'date_po'=>$date_po,
            'count_list'=>$count_on_page_mass
        ];

        return view('core::admin.routes.all', $data);
    }

    public function add(){

        $accesses = Access::all();
        $new_access = new Access();
        $new_access->id = 0;
        $new_access->ru_name = 'Без доступа';
        $accesses[] = $new_access;

        $data = [
            'accesses'=>$accesses,
        ];
        return view('core::admin.routes.add', $data);
    }

    public function edit($id){
        $route = Routes::findOrFail($id);

        $accesses = Access::all();
        $new_access = new Access();
        $new_access->id = 0;
        $new_access->ru_name = 'Без доступа';
        $accesses[] = $new_access;

        $data = [
            'route'=>$route,
            'accesses'=>$accesses,
        ];
        return view('core::admin.routes.edit', $data);
    }

    public function delete($id){
        $route = Routes::findOrFail($id);
        $data = [
            'route'=>$route
        ];
        return view('core::admin.routes.delete', $data);
    }

    /* POST запросы */

    public function post_add(AddRequest $request){
        $request_all = $request->all();
        Routes::create($request_all);
        return redirect()->route('admin.routes.all')->with('message', trans('core::routes.message_add'));
    }

    public function post_edit(EditRequest $request, $id){
        $request_all = $request->all();

        $find_route = Routes::findOrFail($id);
        $find_route->route = $request_all['route'];
        $find_route->ru_name = $request_all['ru_name'];
        $find_route->access_id = $request_all['access_id'];
        $find_route->save();

        return redirect()->route('admin.routes.edit', $id)->with('message', trans('core::routes.message_edit'));
    }

    public function post_delete(DeleteRequest $request){
        $request_all = $request->all();
        $route_ids = $request_all['route_ids'];

        DB::transaction(function() use ($route_ids) {
            Routes::whereIn('id', $route_ids)->delete();
            User::whereIn('route_id', $route_ids)->update(['route_id' => null]);
            Role::whereIn('route_id', $route_ids)->update(['route_id' => null]);
        });

        return redirect()->route('admin.routes.all')->with('message', trans('core::routes.message_delete'));
    }
}
