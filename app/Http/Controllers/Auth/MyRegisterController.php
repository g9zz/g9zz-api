<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/21
 * Time: 上午12:28
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\MyRegisterRequest;
use App\Services\Auth\RegisterService;
use App\Services\Auth\UserService;
use App\Transformers\UserTransformer;
use League\Fractal\Resource\Item;


class MyRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $userService;

    protected $registerService;

    protected $isInvite;

    public function __construct(UserService $userService,
                                RegisterService $registerService)
    {
        $this->userService = $userService;
        $this->registerService = $registerService;
        $this->isInvite = config('g9zz.invite_code.is_invite');

    }

    /**
     * @param MyRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MyRegisterRequest $request)
    {
        $result = $this->registerService->store($request);
        $resource = new Item($result,new UserTransformer());
        $this->setData($resource);
        return $this->response();
    }


}