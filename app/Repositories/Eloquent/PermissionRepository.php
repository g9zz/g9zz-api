<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午9:08
 */

namespace App\Repositories\Eloquent;


use App\Models\Permissions;
use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function model()
    {
        return  Permissions::class;
    }

    /**
     * 通过权限ID删除 权限角色 中间表的数据
     * @param $permissionId
     * @return mixed
     */
    public function deletePermissionRole($permissionId)
    {
        return $this->model->role()->where('permission_id',$permissionId)->delete();
    }
}