<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午9:35
 */

namespace App\Transformers;


use App\Models\Permissions;

class PermissionTransformer extends BaseTransformer
{
    public function transform(Permissions $permissions)
    {
        $return = [
            'id' => $permissions->id,
            'name' => $permissions->name,
            'displayName' => $permissions->display_name,
            'description' => $permissions->description,
        ];
        return $return;
    }
}