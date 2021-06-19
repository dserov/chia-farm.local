<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveWalletRequest extends FormRequest
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
            'wallet.name' => 'required|min:3',
            'wallet.master_key' => 'required|size:96',
            'wallet.farmer_key' => 'required|size:96',
            'wallet.pool_key' => 'required|size:96',
            //
        ];
    }

    public function attributes()
    {
        return [
            'wallet.name' => 'Name',
            'wallet.master_key' => 'Master key',
            'wallet.farmer_key' => 'Farmer key',
            'wallet.pool_key' => 'Pool key',
        ];
    }


}
