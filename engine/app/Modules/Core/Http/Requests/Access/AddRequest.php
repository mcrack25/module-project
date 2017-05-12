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
            'name' => 'required|regex:([a-z0-9_]+)|max:255|unique:accesses',
            'ru_name' => 'required',
        ];
    }

    public function messages(){
        return [
            'max' => 'Поле <b>:attribute</b> должно содержать не более :max символов.',
            'unique' => 'Поле <b>:attribute</b> должно быть уникальным.',
            'required' => 'Поле <b>:attribute</b> является обязательным.',
            'regex' => 'Поле <b>:attribute</b> должно содержать только следующие символы:<br>[a-z0-9_].',
        ];
    }

    public function attributes(){
        return [
            'ru_name' => 'Название доступа',
            'name' => 'Ключ доступа',
        ];
    }

}
