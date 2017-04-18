<?php

namespace App\Http\Requests;

class StoreCommentRequest extends CommonRequest
{
    public $key = 'test';
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
            'test1' => 'required',
            'test2' => 'required'
        ];
    }
}
