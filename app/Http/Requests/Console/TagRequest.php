<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/12
 * Time: 上午12:26
 */

namespace App\Http\Requests\Console;


use App\Http\Requests\CommonRequest;
use Illuminate\Http\Request;

class TagRequest extends CommonRequest
{
    public $key = 'tag';

    public function rules()
    {
        $actionMethod = Request::route()->getActionMethod();
        $rule = [];
        if ($actionMethod == 'store') {
            $rule = [
                'description' => 'max:120',
                'weight' => 'required',
                'name' => 'required|unique:tags,name',
                'display_name' => 'required|max:60|unique:tags|regex:/^[a-zA-Z0-9]+$/',
            ];
        }

        if ($actionMethod == 'update') {
            $id = Request::route()->parameter('id');

            $rule =  [
                'description' => 'max:120',
                'weight' => 'required',
                'name' => 'required|unique:tags,name,null,null,id,!'.$id,
                'display_name' => 'required|max:60|unique:tags,slug,null,null,id,!'.$id.'|regex:/^[a-zA-Z0-9]+$/',
            ];
        }

        return $rule;
    }
}