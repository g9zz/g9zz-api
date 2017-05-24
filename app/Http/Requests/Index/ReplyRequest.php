<?php

namespace App\Http\Requests\Index;

use App\Http\Requests\CommonRequest;
use Illuminate\Http\Request;

class ReplyRequest extends CommonRequest
{
    public $key = 'reply';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $actionMethod = Request::route()->getActionMethod();
        $rule = [];
        if ($actionMethod == 'store') {
            $rule = [
                'postId' => 'required|exists:posts,hid',
                'content' => 'required',
            ];
        }

        if ($actionMethod == 'update') {
            $rule = [
                'content' => 'required',
            ];
        }
        return $rule;
    }
}
