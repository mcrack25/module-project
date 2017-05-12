<?php

namespace App\Modules\Core\Http\Requests\User;

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users' . ',' . $id,
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'min' => 'Поле <b>:attribute</b> должно содержать не менее :min символов.',
            'max' => 'Поле <b>:attribute</b> должно содержать не более :max символов.',
            'unique' => 'Поле <b>:attribute</b> должно быть уникальным.',
            'numeric' => 'Поле <b>:attribute</b> должно быть числовым.',
            'required' => 'Поле <b>:attribute</b> является обязательным.',
            'confirmed' => 'Поля <b>:attribute</b> и <b>Подтвердите <span class="text-lowercase">:attribute</span></b> не совпадают.',
        ];
    }

    public function attributes(){
        return [
            'name' => 'ФИО',
            'email' => 'EMail',
            'password' => 'Пароль',
            'role_id' => 'Роль',
        ];
    }

}
