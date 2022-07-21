<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'code' => 'required|min:10|max:20|unique:coupons',
            'name' => 'required|min:10|max:20',
            'description' => 'required|min:10',
            'decreased_price' => 'required|integer|min:10|max:100',
            'expired_date' => 'required|after:'.now()
        ];
    }
}
