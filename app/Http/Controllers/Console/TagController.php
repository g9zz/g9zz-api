<?php

namespace App\Http\Controllers\Console;

use App\Http\Requests\Console\TagRequest;
use App\Services\Console\TagService;
use App\Transformers\TagTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
