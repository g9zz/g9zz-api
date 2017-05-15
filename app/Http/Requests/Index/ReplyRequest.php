<?php

namespace App\Http\Requests\Index;

use App\Http\Requests\CommonRequest;

class ReplyRequest extends CommonRequest
{
    public $key = 'reply';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
