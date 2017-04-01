<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'required | unique:customers',
            'addr' => 'required',
            'profession' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'addr.required' =>'用户地址不能为空',
            'name.unique' => '用户已经存在',
            'profession.required' =>'用户所在行业不能为空'
        ];
    }
}
