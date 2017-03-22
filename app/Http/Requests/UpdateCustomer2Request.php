<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomer2Request extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'customer_name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '联系人姓名不能为空',
            'phone.required' => '联系方式不能为空',
            'customer_name.required' => '客户单位不能为空'
        ];
    }
}
