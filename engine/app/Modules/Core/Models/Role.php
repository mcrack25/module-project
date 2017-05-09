<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Core\Models\Service\Searchable;

class Role extends Model
{
    use Searchable;

    protected $table = 'roles';

    public function access(){
        return $this->belongsToMany('App\Modules\Core\Models\Access', 'roles_access', 'role_id', 'access_id');
    }

    public function hasAnyAccess($roles){
        if(is_array($roles)){
            foreach ($roles as $role) {
                if($this->hasAccess($role)){
                    return true;
                }
            }
        } else {
            if($this->hasAccess($roles)){
                return true;
            }
        }
    }

    public function hasAccess($role){

        $access_mass = $this->access()->get();

        if($access_mass){
            foreach ($access_mass as $access_one) {
                if($access_one->name === $role){
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
