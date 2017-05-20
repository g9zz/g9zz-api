<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 2017/4/12
 * Time: 下午4:41
 */

namespace App\Repositories\Contracts;


interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * 获取已分配的角色
     * @param $userId
     * @return mixed
     */
    public function getAssignRole($userId);

    /**
     * 获取已分配角色ID
     * @param $userId
     * @return mixed
     */
    public function getAssignRoleIds($userId);

    /**
     * 重新分配角色
     * @param $role
     * @param $id
     * @return mixed
     */
    public function syncRelationship($role,$id);

    /**
     * 通过github的id获取github_user表
     * @param $githubId
     * @return mixed
     */
    public function getGithub($githubId);
}