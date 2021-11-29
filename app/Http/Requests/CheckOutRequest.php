<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
        return $rules = [
            'customerName' => 'required' ,
            'email' => 'required',
            'address' => 'required|email',
            'phone'=> 'required|numeric',
        ];
       
    }
    public function messages()
{
    return  [
        'customerName.required' => 'A title is required',
        'email.required' => 'A message is required',
    ];
}
}
