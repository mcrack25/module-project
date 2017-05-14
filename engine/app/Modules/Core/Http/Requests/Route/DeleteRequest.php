<?php

namespace App\Modules\Core\Http\Requests\Route;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteRequest extends FormRequest
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
    public function rules(){
        return [
            'route_ids.*' => 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'numeric' => '<b>:attribute</b> должен иметь числовое значение.',
            'required' => '<b>:attribute</b> не выбран.',
        ];
    }

    public function attributes(){
        return [
            'route_ids.*' => 'Роут',
        ];
    }
}
