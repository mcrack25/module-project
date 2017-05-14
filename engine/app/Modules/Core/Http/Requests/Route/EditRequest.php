<?php

namespace App\Modules\Core\Http\Requests\Route;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class EditRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            'route' => 'required|max:255|regex:([a-z0-9_.]+)|unique:routes' . ',' . $id,
            'ru_name' => 'required|max:255',
            'access_id' => 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'max' => 'Поле <b>:attribute</b> должно содержать не более :max символов.',
            'unique' => 'Поле <b>:attribute</b> должно быть уникальным.',
            'required' => 'Поле <b>:attribute</b> является обязательным.',
            'regex' => 'Поле <b>:attribute</b> должно содержать только следующие символы:<br>[a-z0-9_.].',
            'numeric' => 'Поле <b>:attribute</b> должно быть числовым.',
        ];
    }

    public function attributes(){
        return [
            'route' => 'Роут',
            'ru_name' => 'Название роута',
            'access_id' => 'Уровень доступа',
        ];
    }

}
