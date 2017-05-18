<?php

namespace App\Modules\Menu\Http\Controllers;

use App\Modules\Core\Models\Routes;
use App\Modules\Menu\Models\Menu;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function add(){

        $menus = Menu::where(['parent_id'=>0])->OrderBy('sort')->get();
        $routes = Routes::all();
        $route_new = new Routes();
        $route_new->id = 0;
        $route_new->ru_name = 'Не выбрано';
        $routes[0] = $route_new;

        $data = [
            'menus'=>$menus,
            'routes'=>$routes
        ];
        return view('menu::pages.add', $data);
    }

    public function edit($id){
        $menus = Menu::where(['parent_id'=>0])->OrderBy('sort')->get();

        $routes = Routes::all();
        $route_new = new Routes();
        $route_new->id = 0;
        $route_new->ru_name = 'Не выбрано';
        $routes[0] = $route_new;

        $menu_form = Menu::find($id);

        $data = [
            'menus'=>$menus,
            'routes'=>$routes,
            'id'=>$id,
            'menu_form'=>$menu_form
        ];
        return view('menu::pages.edit', $data);
    }

    public function post_add(Request $request){
        $request_all = $request->all();

        $messages = [
            'required' => 'Поле <b>:attribute</b> должно быть заполнено!',
            'numeric' => 'Поле <b>:attribute</b> должно быть числовым!',
            'max' => 'Поле <b>:attribute</b> должно содержать не более :max символов.',
        ];

        $niceNames = [
            'name' => 'Название',
            'sort' => 'Уровеь сортировки',
            'route_id' => 'Роут',
            'parent_id' => 'Вложенность'
        ];

        $add_sort = [];
        if(!empty($request_all['sort'])){
            $add_sort = [
                'sort' => 'numeric'
            ];
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'route_id' => 'required|numeric',
            'parent_id' => 'required|numeric',
        ]+$add_sort, $messages, $niceNames);

        $item = new Menu();
        $item->name = $request_all['name'];
        $item->parent_id = $request_all['parent_id'];
        $item->route_id = $request_all['route_id'];
        $item->sort = $request_all['sort'] ? $request_all['sort'] : 1000;
        $item->icon = $request_all['icon'] ? $request_all['icon'] : null;
        $item->other_url = $request_all['other_url'] ? $request_all['other_url'] : null;
        $item->save();

        return redirect()->route('admin.menu.add')->with('message', trans('menu::menu.message_add'));
    }

    public function post_actions(Request $request, $id){

        if($request['submit'] == 'save'){
            return $this->f_save($request, $id);
        } elseif($request['submit'] == 'delete') {
            return $this->f_delete($id);
        } else {
            die('Не верный идентификатор кнопки!');
        }
    }

    protected function f_save($request, $id){

        $request_all = $request->all();

        $messages = [
            'required' => 'Поле <b>:attribute</b> должно быть заполнено!',
            'numeric' => 'Поле <b>:attribute</b> должно быть числовым!',
            'max' => 'Поле <b>:attribute</b> должно содержать не более :max символов.',
        ];

        $niceNames = [
            'name' => 'Название',
            'sort' => 'Уровеь сортировки',
            'route_id' => 'Роут',
            'parent_id' => 'Вложенность'
        ];

        $add_sort = [];
        if(!empty($request_all['sort'])){
            $add_sort = [
                'sort' => 'numeric'
            ];
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'route_id' => 'required|numeric',
            'parent_id' => 'required|numeric',
        ]+$add_sort, $messages, $niceNames);

        $item = Menu::findOrFail($id);
        $item->name = $request_all['name'];
        $item->parent_id = $request_all['parent_id'];
        $item->route_id = $request_all['route_id'];
        $item->sort = $request_all['sort'] ? $request_all['sort'] : 1000;
        $item->icon = $request_all['icon'] ? $request_all['icon'] : null;
        $item->other_url = $request_all['other_url'] ? $request_all['other_url'] : null;
        $item->save();

        return redirect()->route('admin.menu.edit', $id)->with('message', trans('menu::menu.message_save'));
    }

    protected function f_delete($id){
        $menus = Menu::findOrFail($id);

        $message = '';
        if(count($menus->submenu) > 0){
            $ids = $menus->submenu->pluck('id')->toArray();
            Menu::whereIn('id', $ids)->OrWhere(['id'=>$id])->delete();
            $message = trans('menu::menu.message_delete_with_submenu');
        } else {
            Menu::where(['id'=>$id])->delete();
            $message = trans('menu::menu.message_delete');
        }

        return redirect()->route('admin.menu.add', $id)->with('message', $message);
    }

}
