<?php

namespace App\Modules\Core\Models\Service;

use Carbon\Carbon;

trait Searchable{

    protected static $LIKE = 'LIKE';
    protected static $NOT_LIKE = 'NOT LIKE';

    public function scopeSearch($query, $name = null, $like_text = null){

        if((!empty($name)) and (!empty($like_text))){

            if(is_array($name)){
                $loop = 1;
                foreach($name as $name_one){

                    if($loop == 1){
                        $query->Where($name_one, static::$LIKE, '%' . $like_text . '%');
                    } else {
                        $query->orWhere($name_one, static::$LIKE, '%' . $like_text . '%');
                    }

                    $loop++;
                }
            } else {
                $query->where($name, static::$LIKE, '%' . $like_text . '%');
            }
        }

        return $query;
    }

    public function scopeWherein_like($query, $name, $like, $not_like){

        if(empty($name)){
            return $query;
        }

        if((empty($like)) and (empty($not_like))){
            return $query;
        }

        if(!empty($like)){
            $query->where(function($q) use ($name, $like){
                $item = 0;
                foreach($like as $like_one){
                    if($item == 0){
                        $q->where($name, static::$LIKE, '%'. trim($like_one).'%');
                        $item++;
                    } else {
                        $q->orwhere($name, static::$LIKE, '%'. trim($like_one).'%');
                    }
                }
                return $q;
            });
        }

        if(!empty($not_like)) {
            $query->where(function ($q) use ($name, $not_like) {
                foreach ($not_like as $like_one) {
                    $q->where($name, static::$NOT_LIKE, '%' . trim($like_one) . '%');
                }
                return $q;
            });
        }

        return $query;
    }

    public function scopeOnDates($query, $type = null, $date_s = null, $date_po = null){

        if($type == null){
            return $query;
        } else {
            if(($date_s==null) and ($date_po==null)){
                return $query;
            } elseif(($date_s!=null) and ($date_po!=null)){
                $date_s = Carbon::createFromFormat('d.m.Y', $date_s)->toDateTimeString();
                $date_po = Carbon::createFromFormat('d.m.Y', $date_po)->toDateTimeString();

                return $query->whereBetween($type, [$date_s, $date_po]);
            } elseif($date_s!=null) {
                $date_s = Carbon::createFromFormat('d.m.Y', $date_s)->toDateTimeString();
                return $query->where($type, '>=', $date_s);
            } elseif($date_s!=null) {
                $date_po = Carbon::createFromFormat('d.m.Y', $date_po)->toDateTimeString();
                return $query->where($type, '<=', $date_po);
            }
        }
        return $query;
    }

}
