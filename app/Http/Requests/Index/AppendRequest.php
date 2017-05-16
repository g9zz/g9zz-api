<?php

namespace App\Http\Requests\Index;

use App\Http\Requests\CommonRequest;

class AppendRequest extends CommonRequest
{
    public $key = 'append';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'content' => 'required|max:300',
            'postId' => 'required|exists:posts,id'
        ];
        return $rule;
    }
}
