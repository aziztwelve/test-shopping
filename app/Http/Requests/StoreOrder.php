<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
            'email' => 'email:rfc,dns',
            'phone' => 'required|min:11|numeric',
            'shipping_address_1' => 'required|max:255|min:4',
            'city' => 'required|max:255|min:4',
        ];
    }
}
