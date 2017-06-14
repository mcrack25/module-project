<?php

namespace App\Modules\Note\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model{

    protected $table = 'notes';

    protected $fillable = [
        'user_id', 'text'
    ];

    public function user(){
        return $this->hasOne('App\Modules\Core\Models\User', 'id', 'user_id');
    }
}
