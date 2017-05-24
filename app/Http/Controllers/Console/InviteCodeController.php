<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Services\Console\InviteCodeService;
use App\Transformers\InviteCodeTransformer;
use App\Transformers\SingleInviteCodeTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class InviteCodeController extends Controller
{

    protected $inviteCodeService;

    public function __construct(InviteCodeService $inviteCodeService)
    {
        $this->inviteCodeService = $inviteCodeService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $paginate = $this->inviteCodeService->paginate($request);
        $resource = new Collection($paginate,new InviteCodeTransformer());
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginate));
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $result = $this->inviteCodeService->store();
        $resource = new Item($result,new SingleInviteCodeTransformer());
        $this->setData($resource);
        return $this->response();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCode()
    {
        $result = $this->inviteCodeService->getAllCode();
        $resource = new Collection($result,new InviteCodeTransformer());
        $this->setData($resource);
        return $this->response();
    }
}
