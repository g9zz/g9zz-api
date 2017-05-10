<?php

namespace App\Http\Controllers\Console;

use App\Http\Requests\Console\NodeRequest;
use App\Services\Console\NodeService;
use App\Transformers\NodeTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NodeRequest $request, $id)
    {
        //
        dd(4444);
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
