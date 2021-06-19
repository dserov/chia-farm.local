<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class SaveProfileRequest extends FormRequest
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
    public function rules()
    {
        return [
            'password' => 'confirmed',
            'current_password' => [
                'required',
                // проверка текущего пароля ;)
                function ($attribute, $value, $fail) {
                    if (! Hash::check($value, \Auth::user()->password)) {
                        $fail('Current password invalid');
                    }
                },
            ],
        ];
    }
}
