<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveHostRequest extends FormRequest
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
            'host.name' => 'required|min:3',
            'host.type' => 'required|min:4',
            'host.ip' => 'required|min:7',
            'host.plots_count' => 'required',
            'host.wallet_id' => 'nullable|sometimes|exists:wallets,id',
        ];
    }
}
