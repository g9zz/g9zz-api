<?php

namespace App\Http\Controllers\Console;

use App\Http\Requests\Console\TagRequest;
use App\Services\Console\TagService;
use App\Transformers\TagTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class TagController extends Controller
{

    protected $tagService;
    protected $request;

    public function __construct(TagService $tagService,Request $request)
    {
        $this->tagService = $tagService;
        $this->request = $request;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->tagService->paginate(per_page(),$this->request);
        $resource = new Collection($data,new TagTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($data));
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param TagRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagRequest $request)
    {
        $result = $this->tagService->store($request);
        $resource = new Item($result,new TagTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->tagService->find($id);
        $resource = new Item($result,new TagTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param TagRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagRequest $request, $id)
    {
        $this->tagService->update($request,$id);
        $resource = new Item($this->tagService->find($id),new TagTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->tagService->delete($id);
        if ($result) return $this->response();
    }
}
