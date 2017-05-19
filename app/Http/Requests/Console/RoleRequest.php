<?php

namespace App\Http\Requests\Console;

use App\Http\Requests\CommonRequest;
use Illuminate\Http\Request;

class RoleRequest extends CommonRequest
{
    public $key = 'role';

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
                'name' => 'required|unique:roles,name',
                'displayName' => 'required|unique:roles,display_name',
                'description' => 'max:150',
            ];
        }
        if ($actionMethod == 'update') {
            $id = Request::route()->parameter('id');
            $rule = [
                'name' => 'required|unique:roles,name,null,null,id,!'.$id,
                'displayName' => 'required|unique:roles,display_name,null,null,id,!'.$id,
                'description' => 'max:150',
            ];
        }

        if ($actionMethod == 'attachPermission') {
            $rule = [
                'permissionIds' => 'required'
            ];
        }

        return $rule;
    }
}
