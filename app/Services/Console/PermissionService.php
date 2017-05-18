<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/18
 * Time: 下午9:07
 */

namespace App\Services\Console;


use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionService
{
    protected $permissionRepository;
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return mixed
     */
    public function paginate()
    {
        return $this->permissionRepository->paginate(per_page());
    }
}