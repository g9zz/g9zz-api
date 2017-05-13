<?php

namespace App\Http\Requests\Console;

use App\Http\Requests\CommonRequest;

class PostRequest extends CommonRequest
{
    public $key = 'post';

    /**
     * @return array
     */
    public function rules()
    {
        $rule = [
            'title' => 'required|max:150',
            'content' => 'required',
        ];
        return $rule;
    }
}
