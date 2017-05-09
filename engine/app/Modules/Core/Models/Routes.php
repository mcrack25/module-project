<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Core\Models\Service\Searchable;

class Routes extends Model
{
    use Searchable;

    protected $table = 'routes';

    protected $fillable = [
        'route', 'ru_name'
    ];
}
