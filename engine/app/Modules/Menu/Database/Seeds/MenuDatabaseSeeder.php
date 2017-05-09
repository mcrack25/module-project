<?php

namespace App\Modules\Menu\Database\Seeds;

use Illuminate\Database\Seeder;

use App\Modules\Menu\Models\Menu;

//Добавить в module.json "basename":"Menu", - чтоьбы работал сидер, и называть файл сидера следующим образом

class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();

        /* Первый уровень */
        $menu = new Menu();
        $menu->id = 1;
        $menu->parent_id = 0;
        $menu->access_id = 0;
        $menu->route_id = 0;
        $menu->name = 'Общие пункты';
        $menu->icon = '';
        $menu->sort = 100;
        $menu->save();

        $menu = new Menu();
        $menu->id = 2;
        $menu->parent_id = 0;
        $menu->access_id = 0;
        $menu->route_id = 0;
        $menu->name = 'Действия';
        $menu->icon = '';
        $menu->sort = 200;
        $menu->save();

        $menu = new Menu();
        $menu->id = 3;
        $menu->parent_id = 0;
        $menu->access_id = 0;
        $menu->route_id = 0;
        $menu->name = 'Параметры доступа';
        $menu->icon = '';
        $menu->sort = 300;
        $menu->save();

        $menu = new Menu();
        $menu->id = 4;
        $menu->parent_id = 0;
        $menu->access_id = 0;
        $menu->route_id = 0;
        $menu->name = 'Параметры системы';
        $menu->icon = '';
        $menu->sort = 400;
        $menu->save();
        /* Первый уровень */

        /* Второй уровень */
        $menu = new Menu();
        $menu->id = 5;
        $menu->parent_id = 1;
        $menu->access_id = 1;
        $menu->route_id = 1;
        $menu->name = 'Главная';
        $menu->icon = '<i class="ti-home"></i>';
        $menu->sort = 500;
        $menu->save();

        $menu = new Menu();
        $menu->id = 6;
        $menu->parent_id = 3;
        $menu->access_id = 0;
        $menu->route_id = 0;
        $menu->name = 'Пользователи';
        $menu->icon = '<i class="ti-user m-r-10"></i>';
        $menu->sort = 500;
        $menu->save();

        $menu = new Menu();
        $menu->id = 7;
        $menu->parent_id = 3;
        $menu->access_id = 0;
        $menu->route_id = 0;
        $menu->name = 'Роли';
        $menu->icon = '<i class="ion-unlocked"></i>';
        $menu->sort = 600;
        $menu->save();

        $menu = new Menu();
        $menu->id = 8;
        $menu->parent_id = 3;
        $menu->access_id = 0;
        $menu->route_id = 0;
        $menu->name = 'Разделы сайта';
        $menu->icon = '<i class="ti-files"></i>';
        $menu->sort = 700;
        $menu->save();

        $menu = new Menu();
        $menu->id = 9;
        $menu->parent_id = 3;
        $menu->access_id = 1;
        $menu->route_id = 3;
        $menu->name = 'Меню';
        $menu->icon = '<i class="ti-menu-alt"></i>';
        $menu->sort = 800;
        $menu->save();

        $menu = new Menu();
        $menu->id = 10;
        $menu->parent_id = 4;
        $menu->access_id = 0;
        $menu->route_id = 0;
        $menu->name = 'Настройки';
        $menu->icon = '<i class="icon-settings"></i>';
        $menu->sort = 500;
        $menu->save();

        $menu = new Menu();
        $menu->id = 11;
        $menu->parent_id = 4;
        $menu->access_id = 1;
        $menu->route_id = 2;
        $menu->name = 'О системе';
        $menu->icon = '<i class="glyphicon glyphicon-info-sign"></i>';
        $menu->sort = 600;
        $menu->save();
        /* Второй уровень */

        /* Третий уровень */
        $menu = new Menu(); //Пользователи
        $menu->id = 12;
        $menu->parent_id = 6;
        $menu->access_id = 1;
        $menu->route_id = 5;
        $menu->name = 'Список';
        $menu->icon = '';
        $menu->sort = 1000;
        $menu->save();

        $menu = new Menu(); //Пользователи
        $menu->id = 13;
        $menu->parent_id = 6;
        $menu->access_id = 1;
        $menu->route_id = 8;
        $menu->name = 'Добавить';
        $menu->icon = '';
        $menu->sort = 1000;
        $menu->save();

        $menu = new Menu(); //Роли
        $menu->id = 14;
        $menu->parent_id = 7;
        $menu->access_id = 1;
        $menu->route_id = 6;
        $menu->name = 'Список';
        $menu->icon = '';
        $menu->sort = 1000;
        $menu->save();

        $menu = new Menu(); //Роли
        $menu->id = 15;
        $menu->parent_id = 7;
        $menu->access_id = 1;
        $menu->route_id = 9;
        $menu->name = 'Добавить';
        $menu->icon = '';
        $menu->sort = 1000;
        $menu->save();

        $menu = new Menu(); //Разделы сайта
        $menu->id = 16;
        $menu->parent_id = 8;
        $menu->access_id = 1;
        $menu->route_id = 7;
        $menu->name = 'Список';
        $menu->icon = '';
        $menu->sort = 1000;
        $menu->save();

        $menu = new Menu(); //Разделы сайта
        $menu->id = 17;
        $menu->parent_id = 8;
        $menu->access_id = 1;
        $menu->route_id = 10;
        $menu->name = 'Добавить';
        $menu->icon = '';
        $menu->sort = 1000;
        $menu->save();

        $menu = new Menu();
        $menu->id = 18;
        $menu->parent_id = 10;
        $menu->access_id = 1;
        $menu->route_id = 4;
        $menu->name = 'Все настройки';
        $menu->icon = '';
        $menu->sort = 1000;
        $menu->save();
        /* Третий уровень */
    }
}
