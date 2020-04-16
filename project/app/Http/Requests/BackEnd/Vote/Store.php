<?php

namespace App\Http\Requests\BackEnd\Vote;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'product_id' => 'required',
            'vote'       => 'required',
            'one'        => 'required',
            'two'        => 'required',
            'three'      => 'required',
            'four'       => 'required',
            'five'       => 'required'
        ];
    }
}
