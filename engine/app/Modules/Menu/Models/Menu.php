<?php

namespace App\Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name', 'parent_id', 'access_id', 'access_id_route', 'sort', 'icon'
    ];

    public function submenu(){
        return $this->hasMany('App\Modules\Menu\Models\Menu', 'parent_id', 'id');
    }

    public function access(){
        return $this->hasOne('App\Models\Access', 'id', 'access_id');
    }

    public function access_route(){
        return $this->hasOne('App\Models\Access', 'id', 'route_id');
    }
}
