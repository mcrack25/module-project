<?php

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $role = Role::find(1);

        /* Администратор системы */
            $admin = new User();
            $admin->id = 1;
            $admin->name = 'Администратор системы';
            $admin->email = 'admin@admin.ru';
            $admin->password = bcrypt('123456');
            $admin->role_id = $role->id;
            $admin->route_id = 1;
            $admin->save();
        /* Администратор системы */
    }
}
