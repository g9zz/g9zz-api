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
use App\Services\BaseService;

class PermissionService extends BaseService
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

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $create = $request->only(['name','displayName','description']);
        $this->log('service.request to '.__METHOD__,['request' => $create]);
        $create = parse_input($create);
        //省去校验唯一,表单提交时候已校验
        return $this->permissionRepository->create($create);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->permissionRepository->find($id);
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request,$id)
    {
        $update = $request->only(['name','displayName']);
        if (!empty($request->get('description'))) $update['description'] = $request->get('description');
        $update = parse_input($update);
        $this->log('service.request to '.__METHOD__,['update' => $update]);
        return $this->permissionRepository->update($update,$id);
    }
}