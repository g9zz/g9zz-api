<?php

namespace App\Http\Controllers\Console;

use App\Http\Requests\Console\NodeRequest;
use App\Services\Console\NodeService;
use App\Transformers\NodeTransformer;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class NodeController extends Controller
{
    protected $nodeService;

    public function __construct (NodeService $nodeService)
    {
        $this->nodeService = $nodeService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $orderNode = $this->nodeService->orderNode();
        $resource = new Collection($orderNode,new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param NodeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NodeRequest $request)
    {
        $result = $this->nodeService->storeNode($request);
        $resource = new Item($result,new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $node = $this->nodeService->find($id);
        $resource = new Item($node,new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return mixed
     */
    public function update(NodeRequest $request, $id)
    {
        $this->nodeService->update($request,$id);

        $resource = new Item($this->nodeService->find($id),new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result =  $this->nodeService->delete($id);
        if ($result) return $this->response();
    }
}
