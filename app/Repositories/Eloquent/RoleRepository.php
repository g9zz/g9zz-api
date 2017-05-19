<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午9:19
 */

namespace App\Repositories\Eloquent;


use App\Exceptions\TryException;
use App\Models\Roles;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function model()
    {
        return Roles::class;
    }

    /**
     * 通过角色ID 删除 角色权限 相关数据
     * @param $roleId
     * @return mixed
     */
    public function deleteRolePermission($roleId)
    {
        return $this->model->permission()->where('role_id',$roleId)->delete();
    }

    /**
     * 通过角色ID 删除 角色用户 相关数据
     * @param $roleId
     * @return mixed
     */
    public function deleteRoleUser($roleId)
    {
        return $this->model->user()->where('role_id',$roleId)->delete();
    }

    /**
     * 获取 已分配的权限
     * @param $roleId
     * @return mixed
     */
    public function getHadAssignedPermission($roleId)
    {
        return $this->model->find($roleId)->permission()->get();
    }

    /**
     *
     * 获取已分配的权限的ID列表
     *
     * @param $roleId
     * @return array
     */
    public function getHadAssignedPermissionIds($roleId)
    {
        $result = $this->getHadAssignedPermission($roleId);
        $ids = [];
        if (!empty($result->toArray())) {
            foreach ($result as $value) {
                array_push($ids,$value->id);
            }
            array_unique($ids);
        }
        return $ids;
    }

    /**
     * 重新分配权限
     * @param $permissions
     * @param $id
     * @return bool
     */
    public function syncRelationship($permissions,$id)
    {
        try{
            \DB::beginTransaction();
            $this->model->find($id)->permission()->sync([]);
            $this->model->find($id)->permission()->sync($permissions);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            $code = $e->getCode();
            \Log::info('"controller.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'code' => $code]);
            throw new TryException(json_encode($e->getMessage()),(int)$e->getCode());
        }
        return true;
    }

}