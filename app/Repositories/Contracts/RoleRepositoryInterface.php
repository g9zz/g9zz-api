<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午9:18
 */

namespace App\Repositories\Contracts;


interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * 通过角色ID 删除 角色权限 相关数据
     * @param $roleId
     * @return mixed
     */
    public function deleteRolePermission($roleId);

    /**
     * 通过角色ID 删除 角色用户 相关数据
     * @param $roleId
     * @return mixed
     */
    public function deleteRoleUser($roleId);

    /**
     * 获取 已分配的权限
     * @param $roleId
     * @return mixed
     */
    public function getHadAssignedPermission($roleId);

    /**
     * 获取已分配的权限的ID列表
     * @param $roleId
     * @return mixed
     */
    public function getHadAssignedPermissionIds($roleId);

    /**
     * 重新分配权限
     * @param $permissions
     * @param $id
     * @return mixed
     */
    public function syncRelationship($permissions,$id);


}