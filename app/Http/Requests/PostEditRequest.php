<?php

namespace App\Http\Requests;


class PostEditRequest extends CommonRequest
{
    public $key = 'post';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }
}
