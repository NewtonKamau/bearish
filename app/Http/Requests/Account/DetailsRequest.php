<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class DetailsRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'required|email|max:255|unique:users,email,'.$this->get('id'),
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.max' => __('The name may not be greater than :max characters', ['max' => 50]),
            'email.required' => __('The name field is required'),
            'email.email' => __('The email must be a valid email address'),
            'email.unique' => __('The email has already been taken'),
            'email.max' => __('The email may not be greater than :max characters', ['max' => 255]),
        ];
    }
}
