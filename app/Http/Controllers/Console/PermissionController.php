<?php

namespace App\Http\Controllers\Console;

use App\Http\Requests\Console\PermissionRequest;
use App\Services\Console\PermissionService;
use App\Transformers\PermissionTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class PermissionController extends Controller
{

    protected $permissionService;
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginate = $this->permissionService->paginate();
        $resource = new Collection($paginate,new PermissionTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginate));
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param PermissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionRequest $request)
    {
        $result = $this->permissionService->store($request);
        $resource = new Item($result,new PermissionTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->permissionService->find($id);
        $resource = new Item($result,new PermissionTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param PermissionRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PermissionRequest $request, $id)
    {
        $this->permissionService->update($request,$id);
        $resource = new Item($this->permissionService->find($id),new PermissionTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
