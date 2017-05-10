<?php

namespace App\Http\Requests\Console;

use App\Http\Requests\CommonRequest;
use Illuminate\Http\Request;

class NodeRequest extends CommonRequest
{

    public $key = 'node';

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
                'parentId' => 'required',
                'weight' => 'required',
                'name' => 'required|unique:nodes,name',
                'slug' => 'required|max:60|unique:nodes|regex:/^[a-zA-Z0-9]+$/',
            ];
        }

        if ($actionMethod == 'update') {
            $id = Request::route()->parameter('id');

            $rule =  [
                'parentId' => 'required',
                'weight' => 'required',
                'name' => 'required|unique:nodes,name,null,null,id,!'.$id,
                'slug' => 'required|max:60|unique:nodes,slug,null,null,id,!'.$id.'|regex:/^[a-zA-Z0-9]+$/',
            ];
        }

        return $rule;
    }
}
