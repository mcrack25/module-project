<?php

namespace App\Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model{

    protected $table = 'menus';

    protected $accesses;

    protected $fillable = [
        'name', 'parent_id', 'route_id', 'sort', 'icon', 'other_url'
    ];

    public function submenu(){
        return $this->hasMany('App\Modules\Menu\Models\Menu', 'parent_id', 'id')->OrderBy('sort');
    }

    public function submenu_access(){
        $accesses = Auth::user()->accesses()->pluck('id')->toarray();

        return $this->hasMany('App\Modules\Menu\Models\Menu', 'parent_id', 'id')->Where(function($query) use ($accesses){

            return $query->Where(['route_id'=>0])->OrWhereHas('route', function($query) use ($accesses){
                return $query->WhereIn('access_id', $accesses);
            });

        })->OrderBy('sort');
    }

    public function route(){
        return $this->hasOne('App\Modules\Core\Models\Routes', 'id', 'route_id');
    }

}
