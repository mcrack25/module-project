<?php

use Illuminate\Database\Seeder;

use App\Models\Routes;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Routes::truncate();

        $role = new Routes();
        $role->id = 1;
        $role->route = 'admin.index';
        $role->ru_name = 'Админка: Главная страница';
        $role->save();
    }
}
