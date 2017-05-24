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
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($hid)
    {
        $node = $this->nodeService->find($hid);
        $resource = new Item($node,new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }


    /**
     * @param NodeRequest $request
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NodeRequest $request, $hid)
    {
        $this->nodeService->update($request,$hid);

        $resource = new Item($this->nodeService->find($hid),new NodeTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($hid)
    {
        $result =  $this->nodeService->delete($hid);
        if ($result) return $this->response();
    }
}
