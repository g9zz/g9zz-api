<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\Index\ReplyRequest;
use App\Services\Index\ReplyService;
use App\Transformers\ReplyTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ReplyController extends Controller
{
    protected $replyService;
    protected $request;

    public function __construct(ReplyService $replyService,Request $request)
    {
        $this->replyService = $replyService;
        $this->request = $request;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginate = $this->replyService->paginate();
        $resource = new Collection($paginate,new ReplyTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginate));
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param ReplyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReplyRequest $request)
    {
        $result =  $this->replyService->store($request);
        $resource = new Item($result,new ReplyTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->replyService->find($id);
        $resource = new Item($result,new ReplyTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReplyRequest $request, $id)
    {
        $this->replyService->update($request,$id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->replyService->delete($id);
        if ($result) return $this->response();
    }
}
