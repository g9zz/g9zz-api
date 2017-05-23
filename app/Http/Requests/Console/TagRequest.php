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
                'name' => 'required|unique:tags,name|regex:/^[a-zA-Z0-9]+$/',
                'displayName' => 'required|max:60|unique:tags,display_name',
            ];
        }

        if ($actionMethod == 'update') {
            $hid = Request::route()->parameter('hid');
            $id = parent::changeHidToId($hid,'tag');

            $rule =  [
                'description' => 'max:120',
                'weight' => 'required',
                'name' => 'required|unique:tags,name,!'.$id.',id|regex:/^[a-zA-Z0-9]+$/',
                'displayName' => 'required|max:60|unique:tags,display_name,!'.$id.',id',
            ];
        }

        return $rule;
    }
}