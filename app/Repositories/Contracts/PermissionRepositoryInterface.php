<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午9:08
 */

namespace App\Repositories\Contracts;


interface PermissionRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * 通过权限ID删除 权限角色 中间表的数据
     * @param $permissionId
     * @return mixed
     */
    public function deletePermissionRole($permissionId);
}