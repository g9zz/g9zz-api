<?php

namespace App\Http\Controllers\Console;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request, $id)
    {

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
        $this->setData((object)null);
        if (!$result) {
            $this->setCode(400000000);
        }
        return $this->response();
    }
}
