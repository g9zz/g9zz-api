<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 2017/4/12
 * Time: 下午4:11
 */

namespace App\Http\Controllers;


use App\Http\Requests\StoreCommentRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Transformers\UserTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class TestController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index()
    {
        $user = $this->userRepository->paginate();

        $result = new Collection($user,new UserTransformer());
        $result = $result->setPaginator(new IlluminatePaginatorAdapter($user));

        $this->setData($result);
        return $this->response();
//        dd($resource);
    }

    public function validator(StoreCommentRequest $request)
    {
        dd($request->all(),11223);
    }
}