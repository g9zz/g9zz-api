<?php

namespace App\Http\Requests\Console;

use App\Http\Requests\CommonRequest;

class NodeStoreRequest extends CommonRequest
{

    public $key = 'node';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parentId' => 'required',
            'weight' => 'required',
            'name' => 'required|unique:nodes,name',
            'slug' => 'required|max:60|unique:nodes|regex:/^[a-zA-Z0-9]+$/',
        ];
    }
}
