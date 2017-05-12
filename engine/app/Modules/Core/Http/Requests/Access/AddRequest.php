<?php

namespace App\Modules\Core\Http\Requests\Access;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'ru_name' => 'required|max:255|unique:roles',
            'access.*' => 'numeric',
        ];
    }

    public function messages(){
        return [
            'max' => 'Поле <b>:attribute</b> должно содержать не более :max символов.',
            'unique' => 'Поле <b>:attribute</b> должно быть уникальным.',
            'numeric' => 'Поле <b>:attribute</b> должно быть числовым.',
            'required' => 'Поле <b>:attribute</b> является обязательным.',
        ];
    }

    public function attributes(){
        return [
            'ru_name' => 'Название роли',
            'access.*' => 'Права доступа',
        ];
    }

}
