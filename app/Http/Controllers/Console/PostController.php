<?php

namespace App\Http\Controllers\Console;

use App\Http\Requests\Console\PostRequest;
use App\Services\Console\PostService;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class PostController extends Controller
{
    protected $postService;

    protected $request;

    public function __construct(PostService $postService,Request $request)
    {
        $this->postService = $postService;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $request = $this->request->all();
        $this->log('"controller.request" to listener "' . __METHOD__ . '".',['request' => $request]);
        $paginate = $this->postService->paginate($request);
        $resource = new Collection($paginate,new PostTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginate));
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $result = $this->postService->store($request);
        $resource = new Item($result,new PostTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $hid
     * @return mixed
     */
    public function show($hid)
    {
        $data = $this->postService->find($hid);
        $resource = new Item($data,new PostTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param PostRequest $request
     * @param $hid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, $hid)
    {
        $this->postService->update($request,$hid);
        $resource = new Item($this->postService->find($hid),new PostTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $hid
     * @return mixed
     */
    public function destroy($hid)
    {
        $result = $this->postService->delete($hid);
        if ($result) return $this->response();
    }
}
