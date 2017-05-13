<?php

namespace App\Http\Controllers\Console;

use App\Http\Requests\Console\PostRequest;
use App\Http\Requests\PostEditRequest;
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
     * @param  int  $id
     * @return mixed
     */
    public function show($id)
    {
        $data = $this->postService->find($id);
        $resource = new Item($data,new PostTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, $id)
    {
        $this->postService->update($request,$id);
        $resource = new Item($this->postService->find($id),new PostTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function destroy($id)
    {
        $result = $this->postService->delete($id);
        if ($result) return $this->response();
    }
}
