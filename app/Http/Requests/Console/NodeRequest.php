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
                'name' => 'required|unique:nodes,name|regex:/^[a-zA-Z0-9]+$/',
                'displayName' => 'required|max:60|unique:nodes,display_name',
            ];
        }

        if ($actionMethod == 'update') {
            $hid = Request::route()->parameter('hid');
            $id = parent::changeHidToId($hid,'node');
            $rule =  [
                'parentId' => 'required',
                'weight' => 'required',
                'name' => 'required|unique:nodes,name,null,null,id,!'.$id.'|regex:/^[a-zA-Z0-9]+$/',
                'displayName' => 'required|max:60|unique:nodes,display_name,null,null,id,!'.$id,
            ];
        }

        return $rule;
    }
}
