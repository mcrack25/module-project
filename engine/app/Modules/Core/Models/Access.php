<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Core\Models\Service\Searchable;

class Access extends Model
{
    use Searchable;

    protected $table = 'accesses';

    protected $fillable = [
        'name', 'ru_name'
    ];

    public function roles(){
        return $this->belongsToMany('App\Modules\Core\Models\Role', 'role_access', 'access_id', 'role_id');
    }

}
