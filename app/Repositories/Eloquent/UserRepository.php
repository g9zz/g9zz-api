<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 2017/4/12
 * Time: 下午4:42
 */

namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    /**
     *
     * 获取已分配的角色
     *
     * @param $userId
     * @return mixed
     */
    public function getAssignRole($userId)
    {
        return $this->model->find($userId)->role()->get();
    }
    /**
     *
     * 获取已分配的角色ID集合
     *
     * @param $userId
     * @return array
     */
    public function getAssignRoleIds($userId)
    {
        $result = $this->getAssignRole($userId);
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
     *
     * 分配角色
     *
     * @param $role
     * @param $id
     * @return bool
     */
    public function syncRelationship($role,$id)
    {
        try{
            \DB::beginTransaction();
            $this->model->find($id)->role()->sync([]);
            $this->model->find($id)->role()->sync($role);
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \DB::rollBack();
            $code = $e->getCode();
            \Log::info('"controller.error" to listener "' . __METHOD__ . '".', ['message' => $e->getMessage(), 'code' => $code]);
            return false;
        }
    }

    /**
     * 通过github的id获取github_user表
     * @param $githubId
     * @return mixed
     */
    public function getGithub($githubId)
    {
        return $this->model->where('github_id',$githubId)->first();
    }

    /**
     * 根据userId 获取user
     * @param $userId
     * @return mixed
     */
    public function first($userId)
    {
        return $this->model->whereId($userId)->first();
    }

    /**
     * 通过email 获取user
     * @param $email
     * @return mixed
     */
    public function findUserByEmail($email)
    {
        return $this->model->whereEmail($email)->first();
    }
}