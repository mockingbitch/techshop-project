<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddProductRequestForm extends FormRequest
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
//    public function rules()
//    {
//        return [
//            'productName' => $request->productName,
//            'productDescription' => $request->productDescription,
//            'productContent' => $request->productContent,
//            'productPrice'=> $request->productPrice,
//            'categoryId'=>$request->categoryId,
//            'brandId'=>$request->brandId,
//            'productQuantity'=>$request->productQuantity,
//        ];
//    }
    public function rules(Request $request)
    {
        $ruleArr = [
            'productName' => 'required',
            'productDescription' => 'required',
            'productContent' => 'required',
            'productPrice'=> 'required|numeric',
            'categoryId'=> 'required|numeric',
            'brandId'=>'required|numeric',
            'productQuantity'=>'required|numeric',
        ];
        $img = $request->get('productImage',null);
        $ruleArr['productImage'] = !empty($img)? 'required|mimes:jpg,bmp,png,jpeg':'mimes:jpg,bmp,png,jpeg';
        return $ruleArr;
    }

}
