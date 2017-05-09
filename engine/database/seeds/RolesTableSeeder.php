<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Access;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        DB::table('roles_access')->truncate();

        $access = Access::All();

        $role = new Role();
        $role->id = 1;
        $role->ru_name = 'Администраторы';
        $role->route_id = 1;
        $role->save();
        $role->access()->attach($access);
    }
}
