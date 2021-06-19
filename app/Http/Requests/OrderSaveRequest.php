<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderSaveRequest extends FormRequest
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
            'order.plot_amount' => 'required|numeric',
            'order.download_server_id' => 'required|exists:download_servers,id',
            'order.auction_id' => 'required|exists:auctions,id',
        ];
    }

    public function attributes()
    {
        return [
            'order.plot_amount' => 'Plot amount',
            'order.download_server_id' => 'Download server',
            'order.auction_id' => 'Auction id',
        ];
    }
}
