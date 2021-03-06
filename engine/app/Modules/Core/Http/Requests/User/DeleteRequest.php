<?php

namespace App\Modules\Core\Http\Requests\User;

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
        $user_id = Auth::user()->id;
        return [
            'user_ids.*' => 'required|numeric|not_in:'.$user_id,
        ];
    }

    public function messages(){
        return [
            'numeric' => '<b>:attribute</b> должен иметь числовое значение.',
            'required' => '<b>:attribute</b> не выбран.',
            'not_in' => 'Нельзя удалить самого себя из базы',
        ];
    }

    public function attributes(){
        return [
            'user_ids.*' => 'Пользователь',
        ];
    }
}
