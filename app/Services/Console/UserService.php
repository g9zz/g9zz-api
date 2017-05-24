<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/19
 * Time: 下午5:22
 */

namespace App\Services\Console;


use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\BaseService;

class UserService extends BaseService
{
    protected $userRepository;
    protected $roleRepository;
    public function __construct(UserRepositoryInterface $userRepository,
                                RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        return $this->userRepository->paginate(per_page());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * 给用户分配权限
     * @param $userId
     * @param $roleId
     * @return mixed
     */
    public function attachRole($userId,$roleId)
    {
        $this->roleRepository->find($roleId);
        return $this->userRepository->syncRelationship($roleId,$userId);
    }
}