<?php

namespace App\Modules\Core\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as Request_http;

class AllRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request_http $request){
        $request_all = $request->all();

        $filter = [];
        if(isset($request_all['date_s'])){
            $filter += [
                'date_s' => 'date|date_format:d.m.Y',
            ];
        }

        if(isset($request_all['date_po'])){
            $filter += [
                'date_po' => 'date|date_format:d.m.Y',
            ];
        }

        return [
            'count_on_page' => 'numeric',
            'sort_arrow' => 'in:asc,desc',
            'sort_name' => 'in:id,email,name',
            'date_type' => 'in:created_at,updated_at',
        ] + $filter;
    }

    public function messages(){
        return [
            'numeric' => 'Параметр <b>:attribute</b> должен быть числовым.',
            'in' => 'Параметр <b>:attribute</b> находится в неверном диопазоне.',
            'date' => 'Параметр <b>:attribute</b> должен быть датой.',
            'date_format' => 'Параметр <b>:attribute</b> должен быть введён в таком фомате - :format.',
        ];
    }

    public function attributes(){
        return [
            'sort_arrow' => 'Стрелка',
            'sort_name' => 'Сортировать по',
            'date_type' => 'Дата',
            'date_s' => 'Дата С:',
            'date_po' => 'Дата ПО:',
            'count_on_page' => 'Показывать по',
        ];
    }
}
