<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/5/23
 * Time: 下午10:21
 */

namespace App\Services\Auth;


use App\Services\BaseService;

class RegisterService extends BaseService
{
    protected $isInvite;
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->isInvite = config('g9zz.invite_code.is_invite');
        $this->userService = $userService;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        //需要邀请码
        //不需要邀请码 直接注册
        $other = [];
        if ($this->isInvite) {
            $other['invite_code'] = $request->get('inviteCode');
        }

        $create = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];
        return  $this->userService->loginCreate($create,$other);
    }
}