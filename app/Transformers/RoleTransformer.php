<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/19
 * Time: 下午2:01
 */

namespace App\Transformers;


use App\Models\Roles;

class RoleTransformer extends BaseTransformer
{
    public function transform(Roles $roles)
    {
        $return = [
            'id' => $roles->id,
            'name' => $roles->name,
            'displayName' => $roles->display_name,
            'description' => $roles->description,
        ];

        if ($roles->user) {
            foreach ($roles->user as $item) {
                $return['user'][] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'avatar' => $item->avatar
                ];
            }
        }

        if ($roles->permission) {
            foreach ($roles->permission as $value) {
                $return['permission'][] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'displayName' => $value->display_name
                ];
            }
        }
        return $return;
    }
}