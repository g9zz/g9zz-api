<?php

namespace App\Http\Controllers\Console;

use App\Http\Requests\Console\RoleRequest;
use App\Services\Console\RoleService;
use App\Transformers\RoleTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class RoleController extends Controller
{
    protected $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginate = $this->roleService->paginate();
        $resource = new Collection($paginate,new RoleTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginate));
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $request)
    {
        $result = $this->roleService->store($request);
        $resource = new Item($result,new RoleTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->roleService->find($id);
        $resource = new Item($result,new RoleTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleRequest $request, $id)
    {
        $this->roleService->update($request,$id);
        $resource = new Item($this->roleService->find($id),new RoleTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->roleService->delete($id);
        if ($result) return $this->response();
    }

    /**
     * 给角色分配权限
     * @param RoleRequest $request
     * @param $roleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachPermission(RoleRequest $request, $roleId)
    {
        $permissions = $request->get('permissionIds');
        $this->roleService->attachPermission($permissions,$roleId);
        $resource = new Item($this->roleService->find($roleId),new RoleTransformer());
        $this->setData($resource);
        return $this->response();
    }


}
