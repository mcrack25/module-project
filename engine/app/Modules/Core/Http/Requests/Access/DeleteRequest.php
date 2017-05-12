<?php

namespace App\Modules\Core\Http\Requests\Access;

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
            'role_ids.*' => 'required|numeric',
            'role_id' => 'numeric',
        ];
    }

    public function messages(){
        return [
            'numeric' => '<b>:attribute</b> должена иметь числовое значение.',
            'role_id.numeric' => 'Поле <b>:attribute</b> должено иметь числовое значение.',
            'required' => '<b>:attribute</b> не выбрана.',
        ];
    }

    public function attributes(){
        return [
            'role_ids.*' => 'Выбраная роль',
            'role_id' => 'Назначить другую роль',
        ];
    }
}
