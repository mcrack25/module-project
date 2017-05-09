<?php

use Illuminate\Database\Seeder;

use App\Models\Access;

class AccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Access::truncate();

        $access = new Access();
        $access->id = 1;
        $access->name = 'admin_index';
        $access->ru_name = 'Админка: Общие разделы';
        $access->save();

        $access = new Access();
        $access->id = 2;
        $access->name = 'admin_config';
        $access->ru_name = 'Админка: Конфигурация системы';
        $access->save();

        $access = new Access();
        $access->id = 3;
        $access->name = 'admin_users';
        $access->ru_name = 'Админка: Управление пользователями';
        $access->save();

        $access = new Access();
        $access->id = 4;
        $access->name = 'admin_roles';
        $access->ru_name = 'Админка: Управление ролями';
        $access->save();

        $access = new Access();
        $access->id = 5;
        $access->name = 'admin_accesses';
        $access->ru_name = 'Админка: Управление доступами';
        $access->save();
    }
}
