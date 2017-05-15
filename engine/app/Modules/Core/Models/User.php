<?php

namespace App\Modules\Core\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Modules\Core\Models\Service\Searchable;

class User extends Authenticatable
{
    use Notifiable;

    use Searchable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'route_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne('App\Modules\Core\Models\Role', 'id', 'role_id');
    }

    public function accesses(){
        return $this->role->access()->get();
    }

    public function in_access($mass){
        $access = $this->role->access()->get();

        foreach($mass as $mass_k => $mass_v){
            foreach($access as $access_one){
                if($access_one->name == $mass_v){
                    return true;
                }
            }
        }
        return false;
    }

    /* Для редиректа на страницы после входа и т.д. */
    public function routes(){
        return $this->hasOne('App\Modules\Core\Models\Routes', 'id', 'route_id');
    }

}
